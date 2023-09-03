<?php

namespace App\Listeners;

use App\Events\FileDownloaded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Log;

class PostInFileLog
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(FileDownloaded $event): void
    {
        $downloadDetails = $event->downloadDetails;

        Log::create([
            'downloaded_at' => now(),
            'ip_address' => $downloadDetails['ip_address'],
            'user_agent' => $downloadDetails['user_agent'],
            'country' => $downloadDetails['country'],
            'file_id' => $downloadDetails['file_id'],
        ]);
    }
}
