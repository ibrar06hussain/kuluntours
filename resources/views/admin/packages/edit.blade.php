@extends('admin.layouts.app')

@section('title', 'Edit Package: ' . $package->title)
@section('page-title', 'Edit Tour Package')

@section('content')
<form action="{{ route('admin.packages.update', $package) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row">
        <!-- Main Form Column -->
        <div class="col-lg-8">
            <!-- Basic Details -->
            <div class="content-card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Package Overview: <strong>{{ $package->title }}</strong></span>
                    <a href="{{ route('packages.show', $package) }}" target="_blank" class="btn btn-sm btn-outline-info">
                        <i class="fas fa-external-link-alt me-1"></i>View on Site
                    </a>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Package Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control form-control-lg @error('title') is-invalid @enderror" value="{{ old('title', $package->title) }}" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Category <span class="text-danger">*</span></label>
                            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id', $package->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Slug</label>
                            <input type="text" name="slug" class="form-control" value="{{ old('slug', $package->slug) }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Short Catchy Description / Subtitle</label>
                        <textarea name="short_description" rows="2" class="form-control">{{ old('short_description', $package->short_description) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Detailed Overview & Highlights</label>
                        <textarea name="description" class="summernote form-control">{{ old('description', $package->description) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Day-by-Day Itinerary Builder -->
            <div class="content-card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-route text-primary me-2"></i>Day-by-Day Itinerary</span>
                    <button type="button" class="btn btn-sm btn-outline-primary" id="addItineraryBtn">
                        <i class="fas fa-plus me-1"></i>Add Day
                    </button>
                </div>
                <div class="card-body">
                    <div id="itineraryContainer">
                        @forelse($package->itineraries as $idx => $itn)
                            <div class="itinerary-row p-3 border rounded mb-3 bg-light" data-index="{{ $idx }}">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="fw-bold text-primary day-badge">Day {{ $itn->day_number }}</span>
                                    <button type="button" class="btn btn-sm btn-outline-danger remove-itinerary-btn"><i class="fas fa-times"></i></button>
                                </div>
                                <div class="row g-2 mb-2">
                                    <div class="col-md-3">
                                        <input type="number" name="itineraries[{{ $idx }}][day_number]" class="form-control form-control-sm" value="{{ $itn->day_number }}" placeholder="Day #">
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="itineraries[{{ $idx }}][title]" class="form-control form-control-sm" value="{{ $itn->title }}" placeholder="Day Title">
                                    </div>
                                </div>
                                <div>
                                    <textarea name="itineraries[{{ $idx }}][description]" rows="2" class="form-control form-control-sm" placeholder="Activities and details...">{{ $itn->description }}</textarea>
                                </div>
                            </div>
                        @empty
                            <div class="itinerary-row p-3 border rounded mb-3 bg-light" data-index="0">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="fw-bold text-primary day-badge">Day 1</span>
                                    <button type="button" class="btn btn-sm btn-outline-danger remove-itinerary-btn"><i class="fas fa-times"></i></button>
                                </div>
                                <div class="row g-2 mb-2">
                                    <div class="col-md-3">
                                        <input type="number" name="itineraries[0][day_number]" class="form-control form-control-sm" value="1" placeholder="Day #">
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="itineraries[0][title]" class="form-control form-control-sm" placeholder="Day Title">
                                    </div>
                                </div>
                                <div>
                                    <textarea name="itineraries[0][description]" rows="2" class="form-control form-control-sm" placeholder="Activities and details..."></textarea>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Inclusions and Exclusions -->
            <div class="content-card mb-4">
                <div class="card-header"><i class="fas fa-list-check text-success me-2"></i>What's Included & Excluded</div>
                <div class="card-body">
                    <div class="row">
                        <!-- Inclusions -->
                        <div class="col-md-6 mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label fw-bold text-success mb-0"><i class="fas fa-check-circle me-1"></i>Inclusions</label>
                                <button type="button" class="btn btn-xs btn-outline-success btn-sm py-0 px-2" id="addInclusionBtn">+ Add Item</button>
                            </div>
                            <div id="inclusionContainer">
                                @forelse($package->inclusions as $idx => $inc)
                                    <div class="input-group mb-2 inclusion-row">
                                        <span class="input-group-text bg-success-subtle text-success"><i class="fas fa-check"></i></span>
                                        <input type="text" name="inclusions[{{ $idx }}][description]" class="form-control" value="{{ $inc->description }}">
                                        <button type="button" class="btn btn-outline-danger remove-inc-btn"><i class="fas fa-times"></i></button>
                                    </div>
                                @empty
                                    <div class="input-group mb-2 inclusion-row">
                                        <span class="input-group-text bg-success-subtle text-success"><i class="fas fa-check"></i></span>
                                        <input type="text" name="inclusions[0][description]" class="form-control" placeholder="e.g. 4x4 Mountain Jeeps transport">
                                        <button type="button" class="btn btn-outline-danger remove-inc-btn"><i class="fas fa-times"></i></button>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Exclusions -->
                        <div class="col-md-6 mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label fw-bold text-danger mb-0"><i class="fas fa-times-circle me-1"></i>Exclusions</label>
                                <button type="button" class="btn btn-xs btn-outline-danger btn-sm py-0 px-2" id="addExclusionBtn">+ Add Item</button>
                            </div>
                            <div id="exclusionContainer">
                                @forelse($package->exclusions as $idx => $exc)
                                    <div class="input-group mb-2 exclusion-row">
                                        <span class="input-group-text bg-danger-subtle text-danger"><i class="fas fa-times"></i></span>
                                        <input type="text" name="exclusions[{{ $idx }}][description]" class="form-control" value="{{ $exc->description }}">
                                        <button type="button" class="btn btn-outline-danger remove-exc-btn"><i class="fas fa-times"></i></button>
                                    </div>
                                @empty
                                    <div class="input-group mb-2 exclusion-row">
                                        <span class="input-group-text bg-danger-subtle text-danger"><i class="fas fa-times"></i></span>
                                        <input type="text" name="exclusions[0][description]" class="form-control" placeholder="e.g. International airfare">
                                        <button type="button" class="btn btn-outline-danger remove-exc-btn"><i class="fas fa-times"></i></button>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SEO Settings -->
            <div class="content-card mb-4">
                <div class="card-header"><i class="fas fa-globe text-info me-2"></i>Search Engine Optimization (SEO)</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">SEO Meta Title</label>
                        <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $package->meta_title) }}">
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-bold">SEO Meta Description</label>
                        <textarea name="meta_description" rows="2" class="form-control">{{ old('meta_description', $package->meta_description) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Options Column -->
        <div class="col-lg-4">
            <!-- Publish Actions -->
            <div class="content-card mb-4">
                <div class="card-header">Publish Options</div>
                <div class="card-body">
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" name="is_active" id="isActive" value="1" {{ old('is_active', $package->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label fw-bold" for="isActive">Published / Active</label>
                    </div>

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" name="is_featured" id="isFeatured" value="1" {{ old('is_featured', $package->is_featured) ? 'checked' : '' }}>
                        <label class="form-check-label fw-bold" for="isFeatured">Feature on Homepage</label>
                    </div>

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" name="is_fixed_departure" id="isFixedDeparture" value="1" {{ old('is_fixed_departure', $package->is_fixed_departure) ? 'checked' : '' }}>
                        <label class="form-check-label fw-bold" for="isFixedDeparture">Fixed Departure Tour</label>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Departure Date (optional)</label>
                        <input type="date" name="departure_date" class="form-control" value="{{ old('departure_date', $package->departure_date ? $package->departure_date->format('Y-m-d') : '') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Sort Order</label>
                        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $package->sort_order) }}">
                    </div>

                    <div class="d-grid gap-2 pt-2 border-top">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save me-1"></i>Update Package
                        </button>
                        <a href="{{ route('admin.packages.index') }}" class="btn btn-light">Cancel</a>
                    </div>
                </div>
            </div>

            <!-- Key Specs & Pricing -->
            <div class="content-card mb-4">
                <div class="card-header">Trip Specifications</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Price (USD) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $package->price) }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Price Note</label>
                        <input type="text" name="price_note" class="form-control" value="{{ old('price_note', $package->price_note) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Duration (Days)</label>
                        <div class="input-group">
                            <input type="number" name="duration_days" class="form-control" value="{{ old('duration_days', $package->duration_days) }}" min="1">
                            <span class="input-group-text">Days</span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Difficulty Level</label>
                        <select name="difficulty_level" class="form-select">
                            <option value="easy" {{ old('difficulty_level', $package->difficulty_level) == 'easy' ? 'selected' : '' }}>Easy (Leisure / Cultural)</option>
                            <option value="moderate" {{ old('difficulty_level', $package->difficulty_level) == 'moderate' ? 'selected' : '' }}>Moderate (Alpine Treks)</option>
                            <option value="difficult" {{ old('difficulty_level', $package->difficulty_level) == 'difficult' ? 'selected' : '' }}>Difficult / Strenuous (Glacier Treks)</option>
                            <option value="extreme" {{ old('difficulty_level', $package->difficulty_level) == 'extreme' ? 'selected' : '' }}>Extreme (Mountaineering / 7000m+)</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Max Altitude</label>
                        <input type="text" name="max_altitude" class="form-control" value="{{ old('max_altitude', $package->max_altitude) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Best Season</label>
                        <input type="text" name="best_season" class="form-control" value="{{ old('best_season', $package->best_season) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Group Size</label>
                        <input type="text" name="group_size" class="form-control" value="{{ old('group_size', $package->group_size) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Starting Location</label>
                        <input type="text" name="starting_point" class="form-control" value="{{ old('starting_point', $package->starting_point) }}">
                    </div>

                    <div class="mb-0">
                        <label class="form-label fw-semibold">Ending Location</label>
                        <input type="text" name="ending_point" class="form-control" value="{{ old('ending_point', $package->ending_point) }}">
                    </div>
                </div>
            </div>

            <!-- Media Uploads & Existing Gallery -->
            <div class="content-card mb-4">
                <div class="card-header">Media & Gallery</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Primary Featured Image</label>
                        @if($package->featured_image)
                            <div class="mb-2">
                                <img src="{{ Str::startsWith($package->featured_image, 'http') ? $package->featured_image : asset('uploads/' . $package->featured_image) }}" alt="{{ $package->title }}" class="img-thumbnail rounded w-100" style="max-height: 160px; object-fit: cover;">
                            </div>
                        @endif
                        <input type="file" name="featured_image" class="form-control" accept="image/*">
                        <small class="text-muted">Leave empty to keep existing featured photo.</small>
                    </div>

                    <!-- Current Gallery -->
                    @if($package->images->count() > 0)
                        <div class="mb-3">
                            <label class="form-label fw-bold">Current Gallery Photos</label>
                            <div class="row g-2">
                                @foreach($package->images as $img)
                                    <div class="col-4 position-relative">
                                        <img src="{{ Str::startsWith($img->image, 'http') ? $img->image : asset('uploads/' . $img->image) }}" class="rounded img-thumbnail w-100" style="height: 60px; object-fit: cover;">
                                        <button type="button" class="btn btn-danger btn-xs position-absolute top-0 end-0 p-1 m-1 lh-1 delete-gallery-img" data-url="{{ route('admin.packages.gallery.delete', $img) }}">
                                            <i class="fas fa-trash" style="font-size: 0.65rem;"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="mb-0">
                        <label class="form-label fw-bold">Add More Gallery Photos</label>
                        <input type="file" name="gallery_images[]" class="form-control" accept="image/*" multiple>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Hidden form for gallery image delete -->
<form id="deleteGalleryForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection

@push('scripts')
<script>
    let itineraryIndex = {{ count($package->itineraries) ?: 1 }};
    let inclusionIndex = {{ count($package->inclusions) ?: 1 }};
    let exclusionIndex = {{ count($package->exclusions) ?: 1 }};

    // Add Day to Itinerary
    $('#addItineraryBtn').on('click', function() {
        let dayNum = $('#itineraryContainer .itinerary-row').length + 1;
        let html = `
            <div class="itinerary-row p-3 border rounded mb-3 bg-light" data-index="${itineraryIndex}">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="fw-bold text-primary day-badge">Day ${dayNum}</span>
                    <button type="button" class="btn btn-sm btn-outline-danger remove-itinerary-btn"><i class="fas fa-times"></i></button>
                </div>
                <div class="row g-2 mb-2">
                    <div class="col-md-3">
                        <input type="number" name="itineraries[${itineraryIndex}][day_number]" class="form-control form-control-sm" value="${dayNum}" placeholder="Day #">
                    </div>
                    <div class="col-md-9">
                        <input type="text" name="itineraries[${itineraryIndex}][title]" class="form-control form-control-sm" placeholder="Day Title">
                    </div>
                </div>
                <div>
                    <textarea name="itineraries[${itineraryIndex}][description]" rows="2" class="form-control form-control-sm" placeholder="Activities and details..."></textarea>
                </div>
            </div>
        `;
        $('#itineraryContainer').append(html);
        itineraryIndex++;
    });

    $(document).on('click', '.remove-itinerary-btn', function() {
        if ($('#itineraryContainer .itinerary-row').length > 1) {
            $(this).closest('.itinerary-row').remove();
        } else {
            alert('At least one itinerary day should remain.');
        }
    });

    // Add Inclusion
    $('#addInclusionBtn').on('click', function() {
        let html = `
            <div class="input-group mb-2 inclusion-row">
                <span class="input-group-text bg-success-subtle text-success"><i class="fas fa-check"></i></span>
                <input type="text" name="inclusions[${inclusionIndex}][description]" class="form-control" placeholder="e.g. High altitude tents & mess equipment">
                <button type="button" class="btn btn-outline-danger remove-inc-btn"><i class="fas fa-times"></i></button>
            </div>
        `;
        $('#inclusionContainer').append(html);
        inclusionIndex++;
    });

    $(document).on('click', '.remove-inc-btn', function() {
        $(this).closest('.inclusion-row').remove();
    });

    // Add Exclusion
    $('#addExclusionBtn').on('click', function() {
        let html = `
            <div class="input-group mb-2 exclusion-row">
                <span class="input-group-text bg-danger-subtle text-danger"><i class="fas fa-times"></i></span>
                <input type="text" name="exclusions[${exclusionIndex}][description]" class="form-control" placeholder="e.g. Personal climbing gear">
                <button type="button" class="btn btn-outline-danger remove-exc-btn"><i class="fas fa-times"></i></button>
            </div>
        `;
        $('#exclusionContainer').append(html);
        exclusionIndex++;
    });

    $(document).on('click', '.remove-exc-btn', function() {
        $(this).closest('.exclusion-row').remove();
    });

    // Delete gallery photo
    $('.delete-gallery-img').on('click', function() {
        if (confirm('Delete this gallery photo?')) {
            let url = $(this).data('url');
            let form = $('#deleteGalleryForm');
            form.attr('action', url);
            form.submit();
        }
    });
</script>
@endpush
