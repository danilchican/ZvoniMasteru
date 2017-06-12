<?php

namespace App\Http\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;

/**
 * Class ImageService
 * @package App\Http\Helpers
 */
class ImageService
{
    /**
     * Save the category thumbnail to storage.
     *
     * @param $thumbnail
     *
     * @param int $width
     * @return string
     */
    public static function saveThumbnail($thumbnail, $width = 300)
    {
        $image = Image::make($thumbnail)->resize($width, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        $image_name = $thumbnail->hashName();

        $path = 'uploads/'.Carbon::now()->year.'/'.Carbon::now()->month;

        if (!File::exists(public_path($path))) {
            File::makeDirectory(public_path($path), 775, true);
        }

        $path = '/'.$path.'/'.$image_name;
        $image->save($path);

        return $path;
    }

    /**
     * Remove the category thumbnail.
     *
     * @param $path
     *
     * @return mixed|bool
     */
    public static function removeThumbnail($path)
    {
        return File::delete($path);
    }
}