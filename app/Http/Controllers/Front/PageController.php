<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\TeamMember;

class PageController extends Controller
{
    public function show(Page $page)
    {
        if (!$page->is_active) {
            abort(404);
        }

        $teamMembers = [];
        if ($page->slug === 'about-us') {
            $teamMembers = TeamMember::active()->get();
        }

        return view('front.pages.show', compact('page', 'teamMembers'));
    }
}
