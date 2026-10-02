<?php

namespace App\View\Composers;

use App\Models\Category;
use App\Models\Page;
use App\Models\SocialLink;
use App\Services\SettingService;
use Illuminate\View\View;

class GlobalComposer
{
    protected SettingService $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    public function compose(View $view): void
    {
        $settings = $this->settingService->all();
        $socialLinks = SocialLink::active()->get();
        $menuCategories = Category::inMenu()->get();
        $menuPages = Page::active()->where('show_in_menu', true)->get();
        $footerPages = Page::active()->where('show_in_footer', true)->get();

        $view->with([
            'settings' => $settings,
            'globalSettings' => $settings,
            'socialLinks' => $socialLinks,
            'globalSocialLinks' => $socialLinks,
            'menuCategories' => $menuCategories,
            'globalMenuCategories' => $menuCategories,
            'menuPages' => $menuPages,
            'footerPages' => $footerPages,
        ]);
    }
}

