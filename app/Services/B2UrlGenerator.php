<?php

namespace App\Services;


use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Filesystem\FilesystemManager;
use Spatie\MediaLibrary\Support\UrlGenerator\BaseUrlGenerator;

class B2UrlGenerator extends BaseUrlGenerator
{
    /** @var \Illuminate\Filesystem\FilesystemManager */
    protected $filesystemManager;

    public function __construct(Config $config, FilesystemManager $filesystemManager)
    {
        parent::__construct($config);

        $this->filesystemManager = $filesystemManager;

    }

    /**
     * Get the url for the profile of a media item.
     *
     * @return string
     */
    public function getUrl(): string
    {
        $mediaDisk = $this->media->disk;

        if ($mediaDisk == 'b2') {
            $baseDomain = config('filesystems.disks.b2.domain') . config('filesystems.disks.b2.bucketName') . '/';
        } else if ($mediaDisk == 's3') {
            $baseDomain = 'https://' . config('filesystems.disks.s3.bucket') . '.s3.' . config('filesystems.disks.s3.region') . '.amazonaws.com/';
        } else {
            $baseDomain = '/storage/';
        }

        //b2 bucket domain + bucket name + filePath
        return $baseDomain . $this->getPathRelativeToRoot();
    }

    /**
     * Get the temporary url for a media item.
     *
     * @param \DateTimeInterface $expiration
     * @param array $options
     *
     * @return string
     */
    public function getTemporaryUrl(\DateTimeInterface $expiration, array $options = []): string
    {
        return $this
            ->filesystemManager
            ->disk($this->media->disk)
            ->temporaryUrl($this->getPath(), $expiration, $options);
    }

    /**
     * Get the url to the directory containing responsive images.
     *
     * @return string
     */
    public function getResponsiveImagesDirectoryUrl(): string
    {
        return config('medialibrary.s3.domain') . '/' . $this->pathGenerator->getPathForResponsiveImages($this->media);
    }

    public function getPath($conversion = null): string
    {
        return $this->getPathRelativeToRoot();
    }
}
