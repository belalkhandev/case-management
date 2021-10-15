<?php

namespace App\Services;

class FileUpload
{
    public static function upload($request, $fileName, $directory)
    {
        if ($request->hasFile($fileName)) {
            $file = $request->$fileName;
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $uploadPath = "uploads/".date('Y-m')."/$directory/";
            $path = $file->move($uploadPath, $filename);

            if ($file->getError()) {
                $request->session()->flash('warning', $file->getErrorMessage());

                return false;
            }

            return $path;
        }
    }
}
