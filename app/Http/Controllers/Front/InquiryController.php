<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\Package;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'package_id' => 'nullable|exists:packages,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'country' => 'nullable|string|max:100',
            'travelers_count' => 'nullable|integer|min:1',
            'preferred_date' => 'nullable|date',
            'message' => 'required|string',
        ]);

        $validated['source'] = $request->filled('package_id') ? 'package_booking' : 'general_inquiry';
        $validated['status'] = 'new';

        if ($request->filled('package_id')) {
            $package = Package::find($request->package_id);
            if ($package) {
                $validated['subject'] = 'Booking Inquiry: ' . $package->title;
            }
        }

        Inquiry::create($validated);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you for your inquiry! Our expedition team will review your request and get back to you shortly.'
            ]);
        }

        return back()->with('success', 'Thank you for your inquiry! Our expedition team will review your request and get back to you shortly.');
    }
}
