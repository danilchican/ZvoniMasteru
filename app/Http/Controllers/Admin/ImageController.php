<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{
    public static function saveCategoryThumbnail($thumbnail)
    {
        $image = Image::make($thumbnail)->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        $image_name = $thumbnail->hashName();

        $_path = 'uploads/'.Carbon::now()->year.'/'.Carbon::now()->month;

        if(!File::exists(public_path($_path))) {
            File::makeDirectory(public_path($_path), 775, true);
        }

        $image->save($_path.'/'.$image_name);

        return $_path.'/'.$image_name;
    }
}
