<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function getUploads(Request $request) 
    {
        $user = \Auth::user();

        return $user->uploads()
            ->with('tags')
            ->get();
    }

    public function addTag(\App\Upload $upload, $text)
    {
        $tagExists = $upload->tags()
            ->where('text', '=', $text)
            ->exists();

        if ($tagExists) {
            return 200;
        }

        $tag = \App\Tag::firstOrCreate([
            'text' => $text
        ]);

        $upload->tags()
            ->attach($tag->id);

        return 200;
    }

    public function deleteTag(\App\Upload $upload, $text)
    {
        $tag = \App\Tag::where('text', '=', $text)
            ->firstOrFail();

        $upload->tags()
            ->detach($tag->id);

        return 200;
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
