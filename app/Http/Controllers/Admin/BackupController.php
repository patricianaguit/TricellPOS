<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

use Illuminate\Http\Request;

use Alert;
use Carbon\Carbon;
use App\Http\Requests;
use Artisan;
use Log;
use Storage;


class BackupController extends Controller
{
    public function index(Request $request)
    {
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $disk = Storage::disk(config('backup.backup.destination.disks.name')[0]);

        $files = $disk->files(config('backup.backup.name'));
        $backups = [];

        foreach ($files as $k => $f) {

            if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                $backups[] = [
                    'file_path' => $f,
                    'file_name' => str_replace(config('backup.backup.name') . '/', '', $f),
                    'file_size' => $this->human_filesize($disk->size($f)),
                    'last_modified' => $this->getDate($disk->lastModified($f)),
                    'age' => $this->getAge($disk->lastModified($f))
                ];
            }
        }

        $backupsarray = array_reverse($backups);

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $backupcol = collect($backupsarray);
        $perPage = 7;
        $currentPageItems = $backupcol->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        $backups= new LengthAwarePaginator($currentPageItems , count($backupcol), $perPage);

        $backups->setPath($request->url());

        return view("admin.backup")->with('backups', $backups);
    }

    public function create()
    {
        try {
            // start the backup process
            Artisan::call('backup:run', ['--only-db' => true, '--disable-notifications' => true]);
            $output = Artisan::output();
            // log the results
            Log::info("Backpack\BackupManager -- new backup started from admin interface \r\n" . $output);
            // return the results as a response to the ajax call
            // Alert::success('New backup created');
            return redirect()->back();
        } catch (Exception $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Downloads a backup zip file.
     *
     * TODO: make it work no matter the flysystem driver (S3 Bucket, etc).
     */
    public function download($file_name)
    {
        $file = config('backup.backup.name') . '/' . $file_name;
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        if ($disk->exists($file)) {
            $fs = Storage::disk(config('backup.backup.destination.disks')[0])->getDriver();
            $stream = $fs->readStream($file);

            return \Response::stream(function () use ($stream) {
                fpassthru($stream);
            }, 200, [
                "Content-Type" => $fs->getMimetype($file),
                "Content-Length" => $fs->getSize($file),
                "Content-disposition" => "attachment; filename=\"" . basename($file) . "\"",
            ]);
        } else {
            abort(404, "The backup file doesn't exist.");
        }
    }

    /**
     * Deletes a backup file.
     */
    public function delete($file_name)
    {
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        if ($disk->exists(config('backup.backup.name') . '/' . $file_name)) {
            $disk->delete(config('backup.backup.name') . '/' . $file_name);
            return redirect()->back();
        } else {
            abort(404, "The backup file doesn't exist.");
        }
    }

    public function human_filesize($bytes, $decimals =2)
    {
        if($bytes < 1024)
        {
            return $bytes . ' B';
        }
        
        $factor = floor(log($bytes, 1024));
    
        return sprintf("%.{$decimals}f ", $bytes / pow(1024, $factor)) . ['B', 'KB', 'MB', 'GB', 'TB', 'PB'][$factor];
    }

    public function getDate($date_modify)
    {
        return Carbon::createFromTimeStamp($date_modify)->format('F d, Y  g:i A');
    }

    public function getAge($date_modify)
    {
        $createdate = Carbon::createFromTimestamp($date_modify)->toDateTimeString(); 
        $datediff = Carbon::parse($createdate);

        return $datediff->diffForHumans();

    }
}