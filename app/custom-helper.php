<?php

if (!function_exists('asset_url')) {
    function asset_url($path = '')
    {
        // Assuming your assets are directly in the public directory
        return asset($path);
    }
}