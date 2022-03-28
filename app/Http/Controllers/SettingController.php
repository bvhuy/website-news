<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Storage;

class SettingController extends AppController
{
    public function authCheck()
    {
        if (!auth()->check()) {
            abort(404);
        } else if (auth()->user()->isDisable()) {
            abort(403, 'This action is unauthorized.');
        }
    }
    public function general()
    {
        $this->authCheck();
        $this->data['website_name'] = setting('website-name');
        $this->data['website_url'] = setting('website-url');
        $this->data['website_address'] = setting('website-address');
        $this->data['facebook_app_id'] = setting('facebook-app-id');
        $this->data['website_phone'] = setting('website-phone');
        $this->data['website_email'] = setting('website-email');
        $this->data['website_about'] = setting('website-about');

        $this->data['logo'] = setting('logo', upload_url('70x70no-thumbnail.png'));
        $this->data['default_thumbnail'] = setting('default-thumbnail', upload_url('70x70no-thumbnail.png'));

        $this->data['favicon'] = setting('favicon', upload_url('70x70no-thumbnail.png'));

        $this->data['home_title'] = setting('home-title');
        $this->data['home_description'] = setting('home-description');
        $this->data['home_keyword'] = setting('home-keyword');

        $this->data['search_title'] = setting('search-title');
        $this->data['search_description'] = setting('search-description');
        $this->data['search_keyword'] = setting('search-keyword');

        $this->data['social_facebook'] = setting('social-facebook');
        $this->data['social_youtube'] = setting('social-youtube');
        $this->data['social_zalo'] = setting('social-zalo');

        return view('admin.setting.general', $this->data);
    }
    public function generalUpdate(Request $request)
    {
        $this->authCheck();
        $this->validate($request, [
            'website_name' => 'required',
            'website_url' => 'required',
            'website_phone' => 'required',
            'website_email' => 'required|email',
            'website_address' => 'required',
            'facebook_app_id' => 'required|integer',
            'website_about' => 'required',
            'home_title' => 'required',
            'home_keyword' => 'required',
            'home_description' => 'required',
            'search_title' => 'required',
            'search_keyword' => 'required',
            'search_description' => 'required',
            'social_facebook' => 'nullable|url|regex:/http(?:s):\/\/(?:www\.)facebook\.com\/.+/i',
            'social_youtube' => 'nullable|url|regex:/http(?:s):\/\/(?:www\.)youtube\.com\/.+/i',
            'social_zalo' => 'nullable|url|regex:/http(?:s):\/\/(?:www\.)zalo\.me\/.+/i',
        ]);

        setting()->sync('website-name', $request->input('website_name'));
        setting()->sync('website-url', $request->input('website_url'));
        setting()->sync('website-email', $request->input('website_email'));
        setting()->sync('website-phone', $request->input('website_phone'));
        setting()->sync('website-address', $request->input('website_address'));
        setting()->sync('facebook-app-id', $request->input('facebook_app_id'));
        setting()->sync('website-about', $request->input('website_about'));
        if ($request->hasFile('logo')) {
            $this->validate(
                $request,
                [
                    'logo' => [
                        'bail',
                        'image',
                        'file_extension:jpeg,png,jpg',
                        'mimes:jpeg,png,jpg',
                        'mimetypes:image/jpeg,image/png,image/jpg'
                    ]
                ],
                [
                    'logo.file_extension' => 'File ảnh không hợp lệ'
                ]
            );


            Storage::disk('public')->delete('setting/logo/' . setting('logo_filename'));

            $logo_file = $request->file('logo');
            $logo_filename = uniqid() . '-' . now()->timestamp . '.' . $logo_file->getClientOriginalExtension();
            $logo_path = $request->file('logo')->storeAs('setting/logo', $logo_filename, 'public');
            // Storage::disk('public')->setVisibility($path, 'public');
            $logo = Storage::disk('public')->url($logo_path);

            setting()->sync('logo', $logo);
            setting()->sync('logo-filename', basename($logo_path));
        }

        if ($request->hasFile('default_thumbnail')) {

            $this->validate(
                $request,
                [
                    'default_thumbnail' => [
                        'bail',
                        'image',
                        'file_extension:jpeg,png,jpg',
                        'mimes:jpeg,png,jpg',
                        'mimetypes:image/jpeg,image/png,image/jpg'
                    ]
                ],
                [
                    'default_thumbnail.file_extension' => 'File ảnh không hợp lệ'
                ]
            );


            Storage::disk('public')->delete('setting/thumbnail/' . setting('logo_filename'));

            $thumbnail_file = $request->file('default_thumbnail');
            $thumbnail_filename = uniqid() . '-' . now()->timestamp . '.' . $thumbnail_file->getClientOriginalExtension();
            $thumbnail_path = $request->file('default_thumbnail')->storeAs('setting/thumbnail', $thumbnail_filename, 'public');
            // Storage::disk('public')->setVisibility($path, 'public');
            $thumbnail = Storage::disk('public')->url($thumbnail_path);

            setting()->sync('default-thumbnail', $thumbnail);
            setting()->sync('default-thumbnail-filename', basename($thumbnail_path));
        }

        if ($request->hasFile('favicon')) {
            $this->validate(
                $request,
                [
                    'favicon' => [
                        'bail',
                        'file_extension:jpeg,png,jpg,ico',
                        'mimes:jpeg,png,jpg,ico',
                        'mimetypes:image/jpeg,image/png,image/jpg,image/x-icon,image/vnd.microsoft.icon'
                    ]
                ],
                [
                    'favicon.file_extension' => 'File ảnh không hợp lệ'
                ]
            );


            Storage::disk('public')->delete('setting/favicon/' . setting('favicon_filename'));

            $favicon_file = $request->file('favicon');
            $favicon_filename = uniqid() . '-' . now()->timestamp . '.' . $favicon_file->getClientOriginalExtension();
            $favicon_path = $request->file('favicon')->storeAs('setting/favicon', $favicon_filename, 'public');
            // Storage::disk('public')->setVisibility($path, 'public');
            $favicon = Storage::disk('public')->url($favicon_path);

            setting()->sync('favicon', $favicon);
            setting()->sync('favicon-filename', basename($favicon_path));
        }


        setting()->sync('home-title', $request->input('home_title'));
        setting()->sync('home-description', $request->input('home_description'));
        setting()->sync('home-keyword', $request->input('home_keyword'));
        setting()->sync('search-title', $request->input('search_title'));
        setting()->sync('search-description', $request->input('search_description'));
        setting()->sync('search-keyword', $request->input('search_keyword'));
        setting()->sync('social-facebook', $request->input('social_facebook'));
        setting()->sync('social-youtube', $request->input('social_youtube'));
        setting()->sync('social-zalo', $request->input('social_zalo'));

        if ($request->ajax()) {

            $response = [
                'title' => 'Thành công',
                'message' => 'Đã lưu cài đặt',
            ];

            if ($request->exists('save_only')) {
                $response['redirect'] = route('admin.setting.general');
            }
            return response()->json($response, 200);
        }

        return redirect()->back();
    }
}
