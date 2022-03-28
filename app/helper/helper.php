<?php
include __DIR__ . '/constant.php';


if (!function_exists('setting')) {
    function setting($key = null, $default = null)
    {
        if (is_null($key)) {
            return app(\App\Services\Setting::class);
        }

        return \Setting::get($key, $default);
    }
}
if (!function_exists('upload_url')) {
    function upload_url($path = null, $parameters = [], $secure = null)
    {
        return url('assets/admin/images/' . $path, $parameters, $secure);
    }
}

if (!function_exists('add_action')) {
    function add_action($hook, $callback, $priority = 20)
    {
        \Action::addListener($hook, $callback, $priority);
    }
}
