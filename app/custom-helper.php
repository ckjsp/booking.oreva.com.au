<?php

if (!function_exists('asset_url')) {
    function asset_url($path = '')
    {
        // Assuming your assets are directly in the public directory
        return asset($path);
    }
}

if (!function_exists('get_setting')) {
    /**
     * Retrieve a setting value by its key.
     *
     * @param string $key
     * @return string|null
     */
    function get_setting($key)
    {
        return \App\Models\Setting::getValue($key);
    }
}