@extends('admin.layouts.app')

@section('title', 'Site Settings')
@section('page-title', 'Global Website Settings')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- General Company Information -->
            <div class="content-card mb-4">
                <div class="card-header"><i class="fas fa-building text-primary me-2"></i>Company & Contact Details</div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Company / Brand Name</label>
                            <input type="text" name="site_name" class="form-control" value="{{ $settings['site_name'] ?? 'Kunlun Treks and Tours' }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Brand Tagline</label>
                            <input type="text" name="site_tagline" class="form-control" value="{{ $settings['site_tagline'] ?? 'Adventure Beyond Boundaries' }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Primary Phone</label>
                            <input type="text" name="phone" class="form-control" value="{{ $settings['phone'] ?? '' }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Emergency / Mobile Phone</label>
                            <input type="text" name="phone_2" class="form-control" value="{{ $settings['phone_2'] ?? '' }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">WhatsApp Direct Number</label>
                            <input type="text" name="whatsapp_number" class="form-control" value="{{ $settings['whatsapp_number'] ?? '' }}" placeholder="e.g. +923001234567">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Official Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $settings['email'] ?? 'info@kunluntreks.com' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Headquarters Address</label>
                            <input type="text" name="address" class="form-control" value="{{ $settings['address'] ?? 'Skardu, Gilgit-Baltistan, Pakistan' }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Branding Assets -->
            <div class="content-card mb-4">
                <div class="card-header"><i class="fas fa-palette text-warning me-2"></i>Logos & Branding</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Website Logo</label>
                            @if(!empty($settings['logo']))
                                <div class="mb-2 p-2 bg-dark rounded d-inline-block">
                                    <img src="{{ asset('uploads/' . $settings['logo']) }}" alt="Logo" style="max-height: 50px;">
                                </div>
                            @endif
                            <input type="file" name="logo" class="form-control" accept="image/*">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Browser Favicon</label>
                            @if(!empty($settings['favicon']))
                                <div class="mb-2 p-2 bg-light rounded d-inline-block">
                                    <img src="{{ asset('uploads/' . $settings['favicon']) }}" alt="Favicon" style="max-height: 32px;">
                                </div>
                            @endif
                            <input type="file" name="favicon" class="form-control" accept="image/*">
                        </div>
                    </div>
                </div>
            </div>

            <!-- SEO & Footer -->
            <div class="content-card mb-4">
                <div class="card-header"><i class="fas fa-globe text-info me-2"></i>Global SEO & Footer Text</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Global SEO Meta Title</label>
                        <input type="text" name="meta_title" class="form-control" value="{{ $settings['meta_title'] ?? '' }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Global SEO Meta Description</label>
                        <textarea name="meta_description" rows="2" class="form-control">{{ $settings['meta_description'] ?? '' }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Footer Copyright Text</label>
                        <input type="text" name="footer_text" class="form-control" value="{{ $settings['footer_text'] ?? '' }}">
                    </div>

                    <div class="mb-0">
                        <label class="form-label fw-bold">Google Analytics Tracking ID / Header Scripts</label>
                        <textarea name="google_analytics" rows="2" class="form-control font-monospace" placeholder="e.g. G-XXXXXXXXXX or <script>...</script>">{{ $settings['google_analytics'] ?? '' }}</textarea>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end mb-5">
                <button type="submit" class="btn btn-primary btn-lg px-5">
                    <i class="fas fa-save me-2"></i>Save All Settings
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
