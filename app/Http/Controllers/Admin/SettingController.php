<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $appData = AppData::getAppData();
        return view('admin.settings.index', compact('appData'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'app_name' => 'required|string|max:255',
            'school_name' => 'required|string|max:255',
            'school_address' => 'nullable|string',
            'school_phone' => 'nullable|string|max:50',
            'school_email' => 'nullable|email|max:255',
            'school_logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png|max:1024',
            'headmaster_name' => 'nullable|string|max:255',
            'headmaster_nip' => 'nullable|string|max:50',
            'school_accreditation' => 'nullable|string|max:10',
            'school_npsn' => 'nullable|string|max:20',
            'school_vision' => 'nullable|string',
            'school_mission' => 'nullable|string',
        ]);

        $appData = AppData::getAppData();

        // Handle logo upload
        if ($request->hasFile('school_logo')) {
            // Delete old logo if exists
            if ($appData->school_logo && Storage::disk('public')->exists($appData->school_logo)) {
                Storage::disk('public')->delete($appData->school_logo);
            }

            // Store new logo
            $logoPath = $request->file('school_logo')->store('logos', 'public');
            $appData->school_logo = $logoPath;
        }

        // Handle favicon upload
        if ($request->hasFile('favicon')) {
            // Delete old favicon if exists
            if ($appData->favicon && Storage::disk('public')->exists($appData->favicon)) {
                Storage::disk('public')->delete($appData->favicon);
            }

            // Store new favicon
            $faviconPath = $request->file('favicon')->store('logos', 'public');
            $appData->favicon = $faviconPath;
        }

        // Update other fields
        $appData->app_name = $request->app_name;
        $appData->school_name = $request->school_name;
        $appData->school_address = $request->school_address;
        $appData->school_phone = $request->school_phone;
        $appData->school_email = $request->school_email;
        $appData->headmaster_name = $request->headmaster_name;
        $appData->headmaster_nip = $request->headmaster_nip;
        $appData->school_accreditation = $request->school_accreditation;
        $appData->school_npsn = $request->school_npsn;
        $appData->school_vision = $request->school_vision;
        $appData->school_mission = $request->school_mission;

        $appData->save();

        return redirect()->route('admin.settings.index')
            ->with('success', 'Pengaturan aplikasi berhasil diperbarui.');
    }
}
