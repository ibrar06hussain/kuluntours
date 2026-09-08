<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Faq;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::active()->get()->groupBy(function ($item) {
            return $item->category ?: 'General Inquiries';
        });

        return view('front.faqs', compact('faqs'));
    }
}
