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
use App\Http\Resources\GeneralResource;

class GeneralController extends Controller
{
    public function general()
    {
        return Inertia::render('Admin/General/Edit', [
            'title' => 'General Settings',
            'item' => new GeneralResource(General::first()),
        ]);
    }

    public function updateGeneral(UpdateGeneralRequest $request)
    {
        $data = $request->validated();

        $general_settings = General::where('ulid', $request->generalId)->first();

        $general_settings->company_name = $data['company_name'];
        $general_settings->company_tagline = $data['company_tagline'];
        $general_settings->company_abbrevation = $data['company_abbrevation'];
        $general_settings->company_description = $data['company_description'];
        $general_settings->company_phone = $data['company_phone'];
        $general_settings->company_email = $data['company_email'];
        $general_settings->company_address = $data['company_address'];
        $general_settings->company_seo_description = $data['company_seo_description'];
        $general_settings->company_seo_keywords = $data['company_seo_keywords'];
        $general_settings->company_footer_text = $data['company_footer_text'];
        $general_settings->facebook = $data['facebook'];
        $general_settings->twitter = $data['twitter'];
        $general_settings->instagram = $data['instagram'];

        $general_settings->save();

        return Redirect::back()->with('success', 'Settings Updated Successfully');
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
                Image::make($file)->save($path . '/logo_white.png');
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
                Image::make($file)->save($path . '/logo_dark.png');
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
                Image::make($file)->save($path . '/favicon.png');
            } catch (\Exception $exp) {
                $errorMessage = $exp->getMessage();                
                return Redirect::back()->with('error', $errorMessage);
            }
        }

        if ($request->hasFile('company_seo')) {
            try {
                $file = $request->company_seo;
                $path = imagePath()['seo']['path'];
                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }
                Image::make($file)->save($path . '/seo.png');
            } catch (\Exception $exp) {
                $errorMessage = $exp->getMessage();                
                return Redirect::back()->with('error', $errorMessage);
            }
        }

        return Redirect::back()->with('success', 'Image Updated Successfully');
    }
}
