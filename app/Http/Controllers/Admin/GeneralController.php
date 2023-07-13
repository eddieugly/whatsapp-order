<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\General;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Intervention\Image\Facades\Image;
use App\Http\Requests\UpdateLogoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdateGeneralRequest;

class GeneralController extends Controller
{
    public function general()
    {
        return Inertia::render('Admin/General/Index', [
            'title' => 'General Settings',
        ]);
    }

    public function updateGeneral(UpdateGeneralRequest $request)
    {
        $data = $request->validated();


        return Redirect::back()->with('success', 'General Settings Updated Successfully');
    }

    public function logoUpdate(UpdateLogoRequest $request): RedirectResponse
    {
        
        if ($request->hasFile('company_logo_white')) {
            
            try {
                $path = imagePath()['logoIcon']['path'];
                $file = $request->company_logo_white;
                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }
                Image::make($file)->save($path . '/logo_white.' . $file->getClientOriginalExtension());
            } catch (\Exception $exp) {
                $errorMessage = $exp->getMessage();                
                return Redirect::back()->with('error', $errorMessage);
            }
        }

        if ($request->hasFile('company_logo_dark')) {
            
            try {
                $path = imagePath()['logoIcon']['path'];
                $file = $request->company_logo_dark;
                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }
                Image::make($file)->save($path . '/logo_dark.' . $file->getClientOriginalExtension());
            } catch (\Exception $exp) {
                $errorMessage = $exp->getMessage();                
                return Redirect::back()->with('error', $errorMessage);
            }
        }

        if ($request->hasFile('company_favicon')) {
            try {
                $file = $request->company_favicon;
                $path = imagePath()['favicon']['path'];
                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }
                Image::make($file)->save($path . '/favicon.' . $file->getClientOriginalExtension());
            } catch (\Exception $exp) {
                $errorMessage = $exp->getMessage();                
                return Redirect::back()->with('error', $errorMessage);
            }
        }

        return Redirect::back()->with('success', 'Logo $ FavIcon Updated Successfully');
    }
}
