@extends('front.layouts.app')

@section('title', 'Contact Us - Kunlun Treks and Tours Pakistan')
@section('meta_description', 'Contact Kunlun Treks & Tours in Skardu, Gilgit-Baltistan. Send an inquiry for private guided treks, peak expeditions, or custom mountain adventures.')

@section('content')
<!-- Header -->
<section class="py-5 bg-dark text-white position-relative" style="background: linear-gradient(180deg, #07151F 0%, #0C2333 100%);">
    <div class="container py-4 text-center">
        <span class="section-tag">Get in Touch</span>
        <h1 class="display-4 fw-bold font-heading text-white mb-2">Contact Expedition Team</h1>
        <p class="text-light opacity-75 max-w-700 mx-auto">We are here to answer your questions on routes, gear, permits, and personalized Karakoram itineraries.</p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row g-5">
            <!-- Contact Details -->
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-light h-100">
                    <span class="section-tag">Base Camp Headquarters</span>
                    <h3 class="fw-bold font-heading mb-4">Kunlun Treks & Tours</h3>

                    <div class="d-flex align-items-start gap-3 mb-4">
                        <div class="bg-warning text-dark rounded-circle p-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 45px; height: 45px;">
                            <i class="fas fa-map-marker-alt fs-5"></i>
                        </div>
                        <div>
                            <div class="fw-bold text-dark">Office Address</div>
                            <p class="text-muted small mb-0">{{ $globalSettings['address'] ?? 'Skardu, Gilgit-Baltistan, Pakistan' }}</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-start gap-3 mb-4">
                        <div class="bg-warning text-dark rounded-circle p-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 45px; height: 45px;">
                            <i class="fas fa-envelope fs-5"></i>
                        </div>
                        <div>
                            <div class="fw-bold text-dark">Email Inquiries</div>
                            <p class="text-muted small mb-0"><a href="mailto:{{ $globalSettings['email'] ?? 'info@kunluntreks.com' }}" class="text-secondary text-decoration-none">{{ $globalSettings['email'] ?? 'info@kunluntreks.com' }}</a></p>
                        </div>
                    </div>

                    @if(!empty($globalSettings['phone']))
                        <div class="d-flex align-items-start gap-3 mb-4">
                            <div class="bg-warning text-dark rounded-circle p-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 45px; height: 45px;">
                                <i class="fas fa-phone fs-5"></i>
                            </div>
                            <div>
                                <div class="fw-bold text-dark">Phone Lines</div>
                                <p class="text-muted small mb-0">{{ $globalSettings['phone'] }}</p>
                            </div>
                        </div>
                    @endif

                    @if(!empty($globalSettings['whatsapp_number']))
                        <div class="d-flex align-items-start gap-3 mb-4">
                            <div class="bg-success text-white rounded-circle p-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 45px; height: 45px;">
                                <i class="fab fa-whatsapp fs-5"></i>
                            </div>
                            <div>
                                <div class="fw-bold text-dark">WhatsApp 24/7 Support</div>
                                <p class="text-muted small mb-0"><a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $globalSettings['whatsapp_number']) }}" target="_blank" class="text-success text-decoration-none fw-bold">{{ $globalSettings['whatsapp_number'] }}</a></p>
                            </div>
                        </div>
                    @endif

                    <div class="mt-auto pt-4 border-top">
                        <div class="small fw-bold text-dark mb-2">Connect On Social Media</div>
                        <div class="d-flex gap-2">
                            @foreach($globalSocialLinks as $social)
                                <a href="{{ $social->url }}" target="_blank" class="btn btn-dark btn-sm rounded-circle" style="width: 38px; height: 38px; display: flex; align-items: center; justify-content: center;">
                                    <i class="{{ $social->icon_class }}"></i>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-lg-7">
                <div class="card border rounded-4 p-4 p-md-5 shadow-sm">
                    <span class="section-tag">Send A Direct Message</span>
                    <h3 class="fw-bold font-heading mb-4">How Can We Help You?</h3>

                    <div id="contactSuccessAlert" class="alert alert-success d-none mb-4">
                        <i class="fas fa-check-circle me-2"></i>Thank you! Your message has been received. Our mountain expedition team will respond within 24 hours.
                    </div>

                    <form id="contactForm" action="{{ route('contact.submit') }}" method="POST">
                        @csrf

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted">Full Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="John Doe" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted">Email Address <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" placeholder="john@example.com" required>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted">Phone Number</label>
                                <input type="text" name="phone" class="form-control" placeholder="+1-...">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted">Country of Residence</label>
                                <input type="text" name="country" class="form-control" placeholder="e.g. Germany, UK, USA">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small text-muted">Subject</label>
                            <input type="text" name="subject" class="form-control" placeholder="e.g. K2 Trek Inquiry for July 2026">
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold small text-muted">Your Message / Requirements <span class="text-danger">*</span></label>
                            <textarea name="message" rows="5" class="form-control" placeholder="Tell us about your travel dates, group size, fitness experience, or questions..." required></textarea>
                        </div>

                        <button type="submit" id="contactSubmitBtn" class="btn btn-brand-primary btn-lg px-5 shadow">
                            <i class="fas fa-paper-plane me-2"></i>Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    $('#contactForm').on('submit', function(e) {
        e.preventDefault();
        let form = $(this);
        let btn = $('#contactSubmitBtn');

        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Sending...');

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function(response) {
                $('#contactSuccessAlert').removeClass('d-none');
                form[0].reset();
                btn.prop('disabled', false).html('<i class="fas fa-check me-2"></i>Message Sent!');
                setTimeout(() => {
                    btn.html('<i class="fas fa-paper-plane me-2"></i>Send Message');
                }, 4000);
            },
            error: function(err) {
                btn.prop('disabled', false).html('<i class="fas fa-paper-plane me-2"></i>Send Message');
                alert('Something went wrong. Please check your inputs and try again.');
            }
        });
    });
</script>
@endpush
