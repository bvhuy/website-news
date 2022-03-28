<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// use App\Validator\HashRule;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        // $this->registerRule();

        // Load helper
        if (\File::exists(__DIR__ . '/../helper/helper.php')) {
            include __DIR__ . '/../helper/helper.php';
        }

        $this->registerPolicies();
        $this->registerFormComponents();

        Validator::extend('file_extension', function ($attribute, $value, $parameters, $validator) {
            if (!$value instanceof UploadedFile) {
                return false;
            }

            $extensions = implode(',', $parameters);
            $validator->addReplacer('file_extension', function (
                $message,
                $attribute,
                $rule,
                $parameters
            ) use ($extensions) {
                return \str_replace(':values', $extensions, $message);
            });

            $extension = strtolower($value->getClientOriginalExtension());

            return $extension !== '' && in_array($extension, $parameters);
        });
    }

    public function register()
    {
        include __DIR__ . '/../helper/helper.php';
        //
        \Menu::registerType('Danh mục bài viết', \App\Models\Category::class);
        // \Menu::registerType('Bài viết', \App\Models\News::class);
        // \Menu::registerType('Trang tĩnh', \App\Models\Page::class);
        // $this->registerAdminMenu();
    }


    private function registerFormComponents()
    {
        \Form::component('ajax', 'admin.components.ajax-form', ['params']);
        // \Form::component('icheck', 'Cms::components.icheck', ['name', 'value', 'params']);
        \Form::component('tinymce', 'admin.components.tinymce', ['name', 'content', 'params']);
        \Form::component('btnSaveCancel', 'admin.components.btn-save-cancel', []);
        // \Form::component('btnMediaBox', 'Cms::components.form-chose-media', ['name', 'value', 'url_image_preview']);
        \Form::component('btnSaveNew', 'admin.components.btn-save-new', []);
        \Form::component('btnSaveOut', 'admin.components.btn-save-out', []);
        // \Form::component('findUser', 'Cms::components.form-find-user', ['name', 'selected']);
    }

    // private function registerRule()
    // {
    //     \Validator::resolver(function ($translator, $data, $rules, $messages) {
    //         return new HashRule($translator, $data, $rules, $messages);
    //     });
    // }


    public function registerPolicies()
    {


        \AccessControl::define('Quản lý hình ảnh', 'admin.file.image.index');
        \AccessControl::define('Người dùng - Quản lý', 'admin.user.manage');
        \AccessControl::define('Người dùng - Quản lý vai trò', 'admin.role.manage');

        // \AccessControl::define('Quản lý hình ảnh', 'admin.tinymce');

        \AccessControl::define('Trang tổng quan', 'admin.index');
        \AccessControl::define('Cài đặt - Cài đặt chung', 'admin.setting.general');
        // \AccessControl::define('File - Upload file', 'admin.file.upload');
        // \AccessControl::define('File - File browser', 'admin.file.browser');
        // \AccessControl::define('Module Control - Xem module', 'admin.module-control.module.index');
        // \AccessControl::define('Module Control - Xem theme', 'admin.module-control.theme.index');

        //User


        // \AccessControl::define('Người dùng - Xem chi tiết', 'admin.user.show');
        // \AccessControl::define('Người dùng - Thêm người mới', 'admin.user.create');

        // \AccessControl::define('Người dùng - Chỉnh sửa', 'admin.user.edit');

        // \AccessControl::define('Người dùng - Cấm', 'admin.user.disable');
        // \AccessControl::define('Người dùng - Khôi phục', 'admin.user.enable');
        // \AccessControl::define('Người dùng - Xóa', 'admin.user.destroy');

        // \AccessControl::define('Người dùng - Đăng nhập với tư cách', 'admin.user.login-as');

        //Role

        // \AccessControl::define('Người dùng - Thêm vài trò mới', 'admin.role.create');
        // \AccessControl::define('Người dùng - Chỉnh sửa vai trò', 'admin.role.edit');
        // \AccessControl::define('Người dùng - Xóa vai trò', 'admin.role.destroy');

        // News
        \AccessControl::define(trans('news.news') . ' - ' . trans('news.list-news'), 'admin.news.index');
        \AccessControl::define(trans('news.news') . ' - ' . trans('news.add-new-news'), 'admin.news.create');

        \AccessControl::define(trans('news.news') . ' - ' . trans('news.edit-news'), 'admin.news.edit');

        \AccessControl::define(trans('news.news') . ' - ' . trans('news.disable-news'), 'admin.news.disable');
        \AccessControl::define(trans('news.news') . ' - ' . trans('news.enable-news'), 'admin.news.enable');
        \AccessControl::define(trans('news.news') . ' - ' . trans('news.destroy-news'), 'admin.news.destroy');

        //Category
        \AccessControl::define(trans('news.news') . ' - ' . trans('news.category.list-category'), 'admin.category.index');
        \AccessControl::define(trans('news.news') . ' - ' . trans('news.category.add-new-category'), 'admin.category.create');
        \AccessControl::define(trans('news.news') . ' - ' . trans('news.category.edit-category'), 'admin.category.edit');

        \AccessControl::define(trans('news.news') . ' - ' . trans('news.category.sort'), 'admin.category.sort');

        \AccessControl::define(trans('news.news') . ' - ' . trans('news.category.disable-category'), 'admin.category.disable');
        \AccessControl::define(trans('news.news') . ' - ' . trans('news.category.enable-category'), 'admin.category.enable');


        \AccessControl::define(trans('news.news') . ' - ' . trans('news.category.destroy'), 'admin.category.destroy');

        // Menu
        \AccessControl::define(trans('menu.menu') . ' - ' . trans('menu.list-menu'), 'admin.menu.index');
        \AccessControl::define(trans('menu.menu') . ' - ' . trans('menu.add-new-menu'), 'admin.menu.create');
        \AccessControl::define(trans('menu.menu') . ' - ' . trans('menu.edit-menu'), 'admin.menu.edit');

        \AccessControl::define(trans('menu.menu') . ' - ' . trans('menu.sort'), 'admin.menu.sort');

        \AccessControl::define(trans('menu.menu') . ' - ' . trans('menu.disable-menu'), 'admin.menu.disable');
        \AccessControl::define(trans('menu.menu') . ' - ' . trans('menu.enable-menu'), 'admin.menu.enable');

        \AccessControl::define(trans('menu.menu') . ' - ' . trans('menu.destroy-menu'), 'admin.menu.destroy');

        //Category Video
        \AccessControl::define(trans('video.video') . ' - ' . trans('video.category.list-category'), 'admin.category.video.index');
        \AccessControl::define(trans('video.video') . ' - ' . trans('video.category.add-new-category'), 'admin.category.video.create');
        \AccessControl::define(trans('video.video') . ' - ' . trans('video.category.edit-category'), 'admin.category.video.edit');

        \AccessControl::define(trans('video.video') . ' - ' . trans('video.category.sort'), 'admin.category.video.sort');

        \AccessControl::define(trans('video.video') . ' - ' . trans('video.category.disable-category'), 'admin.category.video.disable');
        \AccessControl::define(trans('video.video') . ' - ' . trans('video.category.enable-category'), 'admin.category.video.enable');


        \AccessControl::define(trans('video.video') . ' - ' . trans('video.category.destroy'), 'admin.category.video.destroy');

        // News
        \AccessControl::define(trans('video.video') . ' - ' . trans('video.list-video'), 'admin.video.index');
        \AccessControl::define(trans('video.video') . ' - ' . trans('video.add-new-video'), 'admin.video.create');

        \AccessControl::define(trans('video.video') . ' - ' . trans('video.edit-video'), 'admin.video.edit');

        \AccessControl::define(trans('video.video') . ' - ' . trans('video.disable-video'), 'admin.video.disable');
        \AccessControl::define(trans('video.video') . ' - ' . trans('video.enable-video'), 'admin.video.enable');
        \AccessControl::define(trans('video.video') . ' - ' . trans('video.destroy-video'), 'admin.video.destroy');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
}
