<?php

namespace App\Services;
use App\Exceptions\GeneralException;
use App\Exceptions\GivenTempFileNotRelatedToGivenEntityException;
use Spatie\FlareClient\Http\Client;

ini_set('memory_limit', '1024M');
class MediaService
{

    public static function addMediaFromRequest($entity, $fileInputName, $collection = null,  $customFileName = null){
        $media = $entity->addMediaFromRequest($fileInputName);
        return self::addMedia($entity,$media,$collection);
    }
    public static function addMediaFromDisk($entity, $filePath, $disk = null, $collection = null, $uploader = null)
    {
        $media = $entity->addMediaFromDisk($filePath, $disk);

        self::addMedia($entity, $media, $collection, $uploader);
    }
    public static function addMediaFromUrl($entity, $url, $collection = null, $uploader = null, $customFileName = null, $disk = null, $customProperties = null)
    {

        $media = $entity->addMediaFromUrl($url);
        

        return self::addMedia($entity, $media, $collection, $uploader, $customFileName, $disk, $customProperties);
    }
    public static function addMedia($entity, $media, $collection = null,  $customFileName = true, $disk = null, $customProperties = null)
    {
        $path = $media->getPathToFile();

        
        if(!realpath($path)){
            $path = storage_path('app/' . $path);
        }

        // Setting file name
        $mimetype  = mime_content_type($path);
        if($customFileName){
            // get file extension, generate unique file name
            $extension = FilesHelper::getExtensionFromMimetype($mimetype);

            if(empty($extension)){

                throw new GeneralException($statusCode = 400, $apiErrorCode = 'unsupported file types', $message = 'extension not supported');
            }
            $fileName  = self::generateFileNameByExtension($extension);
            
            
        }else{
            $fileName = $media->getFileName();
        }


        $media = $media->usingFileName($fileName);
        // get image (width/height)
        if (FilesHelper::isMimetypeOfImage($mimetype) && file_exists($path)) {
            $imgResolution = getimagesize($path);
            $media         = $media->withCustomProperties(['width' => $imgResolution[0], 'height' => $imgResolution[1]]);
        }
        //attach custom properties if set
        if(!empty($customProperties)){
            $media         = $media->withCustomProperties(array_merge($customProperties, ($media->customProperties ?? [])));
        }
        //save media

        if($disk){
            $media = $media->toMediaCollection($collection ?? 'images', $disk);
        }else{
            $media = $media->toMediaCollection($collection ?? 'images');

        }

        //Generating static urls
        $media->urls = self::generateStaticUrls($media);



        //add user to media as uploader
       // $media->addUploader($uploader ?? getLogged());
        return $media;
    }
    public static function generateFileNameByExtension($extension)
    {
        return (String) \Illuminate\Support\Str::random(32) . '.' . $extension;
    }
    public static function generateStaticUrls($media)
    {
        //Generating static urls
        $urls['original'] = $media->getUrl();

        // echo $urls['original'];


        if (!empty($media->generated_conversions)) {
            foreach ($media->generated_conversions as $conv => $val) {
                //get url of that converstion
                $url = $media->getUrl($conv);
                //add this to urls
                if (!empty($url)) {
                    $urls[$conv] = $url;
                }
            }
        }

        return $urls;
    }
    public static function addMultipleMediaFromRequest($entity, $fileInputName, $collection = null, $uploader = null)
    {
        $media = [];

        foreach (\Request()->file($fileInputName) ?? [] as $file) {

            $mediaObj = $entity->addMedia($file->getPathName());
            $media[] = self::addMedia($entity, $mediaObj, $collection);
        }

        return $media;
    }
}
