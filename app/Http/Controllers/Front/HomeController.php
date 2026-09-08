<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Category;
use App\Models\HomepageSection;
use App\Models\Package;
use App\Models\Slider;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::active()->get();
        $sections = HomepageSection::active()->get()->keyBy('section_key');
        $categories = Category::active()->with('activePackages')->get();
        $featuredPackages = Package::featured()->with('category')->take(6)->get();
        $fixedDepartures = Package::fixedDeparture()->with('category')->take(4)->get();
        $testimonials = Testimonial::active()->get();
        $latestPosts = BlogPost::published()->take(3)->get();

        return view('front.home', compact(
            'sliders',
            'sections',
            'categories',
            'featuredPackages',
            'fixedDepartures',
            'testimonials',
            'latestPosts'
        ));
    }
}
