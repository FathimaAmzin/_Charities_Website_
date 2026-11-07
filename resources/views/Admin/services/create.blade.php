@extends('admin.layouts.app')

@section('title', 'Add New Service / Course')
@section('page_title', 'Create Service / Course')

@section('content')

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h4 class="fw-bold text-navy mb-1">Create New Service or Course</h4>
            <p class="text-muted small mb-0">Add a community humanitarian service or vocational course with custom provide servicing details and visual gallery photos.</p>
        </div>
        <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Back to Services
        </a>
    </div>

    @if(isset($errors) && $errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h6 class="fw-bold mb-1"><i class="fa-solid fa-triangle-exclamation me-1"></i> Please check form inputs:</h6>
            <ul class="mb-0 small ps-3">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="gallery_submitted" value="1">
        <input type="hidden" name="roles_submitted" value="1">
        <input type="hidden" name="cards_submitted" value="1">

        <div class="row g-4">
            <!-- Left Column: Core Content -->
            <div class="col-lg-8">
                <div class="admin-card p-4 mb-4">
                    <h5 class="fw-bold text-navy mb-3"><i class="fa-solid fa-circle-info text-primary me-2"></i>General Information</h5>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-navy">Type <span class="text-danger">*</span></label>
                            <select name="type" id="serviceTypeSelect" class="form-select @error('type') is-invalid @enderror" required onchange="toggleCourseFields(this.value)">
                                <option value="service" {{ old('type') === 'service' ? 'selected' : '' }}>Humanitarian Aid Service</option>
                                <option value="course" {{ old('type') === 'course' ? 'selected' : '' }}>Vocational Course / Free Seminar</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-navy">Category <span class="text-danger">*</span></label>
                            <input type="text" name="category" class="form-control @error('category') is-invalid @enderror" placeholder="e.g. Learning & Skills, Utility & Infrastructure" value="{{ old('category') }}" required>
                        </div>

                        <div class="col-md-8">
                            <label class="form-label fw-semibold text-navy">Full Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="e.g. Clean Water Supply & Tube Wells" value="{{ old('title') }}" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-navy">Short Title (Nav Pill)</label>
                            <input type="text" name="short_title" class="form-control @error('short_title') is-invalid @enderror" placeholder="e.g. Clean Water" value="{{ old('short_title') }}">
                        </div>

                        <!-- Course Specific Fields -->
                        <div class="col-md-6 course-specific-field" style="display: {{ old('type') === 'course' ? 'block' : 'none' }};">
                            <label class="form-label fw-semibold text-navy">Course Duration</label>
                            <input type="text" name="course_duration" class="form-control" placeholder="e.g. 6 Months (Weekend Batch)" value="{{ old('course_duration') }}">
                        </div>

                        <div class="col-md-6 course-specific-field" style="display: {{ old('type') === 'course' ? 'block' : 'none' }};">
                            <label class="form-label fw-semibold text-navy">Course Level / Eligibility</label>
                            <input type="text" name="course_level" class="form-control" placeholder="e.g. Beginner to Intermediate" value="{{ old('course_level') }}">
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold text-navy">Brief Summary (Lead Text) <span class="text-danger">*</span></label>
                            <textarea name="summary" class="form-control @error('summary') is-invalid @enderror" rows="2" placeholder="Short 1-2 sentence lead overview of this humanitarian program..." required>{{ old('summary') }}</textarea>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold text-navy">Full Detailed Description <span class="text-danger">*</span></label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="5" placeholder="Comprehensive background, why this service matters, challenges faced by local families, and how SDC intervenes..." required>{{ old('description') }}</textarea>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold text-navy">Key Highlights & Deliverables (One per line)</label>
                            <textarea name="highlights_input" class="form-control" rows="4" placeholder="Deep Borehole & Tube Well Drilling
Reverse Osmosis Water Purification Plants
Village Pipeline Extensions & Taps">{{ old('highlights_input') }}</textarea>
                            <small class="text-muted">Each line will automatically become a bullet point with an icon.</small>
                        </div>
                    </div>
                </div>

                <!-- 2. DEDICATED "PROVIDE SERVICING" CONFIGURATION -->
                <div class="admin-card p-4 mb-4 border-start border-4 border-primary">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-primary rounded-pill px-3 py-1 fw-bold"><i class="fa-solid fa-handshake-angle me-1"></i> Core Feature</span>
                            <h5 class="fw-bold text-primary mb-0">Provide Servicing Configuration</h5>
                        </div>
                        <span class="badge bg-primary-subtle text-primary">Public Service Details Page</span>
                    </div>
                    <p class="text-muted small mb-3">
                        Configure what appears when visitors click <strong>"Provide Servicing"</strong> on the website. You can edit the heading title, guidance instructions, upload a servicing image, and specify specialist volunteer/partner roles needed.
                    </p>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-navy">Provide Servicing Heading / Title</label>
                        <input type="text" name="provide_title" class="form-control" value="{{ old('provide_title', 'Provide Servicing & Professional Support') }}" placeholder="e.g. Provide Servicing & Professional Support">
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-navy">Provide Servicing Instructions & Guidance</label>
                        <textarea name="provide_details" class="form-control" rows="3" placeholder="How skilled professionals, volunteers, and organizations can provide servicing, equipment, or lectures...">{{ old('provide_details') }}</textarea>
                    </div>

                    <div class="row g-3 align-items-center p-3 rounded-3 bg-light border mb-4">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-navy">Upload Servicing Image File</label>
                            <input type="file" name="provide_image_file" class="form-control form-control-sm" accept="image/*">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-navy">Or Existing Image Path</label>
                            <input type="text" name="provide_image" class="form-control form-control-sm" placeholder="e.g. images/services/electricity.jpg" value="{{ old('provide_image') }}">
                        </div>
                    </div>

                    <!-- Provide Servicing Cards Sub-Section (Image, Title, Description, Date) -->
                    <div class="p-3 rounded-3 bg-light border mb-4">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-primary rounded-pill px-2 py-1 small fw-bold"><i class="fa-solid fa-layer-group me-1"></i> Cards</span>
                                <h6 class="fw-bold text-navy mb-0">Provide Servicing Cards (Image, Title, Description, Date)</h6>
                            </div>
                            <button type="button" class="btn btn-sm btn-primary fw-bold" onclick="addServicingCardItem()">
                                <i class="fa-solid fa-plus me-1"></i> Add Servicing Card
                            </button>
                        </div>
                        <p class="text-muted small mb-3">
                            Each card features an image, a date badge at top right, tag at top left, title at top, and description at bottom. Choose files from your computer or edit titles/dates directly.
                        </p>

                        <div id="servicingCardsContainer">
                            <div class="servicing-card-row p-3 rounded-3 bg-white border mb-3 position-relative">
                                <div class="d-flex align-items-center justify-content-between mb-2 pb-2 border-bottom">
                                    <span class="badge bg-primary-subtle text-primary fw-bold">Card #<span class="card-num">1</span></span>
                                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('.servicing-card-row').remove();" title="Remove Card">
                                        <i class="fa-solid fa-trash me-1"></i> Delete Card
                                    </button>
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-3 text-center">
                                        <img src="{{ asset('images/services/education.jpg') }}" class="img-thumbnail rounded-3 shadow-xs card-thumb-preview" style="width: 100%; height: 110px; object-fit: cover;">
                                        <small class="text-muted d-block mt-1">Photo Preview</small>
                                        <span class="preview-label small d-block mt-1"></span>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="row g-2">
                                            <div class="col-md-8">
                                                <label class="form-label small fw-semibold text-navy">Card Title (Top)</label>
                                                <input type="text" name="card_titles[]" class="form-control form-control-sm" placeholder="e.g. Household Power Wiring & Grid Connections" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label small fw-semibold text-navy">Tag / Badge</label>
                                                <input type="text" name="card_tags[]" class="form-control form-control-sm" value="SERVICING" placeholder="e.g. EVENT, SERVICING">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label small fw-semibold text-navy">Date (Top-Right Badge)</label>
                                                <input type="date" name="card_dates[]" class="form-control form-control-sm" value="{{ date('Y-m-d') }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label small fw-semibold text-navy">Upload Photo File From Computer</label>
                                                <input type="file" name="card_files[]" class="form-control form-control-sm" accept="image/*" onchange="previewCardFile(this)">
                                                <input type="hidden" name="card_urls[]" value="">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label small fw-semibold text-navy">Card Description (Bottom)</label>
                                                <textarea name="card_descs[]" class="form-control form-control-sm" rows="2" placeholder="Describe the deliverable and how volunteers/partners can provide servicing..."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Specialist Roles Sub-Section -->
                    <div class="pt-2">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h6 class="fw-bold text-navy mb-0">
                                <i class="fa-solid fa-users-gear text-primary me-1"></i> Specialist Servicing Roles Needed
                            </h6>
                            <button type="button" class="btn btn-sm btn-outline-primary fw-bold" onclick="addRoleItem()">
                                <i class="fa-solid fa-plus me-1"></i> Add Role
                            </button>
                        </div>
                        <p class="text-muted small mb-3">
                            Specify what trades or professionals are invited to provide servicing (e.g. Certified Electricians, Solar Engineers, Volunteer Teachers, Masons).
                        </p>

                        <div id="rolesContainer">
                            <div class="role-row p-3 rounded-3 bg-white border mb-2">
                                <div class="row g-2 align-items-center">
                                    <div class="col-md-5">
                                        <input type="text" name="roles_role[]" class="form-control form-control-sm" value="Professional Specialist" placeholder="Role Name">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="roles_desc[]" class="form-control form-control-sm" value="Provide hands-on technical skills, maintenance, or mentorship." placeholder="Role Description">
                                    </div>
                                    <div class="col-md-1 text-end">
                                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('.role-row').remove();"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 3. FIELD VISUAL GALLERY PHOTOS -->
                <div class="admin-card p-4 mb-4 border-start border-4 border-primary">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-primary rounded-pill px-3 py-1 fw-bold"><i class="fa-solid fa-images me-1"></i> Public Gallery</span>
                            <h5 class="fw-bold text-navy mb-0">Visual Gallery Photos (Related Images)</h5>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-primary fw-bold" onclick="addGalleryItem()">
                            <i class="fa-solid fa-plus me-1"></i> Add Single Photo Card
                        </button>
                    </div>
                    <p class="text-muted small mb-3">
                        These photos appear in the <strong>"Field Operations & Visual Gallery"</strong> section on the service's public showcase page. You can upload photos directly from your files.
                    </p>

                    <!-- DIRECT MULTI-FILE UPLOAD BOX FROM FILES (Batch / Multiple) -->
                    <div class="p-4 rounded-3 bg-white border border-2 border-dashed border-primary mb-4 text-center">
                        <i class="fa-solid fa-cloud-arrow-up text-primary fs-2 mb-2 d-block"></i>
                        <h6 class="fw-bold text-navy mb-1">Upload New Photos Directly from Files (Batch / Multiple)</h6>
                        <p class="text-muted small mb-3">Choose one or multiple photos from your computer folders (JPG, PNG, JPEG, WebP). They will be added to this service gallery.</p>
                        <div class="d-inline-block text-start" style="max-width: 480px; width: 100%;">
                            <input type="file" name="bulk_gallery_files[]" id="bulkGalleryFiles" class="form-control" multiple accept="image/*" onchange="previewSelectedBulkFiles(this)">
                        </div>
                        <div id="bulkFilesPreview" class="d-flex flex-wrap gap-2 justify-content-center mt-3"></div>
                    </div>

                    <div id="galleryContainer">
                        <div class="gallery-row p-3 rounded-3 bg-light border mb-3">
                            <div class="d-flex align-items-center justify-content-between mb-2 pb-2 border-bottom">
                                <span class="badge bg-white text-navy border fw-bold">Photo #1</span>
                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDeleteGalleryItem(this)" title="Delete Photo"><i class="fa-solid fa-trash me-1"></i> Delete Photo</button>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-3 text-center">
                                    <div class="bg-secondary-subtle rounded-3 d-flex align-items-center justify-content-center card-thumb-box" style="height: 110px;">
                                        <i class="fa-solid fa-image text-muted fs-2"></i>
                                    </div>
                                    <img src="" class="img-thumbnail rounded-3 card-thumb-preview d-none" style="width: 100%; height: 110px; object-fit: cover;">
                                    <small class="text-muted d-block mt-1 preview-label">Preview</small>
                                </div>
                                <div class="col-md-9">
                                    <div class="row g-2">
                                        <div class="col-md-7">
                                            <label class="form-label small fw-semibold text-navy">Photo Title</label>
                                            <input type="text" name="gallery_titles[]" class="form-control form-control-sm" placeholder="e.g. On-Site Field Deliverable">
                                        </div>
                                        <div class="col-md-5">
                                            <label class="form-label small fw-semibold text-navy">Deliverable Tag</label>
                                            <input type="text" name="gallery_tags[]" class="form-control form-control-sm" value="Field Work" placeholder="Tag">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label small fw-bold text-navy">
                                                <i class="fa-solid fa-folder-open text-primary me-1"></i> Upload Photo File From Computer
                                            </label>
                                            <input type="file" name="gallery_files[]" class="form-control form-control-sm" accept="image/*" onchange="previewCardFile(this)">
                                            <input type="hidden" name="gallery_urls[]" value="">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label small fw-semibold text-navy">Field Description</label>
                                            <textarea name="gallery_descs[]" class="form-control form-control-sm" rows="2" placeholder="Describe the on-ground project deliverable..."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 4. Support & Request Assistance Modals -->
                <div class="admin-card p-4 mb-4">
                    <h5 class="fw-bold text-navy mb-3"><i class="fa-solid fa-sliders text-teal me-2"></i>Support & Request Assistance Modals</h5>

                    <!-- Support Modal -->
                    <div class="p-3 rounded-3 bg-light border mb-3">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="badge bg-danger rounded-pill px-2 py-1"><i class="fa-solid fa-heart me-1"></i> Support</span>
                            <h6 class="fw-bold text-danger mb-0">Support This Service / Course</h6>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-navy">Upload Support Action Image</label>
                                <input type="file" name="support_image_file" class="form-control form-control-sm" accept="image/*">
                                <input type="text" name="support_image" class="form-control form-control-sm mt-1" placeholder="e.g. images/services/education.jpg" value="{{ old('support_image') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-navy">Support Instructions & Details</label>
                                <textarea name="support_details" class="form-control form-control-sm" rows="3" placeholder="Sponsor student learning materials, kit donations, bank details, or donation instructions...">{{ old('support_details') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Request Assistance Modal -->
                    <div class="p-3 rounded-3 bg-light border">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="badge bg-primary rounded-pill px-2 py-1"><i class="fa-solid fa-paper-plane me-1"></i> Request</span>
                            <h6 class="fw-bold text-primary mb-0">Request Assistance / Enrollment</h6>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-navy">Upload Request Assistance Image</label>
                                <input type="file" name="request_image_file" class="form-control form-control-sm" accept="image/*">
                                <input type="text" name="request_image" class="form-control form-control-sm mt-1" placeholder="e.g. images/services/education.jpg" value="{{ old('request_image') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-navy">Request Instructions & Eligibility</label>
                                <textarea name="request_details" class="form-control form-control-sm" rows="3" placeholder="How individuals or families apply for assistance, documents needed, contact helpline...">{{ old('request_details') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Right Column: Settings, Images & Metadata -->
            <div class="col-lg-4">
                <!-- Main Featured Photo -->
                <div class="admin-card p-4 mb-4">
                    <h5 class="fw-bold text-navy mb-3"><i class="fa-solid fa-image text-primary me-2"></i>Featured Cover Image</h5>
                    
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-navy">Upload Main Image File</label>
                        <input type="file" name="image_file" class="form-control" accept="image/*">
                        <small class="text-muted">Recommended: 1200x800px (JPG, PNG, WebP)</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-navy">Or Existing Image Path / URL</label>
                        <input type="text" name="image" class="form-control" placeholder="e.g. images/services/education.jpg" value="{{ old('image') }}">
                    </div>
                </div>

                <!-- Design & Icon Settings -->
                <div class="admin-card p-4 mb-4">
                    <h5 class="fw-bold text-navy mb-3"><i class="fa-solid fa-palette text-warning me-2"></i>Design & Styling</h5>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-navy">FontAwesome Icon Class</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fa-solid fa-icons"></i></span>
                            <input type="text" name="icon" class="form-control" placeholder="fa-solid fa-graduation-cap" value="{{ old('icon', 'fa-solid fa-graduation-cap') }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-navy">Accent Color</label>
                        <div class="d-flex align-items-center gap-2">
                            <input type="color" name="accent_color" id="accentColorPicker" class="form-control form-control-color" value="{{ old('accent_color', '#2563EB') }}" title="Choose accent color">
                            <input type="text" id="accentColorText" class="form-control" value="{{ old('accent_color', '#2563EB') }}" readonly>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-navy">Impact Metric</label>
                        <input type="text" name="impact" class="form-control" placeholder="e.g. 3,500+ Students Supported" value="{{ old('impact') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-navy">Display Order</label>
                        <input type="number" name="order" class="form-control" value="{{ old('order', 0) }}" min="0">
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-navy">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select" required>
                            <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>Active (Publicly Visible)</option>
                            <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive (Draft)</option>
                        </select>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="admin-card p-4">
                    <button type="submit" class="btn btn-teal w-100 py-3 fw-bold fs-6 shadow-sm">
                        <i class="fa-solid fa-plus-circle me-1"></i> Save & Publish Service
                    </button>
                    <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary w-100 mt-2">
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    </form>

    @push('scripts')
    <script>
        function toggleCourseFields(val) {
            const courseFields = document.querySelectorAll('.course-specific-field');
            courseFields.forEach(field => {
                field.style.display = (val === 'course') ? 'block' : 'none';
            });
        }

        const picker = document.getElementById('accentColorPicker');
        const text = document.getElementById('accentColorText');
        if (picker && text) {
            picker.addEventListener('input', (e) => {
                text.value = e.target.value;
            });
        }

        // Add Specialist Role Item
        function addRoleItem() {
            const container = document.getElementById('rolesContainer');
            const row = document.createElement('div');
            row.className = 'role-row p-3 rounded-3 bg-white border mb-2';
            row.innerHTML = `
                <div class="row g-2 align-items-center">
                    <div class="col-md-5">
                        <input type="text" name="roles_role[]" class="form-control form-control-sm" placeholder="Role Name (e.g. Electrician, Volunteer Teacher)">
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="roles_desc[]" class="form-control form-control-sm" placeholder="Role Description & Duties">
                    </div>
                    <div class="col-md-1 text-end">
                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('.role-row').remove();" title="Remove Role">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </div>
            `;
            container.appendChild(row);
        }

        // Instant Live Preview for Card File Input
        function previewCardFile(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                const card = input.closest('.gallery-row') || input.closest('.servicing-card-row');
                if (!card) return;
                const img = card.querySelector('.card-thumb-preview');
                const box = card.querySelector('.card-thumb-box');
                const label = card.querySelector('.preview-label');
                
                reader.onload = function(e) {
                    if (img) {
                        img.src = e.target.result;
                        img.classList.remove('d-none');
                    }
                    if (box) {
                        box.classList.add('d-none');
                    }
                    if (label) {
                        label.textContent = 'Selected File Preview';
                        label.classList.add('text-success', 'fw-bold');
                    }
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Live Preview for Bulk Multi-File Upload Box
        function previewSelectedBulkFiles(input) {
            const previewContainer = document.getElementById('bulkFilesPreview');
            previewContainer.innerHTML = '';
            if (input.files && input.files.length > 0) {
                Array.from(input.files).forEach((file, index) => {
                    const badge = document.createElement('div');
                    badge.className = 'p-2 bg-light border rounded-3 text-start small d-flex align-items-center gap-2 shadow-2xs';
                    badge.innerHTML = `
                        <img src="${URL.createObjectURL(file)}" class="rounded-2 shadow-xs" style="width: 48px; height: 48px; object-fit: cover;">
                        <div>
                            <strong class="d-block text-navy text-truncate" style="max-width: 170px;">${file.name}</strong>
                            <span class="text-success fw-bold" style="font-size: 0.72rem;"><i class="fa-solid fa-circle-check"></i> Ready to upload (${(file.size / 1024).toFixed(1)} KB)</span>
                        </div>
                    `;
                    previewContainer.appendChild(badge);
                });
            }
        }

        // Gallery Delete Tracking Variables
        let pendingDeleteRow = null;

        // Open Confirmation Modal (Yes or No)
        function confirmDeleteGalleryItem(button) {
            const row = button.closest('.gallery-row');
            if (!row) return;

            pendingDeleteRow = row;
            const titleInput = row.querySelector('input[name="gallery_titles[]"]');
            const imgEl = row.querySelector('.card-thumb-preview');
            const photoTitle = (titleInput && titleInput.value.trim()) ? titleInput.value.trim() : 'Visual Gallery Photo';
            const previewSrc = (imgEl && imgEl.src) ? imgEl.src : '';

            // Update Modal UI
            const modalTitle = document.getElementById('modalDeletePhotoTitle');
            if (modalTitle) {
                modalTitle.textContent = `Do you want to delete "${photoTitle}"?`;
            }
            const modalImg = document.getElementById('modalDeletePreviewImg');
            if (modalImg) {
                modalImg.src = previewSrc || 'https://ui-avatars.com/api/?name=Photo&background=2563EB&color=fff';
            }

            // Show Confirmation Modal
            const modalEl = document.getElementById('deleteGalleryPhotoModal');
            const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
            modal.show();
        }

        // Handle Confirmation "Yes, Delete" Action
        document.addEventListener('DOMContentLoaded', function () {
            const confirmBtn = document.getElementById('confirmDeletePhotoBtn');
            if (confirmBtn) {
                confirmBtn.addEventListener('click', function () {
                    if (!pendingDeleteRow) return;

                    const modalEl = document.getElementById('deleteGalleryPhotoModal');
                    const modal = bootstrap.Modal.getInstance(modalEl);
                    if (modal) modal.hide();

                    pendingDeleteRow.style.transition = 'all 0.25s ease';
                    pendingDeleteRow.style.opacity = '0';
                    pendingDeleteRow.style.transform = 'scale(0.95)';

                    setTimeout(() => {
                        pendingDeleteRow.remove();
                        pendingDeleteRow = null;
                        const container = document.getElementById('galleryContainer');
                        const remainingRows = container.querySelectorAll('.gallery-row');
                        remainingRows.forEach((r, idx) => {
                            const numBadge = r.querySelector('.photo-num');
                            if (numBadge) numBadge.textContent = idx + 1;
                        });
                        if (remainingRows.length === 0) {
                            let notice = document.getElementById('noPhotosNotice');
                            if (!notice) {
                                const emptyDiv = document.createElement('div');
                                emptyDiv.id = 'noPhotosNotice';
                                emptyDiv.className = 'text-center py-4 bg-light rounded-3 text-muted border border-dashed mb-3';
                                emptyDiv.innerHTML = `
                                    <i class="fa-solid fa-images fs-3 d-block mb-2 text-secondary"></i>
                                    <div class="fw-semibold text-navy">No Gallery Photos Currently</div>
                                    <small>Click <strong>"+ Add Single Photo Card"</strong> above or select files in the box above to add photos.</small>
                                `;
                                container.appendChild(emptyDiv);
                            }
                        }
                    }, 200);
                });
            }
        });

        // Add Gallery Photo Item
        function addGalleryItem() {
            const container = document.getElementById('galleryContainer');
            const notice = document.getElementById('noPhotosNotice');
            if (notice) notice.remove();

            const rowCount = container.querySelectorAll('.gallery-row').length + 1;
            const row = document.createElement('div');
            row.className = 'gallery-row p-3 rounded-3 bg-light border mb-3';
            row.innerHTML = `
                <div class="d-flex align-items-center justify-content-between mb-2 pb-2 border-bottom">
                    <span class="badge bg-white text-navy border fw-bold">New Photo #<span class="photo-num">${rowCount}</span></span>
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDeleteGalleryItem(this)" title="Delete Photo">
                        <i class="fa-solid fa-trash me-1"></i> Delete Photo
                    </button>
                </div>
                <div class="row g-3">
                    <div class="col-md-3 text-center">
                        <img src="https://ui-avatars.com/api/?name=Photo&background=2563EB&color=fff" class="img-thumbnail rounded-3 shadow-xs card-thumb-preview" style="width: 100%; height: 110px; object-fit: cover;">
                        <small class="text-muted d-block mt-1 preview-label">Select File Below</small>
                    </div>
                    <div class="col-md-9">
                        <div class="row g-2">
                            <div class="col-md-7">
                                <label class="form-label small fw-semibold text-navy">Photo Title</label>
                                <input type="text" name="gallery_titles[]" class="form-control form-control-sm" placeholder="e.g. Village Water Well Construction">
                            </div>
                            <div class="col-md-5">
                                <label class="form-label small fw-semibold text-navy">Deliverable Tag</label>
                                <input type="text" name="gallery_tags[]" class="form-control form-control-sm" value="Field Work" placeholder="Tag">
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold text-navy">
                                    <i class="fa-solid fa-folder-open text-primary me-1"></i> Upload Photo File From Computer
                                </label>
                                <input type="file" name="gallery_files[]" class="form-control form-control-sm" accept="image/*" onchange="previewCardFile(this)">
                                <input type="hidden" name="gallery_urls[]" value="">
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-semibold text-navy">Field Description / Caption</label>
                                <textarea name="gallery_descs[]" class="form-control form-control-sm" rows="2" placeholder="Describe the on-ground project deliverable..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            container.appendChild(row);
        }

        function addServicingCardItem() {
            const container = document.getElementById('servicingCardsContainer');
            const count = container.querySelectorAll('.servicing-card-row').length + 1;
            const today = new Date().toISOString().split('T')[0];
            const row = document.createElement('div');
            row.className = 'servicing-card-row p-3 rounded-3 bg-white border mb-3 position-relative';
            row.innerHTML = `
                <div class="d-flex align-items-center justify-content-between mb-2 pb-2 border-bottom">
                    <span class="badge bg-primary-subtle text-primary fw-bold">Card #<span class="card-num">${count}</span> (New)</span>
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('.servicing-card-row').remove();" title="Remove Card">
                        <i class="fa-solid fa-trash me-1"></i> Delete Card
                    </button>
                </div>
                <div class="row g-3">
                    <div class="col-md-3 text-center">
                        <img src="{{ asset('images/services/education.jpg') }}" class="img-thumbnail rounded-3 shadow-xs card-thumb-preview" style="width: 100%; height: 110px; object-fit: cover;">
                        <small class="text-muted d-block mt-1">Photo Preview</small>
                        <span class="preview-label small d-block mt-1"></span>
                    </div>
                    <div class="col-md-9">
                        <div class="row g-2">
                            <div class="col-md-8">
                                <label class="form-label small fw-semibold text-navy">Card Title (Top)</label>
                                <input type="text" name="card_titles[]" class="form-control form-control-sm" placeholder="e.g. Household Power Wiring & Grid Connections" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-semibold text-navy">Tag / Badge</label>
                                <input type="text" name="card_tags[]" class="form-control form-control-sm" value="SERVICING" placeholder="e.g. EVENT, SERVICING">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-navy">Date (Top-Right Badge)</label>
                                <input type="date" name="card_dates[]" class="form-control form-control-sm" value="${today}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-navy">Upload Photo File From Computer</label>
                                <input type="file" name="card_files[]" class="form-control form-control-sm" accept="image/*" onchange="previewCardFile(this)">
                                <input type="hidden" name="card_urls[]" value="">
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-semibold text-navy">Card Description (Bottom)</label>
                                <textarea name="card_descs[]" class="form-control form-control-sm" rows="2" placeholder="Describe the deliverable and how volunteers/partners can provide servicing..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            container.appendChild(row);
        }
    </script>
    @endpush

    <!-- Confirm Delete Gallery Photo Modal (Yes / No) -->
    <div class="modal fade" id="deleteGalleryPhotoModal" tabindex="-1" aria-labelledby="deleteGalleryPhotoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="modal-header bg-danger text-white border-0 py-3 px-4">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-triangle-exclamation fs-5"></i>
                        <h5 class="modal-title fw-bold mb-0" id="deleteGalleryPhotoModalLabel">Confirm Photo Deletion</h5>
                    </div>
                    <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 text-center">
                    <div class="mb-3 mx-auto" style="width: 140px; height: 110px;">
                        <img id="modalDeletePreviewImg" src="" alt="Photo Preview" class="img-thumbnail rounded-3 w-100 h-100 shadow-xs" style="object-fit: cover;">
                    </div>
                    <h5 class="fw-bold text-navy mb-1" id="modalDeletePhotoTitle">Do you want to delete this photo?</h5>
                    <p class="text-muted small mb-3">Are you sure you want to delete this photo from the Visual Gallery?</p>
                    
                    <div class="alert alert-warning py-2 px-3 small text-start border-0 rounded-3 mb-0 d-flex align-items-center gap-2">
                        <i class="fa-solid fa-circle-exclamation text-danger fs-5 flex-shrink-0"></i>
                        <span><strong>Notice:</strong> This image card will be removed from this service.</span>
                    </div>
                </div>
                <div class="modal-footer border-0 bg-light px-4 py-3 d-flex justify-content-center gap-2">
                    <button type="button" class="btn btn-secondary rounded-pill px-4 fw-semibold" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark me-1"></i> No, Cancel
                    </button>
                    <button type="button" class="btn btn-danger rounded-pill px-4 fw-bold" id="confirmDeletePhotoBtn">
                        <i class="fa-solid fa-trash me-1"></i> Yes, Delete
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection
