@extends('front.layouts.app')

@section('title', ($package->meta_title ?: $package->title) . ' - Kunlun Treks and Tours')
@section('meta_description', $package->meta_description ?: Str::limit(strip_tags($package->short_description ?: $package->description), 160))

@section('content')
<!-- Hero Header -->
<section class="position-relative text-white py-5" style="background: linear-gradient(180deg, rgba(7,21,31,0.65) 0%, rgba(12,35,51,0.92) 100%), url('{{ Str::startsWith($package->featured_image, 'http') ? $package->featured_image : asset('uploads/' . $package->featured_image) }}') center/cover no-repeat; min-height: 420px; display: flex; align-items: center;">
    <div class="container py-4">
        <div class="row">
            <div class="col-lg-8">
                <div class="d-flex flex-wrap gap-2 mb-3">
                    <span class="badge bg-warning text-dark fw-bold px-3 py-2"><i class="fas fa-mountain me-1"></i>{{ $package->category->name ?? 'Trek' }}</span>
                    @if($package->difficulty_level)
                        <span class="badge bg-light text-dark fw-semibold px-3 py-2 text-capitalize"><i class="fas fa-tachometer-alt me-1"></i>{{ $package->difficulty_level }}</span>
                    @endif
                    @if($package->is_fixed_departure && $package->departure_date)
                        <span class="badge bg-danger text-white fw-bold px-3 py-2"><i class="fas fa-calendar-check me-1"></i>Departing: {{ $package->departure_date->format('M d, Y') }}</span>
                    @endif
                </div>

                <h1 class="display-4 fw-bold font-heading text-white mb-2">{{ $package->title }}</h1>
                @if($package->short_description)
                    <p class="lead text-light opacity-90 mb-4">{{ $package->short_description }}</p>
                @endif

                <div class="d-flex flex-wrap gap-4 text-light small">
                    <span><i class="fas fa-map-marker-alt text-warning me-2"></i><strong>Start / End:</strong> {{ $package->starting_point ?: 'Skardu' }} / {{ $package->ending_point ?: 'Islamabad' }}</span>
                    <span><i class="fas fa-clock text-warning me-2"></i><strong>Duration:</strong> {{ $package->duration_days }} Days</span>
                    @if($package->max_altitude)
                        <span><i class="fas fa-cloud-upload-alt text-warning me-2"></i><strong>Max Alt:</strong> {{ $package->max_altitude }}</span>
                    @endif
                </div>
            </div>

            <div class="col-lg-4 text-lg-end mt-4 mt-lg-0 align-self-center">
                <div class="d-inline-block bg-dark bg-opacity-75 p-4 rounded-4 border border-secondary shadow-lg text-start">
                    <span class="small text-muted text-uppercase fw-bold">Package Price</span>
                    <div class="display-6 fw-bold text-warning mb-1">${{ number_format($package->price, 0) }}</div>
                    <small class="text-light opacity-75 d-block mb-3">{{ $package->price_note ?: 'Per person (All inclusive)' }}</small>
                    <a href="#bookingSection" class="btn btn-brand-accent w-100 fw-bold">
                        <i class="fas fa-calendar-check me-2"></i>Inquire / Book Now
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Specs Quick Bar -->
<section class="py-3 bg-light border-bottom">
    <div class="container">
        <div class="row g-3 text-center text-md-start">
            <div class="col-6 col-md-3 col-lg-2">
                <div class="d-flex align-items-center gap-2 justify-content-center justify-content-md-start">
                    <i class="fas fa-calendar-day text-warning fs-4"></i>
                    <div>
                        <div class="small text-muted">Duration</div>
                        <div class="fw-bold small">{{ $package->duration_days }} Days</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3 col-lg-2">
                <div class="d-flex align-items-center gap-2 justify-content-center justify-content-md-start">
                    <i class="fas fa-mountain text-warning fs-4"></i>
                    <div>
                        <div class="small text-muted">Max Altitude</div>
                        <div class="fw-bold small">{{ $package->max_altitude ?: 'N/A' }}</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3 col-lg-2">
                <div class="d-flex align-items-center gap-2 justify-content-center justify-content-md-start">
                    <i class="fas fa-sun text-warning fs-4"></i>
                    <div>
                        <div class="small text-muted">Best Season</div>
                        <div class="fw-bold small">{{ $package->best_season ?: 'Summer' }}</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3 col-lg-2">
                <div class="d-flex align-items-center gap-2 justify-content-center justify-content-md-start">
                    <i class="fas fa-users text-warning fs-4"></i>
                    <div>
                        <div class="small text-muted">Group Size</div>
                        <div class="fw-bold small">{{ $package->group_size ?: '2 - 12' }}</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3 col-lg-2">
                <div class="d-flex align-items-center gap-2 justify-content-center justify-content-md-start">
                    <i class="fas fa-tachometer-alt text-warning fs-4"></i>
                    <div>
                        <div class="small text-muted">Difficulty</div>
                        <div class="fw-bold small text-capitalize">{{ $package->difficulty_level ?: 'Moderate' }}</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3 col-lg-2">
                <div class="d-flex align-items-center gap-2 justify-content-center justify-content-md-start">
                    <i class="fas fa-shield-alt text-warning fs-4"></i>
                    <div>
                        <div class="small text-muted">Safety Protocols</div>
                        <div class="fw-bold small">Certified</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Content & Sidebar -->
<section class="py-5">
    <div class="container">
        <div class="row g-5">
            <!-- Left Main Column -->
            <div class="col-lg-8">
                <!-- Overview -->
                <div class="mb-5">
                    <h3 class="fw-bold font-heading mb-3"><i class="fas fa-align-left text-warning me-2"></i>Trip Overview</h3>
                    <div class="lead fs-6 text-secondary lh-lg">
                        {!! $package->description !!}
                    </div>
                </div>

                <!-- Day by Day Itinerary -->
                @if($package->itineraries->count() > 0)
                    <div class="mb-5">
                        <h3 class="fw-bold font-heading mb-4"><i class="fas fa-route text-warning me-2"></i>Day-by-Day Itinerary</h3>
                        <div class="accordion accordion-flush border rounded-4 overflow-hidden shadow-sm" id="itineraryAccordion">
                            @foreach($package->itineraries as $idx => $itn)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{ $idx }}">
                                        <button class="accordion-button {{ $idx == 0 ? '' : 'collapsed' }} fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $idx }}">
                                            <span class="badge bg-warning text-dark me-3">Day {{ $itn->day_number }}</span>
                                            <span class="text-dark">{{ $itn->title }}</span>
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $idx }}" class="accordion-collapse collapse {{ $idx == 0 ? 'show' : '' }}" data-bs-parent="#itineraryAccordion">
                                        <div class="accordion-body text-secondary lh-base">
                                            {{ $itn->description }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Inclusions & Exclusions -->
                @if($package->inclusions->count() > 0 || $package->exclusions->count() > 0)
                    <div class="mb-5">
                        <h3 class="fw-bold font-heading mb-4"><i class="fas fa-list-check text-warning me-2"></i>What's Included & Excluded</h3>
                        <div class="row g-4">
                            <!-- Inclusions -->
                            @if($package->inclusions->count() > 0)
                                <div class="col-md-6">
                                    <div class="p-4 rounded-4 border bg-success-subtle bg-opacity-25 h-100">
                                        <h5 class="fw-bold text-success mb-3"><i class="fas fa-check-circle me-2"></i>Package Includes</h5>
                                        <ul class="list-unstyled mb-0">
                                            @foreach($package->inclusions as $inc)
                                                <li class="mb-2 small d-flex align-items-start gap-2 text-dark">
                                                    <i class="fas fa-check text-success mt-1"></i>
                                                    <span>{{ $inc->description }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif

                            <!-- Exclusions -->
                            @if($package->exclusions->count() > 0)
                                <div class="col-md-6">
                                    <div class="p-4 rounded-4 border bg-danger-subtle bg-opacity-25 h-100">
                                        <h5 class="fw-bold text-danger mb-3"><i class="fas fa-times-circle me-2"></i>Package Excludes</h5>
                                        <ul class="list-unstyled mb-0">
                                            @foreach($package->exclusions as $exc)
                                                <li class="mb-2 small d-flex align-items-start gap-2 text-dark">
                                                    <i class="fas fa-times text-danger mt-1"></i>
                                                    <span>{{ $exc->description }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Gallery Photos -->
                @if($package->images->count() > 0)
                    <div class="mb-5">
                        <h3 class="fw-bold font-heading mb-4"><i class="fas fa-camera text-warning me-2"></i>Expedition Gallery</h3>
                        <div class="row g-3">
                            @foreach($package->images as $img)
                                <div class="col-md-4 col-6">
                                    <img src="{{ Str::startsWith($img->image, 'http') ? $img->image : asset('uploads/' . $img->image) }}" class="rounded-3 img-fluid shadow-sm object-fit-cover w-100" style="height: 180px;" alt="{{ $img->caption ?: $package->title }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Right Booking Sidebar -->
            <div class="col-lg-4">
                <div class="card border rounded-4 p-4 shadow-sm sticky-top" style="top: 90px;" id="bookingSection">
                    <h4 class="fw-bold font-heading mb-1">Book / Inquire About This Trek</h4>
                    <p class="text-muted small mb-4">Send an inquiry and receive a custom itinerary & quotation within 24 hours.</p>

                    <div id="inquirySuccessAlert" class="alert alert-success d-none mb-3">
                        <i class="fas fa-check-circle me-1"></i>Thank you! Your inquiry has been sent successfully. Our expedition team will reply shortly.
                    </div>

                    <form id="packageInquiryForm" action="{{ route('inquiry.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="package_id" value="{{ $package->id }}">

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Your Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="John Doe" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Email Address <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" placeholder="john@example.com" required>
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label class="form-label small fw-bold text-muted">Phone / WhatsApp</label>
                                <input type="text" name="phone" class="form-control" placeholder="+1-...">
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-bold text-muted">Country</label>
                                <input type="text" name="country" class="form-control" placeholder="Germany, UK...">
                            </div>
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label class="form-label small fw-bold text-muted">Travelers</label>
                                <input type="number" name="travelers_count" class="form-control" value="2" min="1">
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-bold text-muted">Target Month/Date</label>
                                <input type="date" name="preferred_date" class="form-control">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted">Special Requests / Questions <span class="text-danger">*</span></label>
                            <textarea name="message" rows="3" class="form-control" placeholder="Let us know your dietary preferences, climbing goals, or group requirements..." required></textarea>
                        </div>

                        <div class="d-grid">
                            <button type="submit" id="submitInquiryBtn" class="btn btn-brand-accent btn-lg shadow">
                                <i class="fas fa-paper-plane me-2"></i>Send Booking Request
                            </button>
                        </div>
                    </form>

                    <div class="mt-4 pt-3 border-top text-center">
                        <small class="text-muted d-block mb-2">Prefer to talk directly?</small>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $globalSettings['whatsapp_number'] ?? '923000000000') }}?text=Hello%20Kunlun%20Treks,%20I%20am%20interested%20in%20{{ urlencode($package->title) }}" target="_blank" class="btn btn-outline-success btn-sm w-100">
                            <i class="fab fa-whatsapp me-2"></i>Chat with Expedition Leader on WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Packages -->
@if(isset($relatedPackages) && $relatedPackages->count() > 0)
<section class="py-5 bg-light">
    <div class="container">
        <h3 class="fw-bold font-heading mb-4 text-center">You May Also Be Interested In</h3>
        <div class="row g-4">
            @foreach($relatedPackages as $relPkg)
                <div class="col-lg-4 col-md-6">
                    <div class="package-card">
                        <div class="package-card-img-wrapper">
                            <img src="{{ Str::startsWith($relPkg->featured_image, 'http') ? $relPkg->featured_image : asset('uploads/' . $relPkg->featured_image) }}" alt="{{ $relPkg->title }}">
                            <span class="package-badge-category">{{ $relPkg->category->name ?? 'Trek' }}</span>
                            @if($relPkg->price)
                                <span class="package-badge-price">${{ number_format($relPkg->price, 0) }}</span>
                            @endif
                        </div>
                        <div class="package-card-body">
                            <div class="d-flex gap-3 mb-2">
                                <span class="package-meta-item"><i class="fas fa-clock"></i>{{ $relPkg->duration_days }} Days</span>
                                <span class="package-meta-item"><i class="fas fa-chart-line"></i>{{ ucfirst($relPkg->difficulty_level ?? 'Moderate') }}</span>
                            </div>
                            <h5 class="fw-bold mb-2">
                                <a href="{{ route('packages.show', $relPkg) }}" class="text-dark text-decoration-none hover-accent">
                                    {{ $relPkg->title }}
                                </a>
                            </h5>
                            <div class="pt-3 border-top mt-auto text-end">
                                <a href="{{ route('packages.show', $relPkg) }}" class="btn btn-sm btn-brand-primary">
                                    View Details <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection

@push('scripts')
<script>
    $('#packageInquiryForm').on('submit', function(e) {
        e.preventDefault();
        let form = $(this);
        let btn = $('#submitInquiryBtn');

        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Submitting...');

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function(response) {
                $('#inquirySuccessAlert').removeClass('d-none');
                form[0].reset();
                btn.prop('disabled', false).html('<i class="fas fa-check me-2"></i>Sent Successfully!');
                setTimeout(() => {
                    btn.html('<i class="fas fa-paper-plane me-2"></i>Send Booking Request');
                }, 4000);
            },
            error: function(err) {
                btn.prop('disabled', false).html('<i class="fas fa-paper-plane me-2"></i>Send Booking Request');
                alert('Something went wrong. Please check your inputs and try again.');
            }
        });
    });
</script>
@endpush
