<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;

class ImageController extends Controller
{
    /**
     * Save the category thumbnail to storage.
     *
     * @param $thumbnail
     *
     * @return string
     */
    public static function saveCategoryThumbnail($thumbnail)
    {
        $image = Image::make($thumbnail)->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        $image_name = $thumbnail->hashName();

        $_path = 'uploads/'.Carbon::now()->year.'/'.Carbon::now()->month;

        if (!File::exists(public_path($_path))) {
            File::makeDirectory(public_path($_path), 775, true);
        }

        $image->save($_path.'/'.$image_name);

        return $_path.'/'.$image_name;
    }

    /**
     * Remove the category thumbnail.
     *
     * @param $path
     *
     * @return mixed|bool
     */
    public static function removeCategoryThumbnail($path)
    {
        return File::delete($path);
    }
}
