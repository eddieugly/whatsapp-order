<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UploadImagesController extends Controller
{
    public function __invoke(Request $request)
    {

        $modelClass = Relation::getMorphedModel($request->modelType);

        $validator = Validator::make($request->all(), [
            'image' => ['bail', 'required', 'image', 'mimes:png,jpg,jpeg,webp', 'max:1024'],
            'modelType' => ['bail', 'required', 'string', Rule::in(array_keys(Relation::morphMap()))],
            'modelId' => ['bail', 'required', 'string', Rule::exists($modelClass, 'ulid')],
        ]);

        if ($validator->fails()) {
            return response($validator->errors()->first(), 400);
        }

        // Upload Image
        /** @var \Spatie\MediaLibrary\InteractsWithMedia */

        $model = $modelClass::where('ulid', $request->modelId)->first();

        

        $model->addMediaFromRequest('image')->withResponsiveImages()->toMediaCollection();


        return response('success');
    }
}
