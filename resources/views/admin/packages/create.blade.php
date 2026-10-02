@extends('admin.layouts.app')

@section('title', 'Create Package')
@section('page-title', 'Create New Tour / Trek Package')

@section('content')
<form action="{{ route('admin.packages.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <!-- Main Form Column -->
        <div class="col-lg-8">
            <!-- Basic Details -->
            <div class="content-card mb-4">
                <div class="card-header">Package Overview</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Package Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control form-control-lg @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="e.g. K2 Base Camp & Concordia Trek" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Category <span class="text-danger">*</span></label>
                            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Slug</label>
                            <input type="text" name="slug" class="form-control" value="{{ old('slug') }}" placeholder="auto-generated-if-blank">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Short Catchy Description / Subtitle</label>
                        <textarea name="short_description" rows="2" class="form-control" placeholder="Brief 1-2 sentence highlight for package cards...">{{ old('short_description') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Detailed Overview & Highlights</label>
                        <textarea name="description" class="summernote form-control">{{ old('description') }}</textarea>
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
                                    <input type="text" name="itineraries[0][title]" class="form-control form-control-sm" placeholder="Day Title (e.g. Arrival in Islamabad & Hotel Transfer)">
                                </div>
                            </div>
                            <div>
                                <textarea name="itineraries[0][description]" class="form-control summernote-itinerary" placeholder="Describe activities, route details, and highlights of the day..."></textarea>
                            </div>
                        </div>
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
                                <div class="input-group mb-2 inclusion-row">
                                    <span class="input-group-text bg-success-subtle text-success"><i class="fas fa-check"></i></span>
                                    <input type="text" name="inclusions[0][description]" class="form-control" placeholder="e.g. 4x4 Mountain Jeeps transport">
                                    <button type="button" class="btn btn-outline-danger remove-inc-btn"><i class="fas fa-times"></i></button>
                                </div>
                            </div>
                        </div>

                        <!-- Exclusions -->
                        <div class="col-md-6 mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label fw-bold text-danger mb-0"><i class="fas fa-times-circle me-1"></i>Exclusions</label>
                                <button type="button" class="btn btn-xs btn-outline-danger btn-sm py-0 px-2" id="addExclusionBtn">+ Add Item</button>
                            </div>
                            <div id="exclusionContainer">
                                <div class="input-group mb-2 exclusion-row">
                                    <span class="input-group-text bg-danger-subtle text-danger"><i class="fas fa-times"></i></span>
                                    <input type="text" name="exclusions[0][description]" class="form-control" placeholder="e.g. International airfare">
                                    <button type="button" class="btn btn-outline-danger remove-exc-btn"><i class="fas fa-times"></i></button>
                                </div>
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
                        <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title') }}" placeholder="e.g. K2 Base Camp Trek 2026 | Kunlun Treks">
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-bold">SEO Meta Description</label>
                        <textarea name="meta_description" rows="2" class="form-control" placeholder="Engaging summary for Google search listings...">{{ old('meta_description') }}</textarea>
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
                        <input class="form-check-input" type="checkbox" name="is_active" id="isActive" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                        <label class="form-check-label fw-bold" for="isActive">Published / Active</label>
                    </div>

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" name="is_featured" id="isFeatured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                        <label class="form-check-label fw-bold" for="isFeatured">Feature on Homepage</label>
                    </div>

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" name="is_fixed_departure" id="isFixedDeparture" value="1" {{ old('is_fixed_departure') ? 'checked' : '' }}>
                        <label class="form-check-label fw-bold" for="isFixedDeparture">Fixed Departure Tour</label>
                    </div>

                    <div class="mb-3" id="departureDateGroup">
                        <label class="form-label fw-semibold">Departure Date (optional)</label>
                        <input type="date" name="departure_date" class="form-control" value="{{ old('departure_date') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Sort Order</label>
                        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}">
                    </div>

                    <div class="d-grid gap-2 pt-2 border-top">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save me-1"></i>Save Package
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
                        <label class="form-label fw-bold">Price (PKR) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">PKR</span>
                            <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', 0) }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Price Note</label>
                        <input type="text" name="price_note" class="form-control" value="{{ old('price_note', 'Per Person (All Inclusive)') }}" placeholder="e.g. Per Person (Twin Sharing)">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Duration (Days)</label>
                        <div class="input-group">
                            <input type="number" name="duration_days" class="form-control" value="{{ old('duration_days', 14) }}" min="1">
                            <span class="input-group-text">Days</span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Difficulty Level</label>
                        <select name="difficulty_level" class="form-select">
                            <option value="easy" {{ old('difficulty_level') == 'easy' ? 'selected' : '' }}>Easy (Leisure / Cultural)</option>
                            <option value="moderate" {{ old('difficulty_level') == 'moderate' ? 'selected' : '' }}>Moderate (Alpine Treks)</option>
                            <option value="difficult" {{ old('difficulty_level', 'difficult') == 'difficult' ? 'selected' : '' }}>Difficult / Strenuous (Glacier Treks)</option>
                            <option value="extreme" {{ old('difficulty_level') == 'extreme' ? 'selected' : '' }}>Extreme (Mountaineering / 7000m+)</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Max Altitude</label>
                        <input type="text" name="max_altitude" class="form-control" value="{{ old('max_altitude') }}" placeholder="e.g. 5,150m (Concordia)">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Best Season</label>
                        <input type="text" name="best_season" class="form-control" value="{{ old('best_season', 'June to September') }}" placeholder="e.g. May to October">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Group Size</label>
                        <input type="text" name="group_size" class="form-control" value="{{ old('group_size', '4 - 12 persons') }}" placeholder="e.g. 2 - 12 persons">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Starting Location</label>
                        <input type="text" name="starting_point" class="form-control" value="{{ old('starting_point', 'Islamabad / Skardu') }}">
                    </div>

                    <div class="mb-0">
                        <label class="form-label fw-semibold">Ending Location</label>
                        <input type="text" name="ending_point" class="form-control" value="{{ old('ending_point', 'Islamabad') }}">
                    </div>
                </div>
            </div>

            <!-- Media Uploads -->
            <div class="content-card mb-4">
                <div class="card-header">Media & Gallery</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Primary Featured Image</label>
                        <input type="file" name="featured_image" class="form-control" accept="image/*">
                        <small class="text-muted">High resolution landscape photo (1200x800 recommended).</small>
                    </div>

                    <div class="mb-0">
                        <label class="form-label fw-bold">Additional Gallery Photos</label>
                        <input type="file" name="gallery_images[]" class="form-control" accept="image/*" multiple>
                        <small class="text-muted">Select multiple images for the package photo gallery.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
    let itineraryIndex = 1;
    let inclusionIndex = 1;
    let exclusionIndex = 1;

    function initItinerarySummernote(selector) {
        $(selector).summernote({
            height: 150,
            toolbar: [
                ['style', ['style', 'bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture', 'table', 'hr']],
                ['view', ['fullscreen', 'codeview']]
            ],
            callbacks: {
                onImageUpload: function(files) {
                    if (typeof uploadEditorImage === 'function') {
                        uploadEditorImage(files[0], $(this));
                    }
                }
            }
        });
    }

    $(document).ready(function() {
        initItinerarySummernote('.summernote-itinerary');
    });

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
                        <input type="text" name="itineraries[${itineraryIndex}][title]" class="form-control form-control-sm" placeholder="Day Title (e.g. Paiju to Khoburtse)">
                    </div>
                </div>
                <div>
                    <textarea name="itineraries[${itineraryIndex}][description]" class="form-control summernote-itinerary" placeholder="Describe activities, trail terrain, and overnight stay..."></textarea>
                </div>
            </div>
        `;
        let $newRow = $(html);
        $('#itineraryContainer').append($newRow);
        initItinerarySummernote($newRow.find('.summernote-itinerary'));
        itineraryIndex++;
    });

    $(document).on('click', '.remove-itinerary-btn', function() {
        if ($('#itineraryContainer .itinerary-row').length > 1) {
            let $row = $(this).closest('.itinerary-row');
            $row.find('.summernote-itinerary').summernote('destroy');
            $row.remove();
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
</script>
@endpush
