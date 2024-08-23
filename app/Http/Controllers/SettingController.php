<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::where('user_id', auth()->id())->get()->keyBy('setting_key');
        return view('setting.setting_update', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'address' => 'required|string|max:255',
        ]);

        $settings = [];

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $destinationPath = 'img/'; // Set your custom path here
            $logoName = time() . '_' . $logo->getClientOriginalName(); // Create a unique filename
            $logo->move(public_path($destinationPath), $logoName); // Move the file to the destination path
            $settings['logo'] = $destinationPath . $logoName; // Store the path in the database
        }

        // Handle address update
        $settings['address'] = $request->address;

        // Save settings
        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(
                ['setting_key' => $key, 'user_id' => auth()->id()],
                ['setting_value' => $value]
            );
        }

        return redirect()->route('settings.index')->with('success', 'Settings updated successfully!');
    }
}
