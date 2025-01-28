<?php

namespace  App\jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Media\Services\MigratingMediaService;

class MigrateMediaToDiskJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $media;
    public $toDisk;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($media, $toDisk)
    {
        $this->media = $media;
        $this->toDisk = $toDisk;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        MigratingMediaService::copyFromDiskToDisk($this->media, $this->toDisk);
    }
}
