@extends('front.layouts.app')

@section('title', 'Frequently Asked Questions - Kunlun Treks and Tours')
@section('meta_description', 'Answers to common questions about Pakistan trekking visas, physical fitness requirements, high-altitude safety, meals, and booking terms.')

@section('content')
<!-- Header -->
<section class="py-5 text-white position-relative" style="background: linear-gradient(135deg, #111418 0%, #1A1E24 60%, #8A0B14 100%); border-bottom: 3px solid var(--brand-gold);">
    <div class="container py-4 text-center">
        <span class="section-tag" style="color: var(--brand-gold-light);">Got Questions?</span>
        <h1 class="display-4 fw-bold font-heading text-white mb-2">Frequently Asked Questions</h1>
        <p class="text-light opacity-75 max-w-700 mx-auto">Everything you need to know about traveling, trekking, and climbing in Northern Pakistan.</p>
    </div>
</section>

<!-- FAQs Accordion by Category -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                @forelse($faqs as $categoryName => $faqList)
                    <div class="mb-5">
                        <h4 class="fw-bold font-heading mb-3 border-bottom pb-2" style="color: var(--brand-red);">
                            <i class="fas fa-folder-open text-warning me-2"></i>{{ $categoryName }}
                        </h4>
                        <div class="accordion border rounded-4 overflow-hidden shadow-sm mb-4" id="accordion{{ Str::slug($categoryName) }}">
                            @foreach($faqList as $idx => $faq)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{ Str::slug($categoryName) }}{{ $idx }}">
                                        <button class="accordion-button {{ $idx == 0 ? '' : 'collapsed' }} fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ Str::slug($categoryName) }}{{ $idx }}">
                                            {{ $faq->question }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ Str::slug($categoryName) }}{{ $idx }}" class="accordion-collapse collapse {{ $idx == 0 ? 'show' : '' }}" data-bs-parent="#accordion{{ Str::slug($categoryName) }}">
                                        <div class="accordion-body text-secondary lh-lg">
                                            {!! $faq->answer !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5 text-muted">
                        <p>No FAQs available right now.</p>
                    </div>
                @endforelse

                <!-- Contact Box -->
                <div class="p-4 p-md-5 rounded-4 bg-light border text-center mt-5">
                    <h4 class="fw-bold font-heading mb-2">Still Have Questions?</h4>
                    <p class="text-muted max-w-700 mx-auto mb-4">Can't find the answer you're looking for? Please contact our friendly mountain expedition team.</p>
                    <a href="{{ route('contact') }}" class="btn btn-brand-primary px-4 me-2">
                        <i class="fas fa-envelope me-1"></i>Contact Us
                    </a>
                    @if(!empty($globalSettings['whatsapp_number']))
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $globalSettings['whatsapp_number']) }}" target="_blank" class="btn btn-outline-success px-4">
                            <i class="fab fa-whatsapp me-1"></i>WhatsApp Us
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
