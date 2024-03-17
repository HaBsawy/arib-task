<?php

namespace App\Helpers;

use App\Http\Requests\EmployeeRequest;
use Illuminate\Support\Facades\Storage;

class ImageHelper
{
    /**
     * Upload Image
     *
     * @param EmployeeRequest $request
     * @return string
     */
    function uploadImage(EmployeeRequest $request): string
    {
        $file_name = $request->get('first_name') . '-' . $request->get('last_name') . '-' .
            time() . '.' . $request->file('image')->guessExtension();

        return 'profile_images/' . Storage::disk('profile')
                ->putFileAs('/', $request->file('image'), $file_name);
    }

    /**
     * Remove Image
     *
     * @param string $imageLink
     * @return void
     */
    function removeImage(string $imageLink): void
    {
        $fileName = str_replace('profile_images/', '', $imageLink);
        Storage::disk('profile')->delete($fileName);
    }
}
