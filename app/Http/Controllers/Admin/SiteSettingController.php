<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Services\MediaService;
use App\Services\SettingService;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    protected SettingService $settingService;
    protected MediaService $mediaService;

    public function __construct(SettingService $settingService, MediaService $mediaService)
    {
        $this->settingService = $settingService;
        $this->mediaService = $mediaService;
    }

    public function index()
    {
        $settings = $this->settingService->all();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except(['_token', '_method', 'logo', 'favicon']);

        foreach ($data as $key => $value) {
            $this->settingService->set($key, $value);
        }

        if ($request->hasFile('logo')) {
            $currentLogo = $this->settingService->get('logo');
            if ($currentLogo) {
                $this->mediaService->delete($currentLogo);
            }
            $logoPath = $this->mediaService->upload($request->file('logo'), 'settings');
            $this->settingService->set('logo', $logoPath);
        }

        if ($request->hasFile('favicon')) {
            $currentFavicon = $this->settingService->get('favicon');
            if ($currentFavicon) {
                $this->mediaService->delete($currentFavicon);
            }
            $faviconPath = $this->mediaService->upload($request->file('favicon'), 'settings');
            $this->settingService->set('favicon', $faviconPath);
        }

        return redirect()->route('admin.settings.index')->with('success', 'Site settings updated successfully.');
    }
}
