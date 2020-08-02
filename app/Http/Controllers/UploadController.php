<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function getUploads(Request $request) 
    {
        $user = \Auth::user();

        return $user->uploads;
    }

    public function uploadFile(Request $request) 
    {

        $user = \Auth::user();

        $inputs = $request->only([
            'uuid',
            'key',
            'bucket',
            'name',
            'content_type',
        ]);

        $tmpPath = $inputs['key'];
        $newPath = pathinfo($tmpPath)['basename'];

        $inputs['key'] = $newPath;

        Storage::rename($tmpPath, $newPath);

        $upload = \App\Upload::create(array_merge(
            ['user_id' => $user->id],
            $inputs
        ));

        return [
            'user_id' => $user->id,
            'uuid' => $request->input('uuid'),
            'key' => $request->input('key'),
            'bucket' => $request->input('bucket'),
            'name' => $request->input('name'),
            'content_type' => $request->input('content_type'),
        ];
    }
}
