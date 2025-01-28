<?php

namespace App\Services;

use Illuminate\Support\Str;
use App\Exceptions\InvalidBase64DataException;
use App\Services\StringHelpers;
class FilesHelper
{
    /**
     * @var array
     */
    protected static $extensions = [
        'text/plain'                                                                => 'txt',

        'image/jpeg'                                                                => 'jpg', //jpg
        'image/webp'                                                                => 'webp', //webp
        'image/png'                                                                 => 'png', //png
        'image/gif'                                                                 => 'gif', //gif
        'image/vnd.adobe.photoshop'                                                 => 'psd', //psd
        'image/vnd.microsoft.icon'                                                  => 'ico', //ico

        'application/zip'                                                           => 'zip', //zip
        'application/x-rar'                                                         => 'rar', //rar
        'application/gzip'                                                          => 'gz', //gz
        'application/x-tar'                                                         => 'tar', //tar
        'application/x-7z-compressed'                                               => '7z', //7z

        'application/pdf'                                                           => 'pdf', //pdf
        'application/epub+zip'                                                      => 'epub', //epub

        'audio/mpeg'                                                                => 'mp3', //mp3
        'video/mp4'                                                                 => 'mp4', //mp4
        'audio/wav'                                                                 => 'wav', //wav
        'audio/x-wav'                                                               => 'wav', //wav
        'video/webm'                                                                => 'webm', //webm
        'audio/ogg'                                                                 => 'oga', //oga =>  ogv

        'application/octet-stream'                                                  => 'exe', //exe

        'application/msword'                                                        => 'doc', //doc
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document'   => 'docx', //docx
        'text/csv'                                                                  => 'csv', //csv
        'application/vnd.ms-powerpoint'                                             => 'ppt', //ppt
        'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'pptx', //pptx
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'         => 'xlsx', //xlsx
        'application/vnd.ms-excel'                                                  => 'xls', //xls

        'application/json'                                                          => 'json', //json
        // 'text/xml'                                                                  => 'xml', //xml

        'application/octet-stream'                                                  => 'exe', //exe

        'font/ttf'                                                                  => 'ttf', //ttf
        'font/sfnt'                                                                 => 'ttf', //ttf
    ];

    /**
     * @param $mimetype
     */
    public static function getExtensionFromMimetype($mimetype)
    {
        return array_key_exists($mimetype, self::$extensions) ? self::$extensions[$mimetype] : false;
    }

    /**
     * @param $extension
     */
    public static function getMimetypeFromExtension($extension)
    {
        return array_search($extension, self::$extensions);
    }

    /**
     * @param $mimetype
     */
    public static function isMimetypeOfImage($mimetype)
    {
        return mb_strpos($mimetype, 'image') !== false;
    }

    /**
     * Detect given (file/base64/resource) extension based on its mimetype, generate new file name.
     * @param  \Illuminate\Http\UploadedFile $file
     * @return string
     */
    public static function generateFileName($file)
    {
        if (StringHelpers::isBase64($file)) {
            $extension = self::getBase64FileExtension($file);
        } elseif (is_resource($file)) {
            $extension = self::getExtensionFromMimetype(mime_content_type($file));
        } elseif ($file instanceof \Illuminate\Http\UploadedFile) {
            $extension = $file->guessExtension();
        } else {
            $finfo     = new \finfo(FILEINFO_MIME_TYPE);
            $mimeType  = $finfo->buffer($file);
            $extension = self::getExtensionFromMimetype($mimeType);
        }
        return Str::random(40) . '.' . $extension;
    }

    /**
     * @param $base64
     */
    public static function getBase64FileExtension($base64)
    {
        if (!StringHelpers::isBase64($base64)) {
            throw new InvalidBase64DataException();
        }

        //filter base64 to get its content
        $base64 = StringHelpers::filterBase64Date($base64);
        //convert base64 to file
        $decodedData = base64_decode($base64, true);

        //make temp file to store base64 decoded data to it
        $temp = tmpfile();
        fwrite($temp, $decodedData);

        //get file mime type
        $mime = mime_content_type($temp);

        //check corresponding extension
        return self::getExtensionFromMimetype($mime);
    }

    /**
     * @param $base64
     */
    public static function isBase64File($base64)
    {
        $extension = self::getBase64FileExtension($base64);
        if ($extension == 'txt') {
            return false;
        }

        return self::getBase64FileExtension($base64) ? true : false;
    }
}
