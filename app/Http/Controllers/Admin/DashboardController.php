<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Category;
use App\Models\Inquiry;
use App\Models\Package;
use App\Models\Testimonial;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'packages' => Package::count(),
            'categories' => Category::count(),
            'testimonials' => Testimonial::count(),
            'inquiries' => Inquiry::count(),
            'unread_inquiries' => Inquiry::unread()->count(),
            'blog_posts' => BlogPost::count(),
        ];

        $recentInquiries = Inquiry::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentInquiries'));
    }
}
