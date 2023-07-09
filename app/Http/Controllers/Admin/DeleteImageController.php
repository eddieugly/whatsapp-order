<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class DeleteImageController extends Controller
{
    public function __invoke(Request $request)
    {
        $media = Media::find($request->id);

        $media->delete();

        return Redirect::back()->with('success', 'Image Deleted Successfully');
    }
}
