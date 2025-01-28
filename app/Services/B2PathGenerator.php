<?php

namespace App\Services;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class B2PathGenerator implements PathGenerator
{

    public function __construct()
    {
        $this->fileName = \Illuminate\Support\Str::uuid();
    }

    public function getPath(Media $media): string
    {
        return 'media/' . $media->collection_name . '/' . md5($media->id . '32R@A,rowp') . '/';
    }

    public function getPathForConversions(Media $media): string
    {
        return $this->getPath($media) . 'c/';
    }

    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getPath($media) . '/custom_responsive_images/';
    }

}
