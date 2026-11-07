@extends('admin.layouts.app')

@section('title', 'Manage Photo Gallery')
@section('page_title', 'Organization Photo Gallery')

@section('content')

    <div class="row align-items-center mb-4 g-3">
        <div class="col-md-6">
            <h5 class="mb-0 text-navy fw-bold">Humanitarian Field Gallery</h5>
            <p class="text-muted small mb-0">Upload and curate photographs of projects, disaster relief, and community activities</p>
        </div>
        <div class="col-md-6 text-md-end">
            <button type="button" class="btn btn-teal" data-bs-toggle="modal" data-bs-target="#uploadPhotoModal">
                <i class="fa-solid fa-cloud-arrow-up me-1"></i> Add New Photograph
            </button>
        </div>
    </div>

    <!-- Category Filter Bar -->
    <div class="admin-card mb-4">
        <div class="admin-card-body p-3">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('admin.gallery.index') }}" class="btn btn-sm {{ !request('category') ? 'btn-teal' : 'btn-outline-secondary' }}">
                        All Albums
                    </a>
                    @foreach($categories as $cat)
                        @if($cat)
                            <a href="{{ route('admin.gallery.index', ['category' => $cat]) }}" class="btn btn-sm {{ request('category') == $cat ? 'btn-teal' : 'btn-outline-secondary' }}">
                                {{ $cat }}
                            </a>
                        @endif
                    @endforeach
                </div>
                <span class="text-muted small">Total Photos: <strong>{{ $images->total() }}</strong></span>
            </div>
        </div>
    </div>

    <!-- Gallery Grid -->
    <div class="row g-4">
        @forelse($images as $img)
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 border shadow-sm rounded-3 overflow-hidden">
                    <div class="position-relative" style="height: 190px; background: #f1f5f9;">
                        <img src="{{ $img->image_url }}" class="w-100 h-100 object-fit-cover" alt="{{ $img->title }}">
                        <span class="badge bg-dark bg-opacity-75 text-white position-absolute top-0 start-0 m-2 font-monospace small">
                            {{ $img->category }}
                        </span>
                    </div>
                    <div class="card-body p-3 d-flex flex-column">
                        <h6 class="card-title text-navy fw-bold mb-1 text-truncate">{{ $img->title }}</h6>
                        <p class="card-text text-muted small flex-grow-1 text-truncate-2" style="font-size: 0.8rem;">
                            {{ $img->description ?? 'SDC humanitarian mission activity photograph.' }}
                        </p>
                        <div class="d-flex justify-content-between align-items-center pt-2 border-top mt-2">
                            <span class="badge bg-light text-muted border small">Order: #{{ $img->order }}</span>
                            <form action="{{ route('admin.gallery.destroy', $img->id) }}" method="POST" onsubmit="return confirm('Remove this photograph from public gallery?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger p-1 px-2" title="Delete Photo">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="admin-card text-center py-5">
                    <div class="text-muted">
                        <i class="fa-regular fa-images fa-3x mb-3 text-secondary opacity-50"></i>
                        <h6>No photographs uploaded yet in this category</h6>
                        <p class="small mb-3">Add real photos to showcase the community impact of SDC missions.</p>
                        <button type="button" class="btn btn-teal btn-sm" data-bs-toggle="modal" data-bs-target="#uploadPhotoModal">Upload Photo</button>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    @if($images->hasPages())
        <div class="mt-4 d-flex justify-content-end">
            {{ $images->links() }}
        </div>
    @endif

    <!-- Upload Photo Modal -->
    <div class="modal fade" id="uploadPhotoModal" tabindex="-1" aria-labelledby="uploadPhotoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-navy text-white">
                    <h5 class="modal-title fs-6" id="uploadPhotoModalLabel"><i class="fa-solid fa-cloud-arrow-up me-2 text-teal"></i>Upload Photograph to Gallery</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body p-4">
                        @if ($errors->any())
                            <div class="alert alert-danger py-2 px-3 small mb-3">
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="title" class="form-label fw-bold text-navy small">Photo Caption / Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required placeholder="e.g. Distribution of Ration Kits in Karaitivu">
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label fw-bold text-navy small">Category / Album <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="category" name="category" list="categoryOptions" value="{{ old('category') }}" required placeholder="e.g. Water Sanitation, Education Support, Healthcare">
                            <datalist id="categoryOptions">
                                <option value="Clean Water">
                                <option value="Education">
                                <option value="Vocational Training">
                                <option value="Healthcare">
                                <option value="Community Outreach">
                                <option value="Events">
                                <option value="Disaster Relief">
                                <option value="Orphan Care">
                            </datalist>
                        </div>

                        <!-- Direct File Upload from Computer / Device -->
                        <div class="mb-3">
                            <label for="image_file" class="form-label fw-bold text-navy small">
                                <i class="fa-solid fa-file-arrow-up text-teal me-1"></i> Upload Image File <span class="text-muted fw-normal">(from Device)</span>
                            </label>
                            <input type="file" class="form-control" id="image_file" name="image_file" accept="image/jpeg,image/png,image/webp,image/jpg" onchange="previewGalleryImage(event)">
                            <div class="form-text small">Select JPEG, PNG, or WEBP photograph (Max size: 10MB).</div>
                        </div>

                        <!-- Live Preview -->
                        <div id="galleryImagePreviewWrapper" class="mb-3 text-center d-none">
                            <div class="border rounded p-2 bg-light d-inline-block position-relative">
                                <img id="galleryImagePreview" src="#" alt="Selected Image Preview" style="max-height: 180px; max-width: 100%; border-radius: 6px; object-fit: contain;">
                                <div class="small text-muted mt-1"><i class="fa-regular fa-image me-1"></i>Selected Photo Preview</div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center my-3">
                            <hr class="flex-grow-1 my-0 opacity-25">
                            <span class="px-2 small text-muted text-uppercase fw-semibold" style="font-size: 0.72rem;">OR Provide Web URL</span>
                            <hr class="flex-grow-1 my-0 opacity-25">
                        </div>

                        <div class="mb-3">
                            <label for="image_path" class="form-label fw-bold text-navy small">
                                <i class="fa-solid fa-link text-muted me-1"></i> Image Direct Web URL <span class="text-muted fw-normal">(Optional)</span>
                            </label>
                            <input type="url" class="form-control" id="image_path" name="image_path" value="{{ old('image_path') }}" placeholder="https://images.unsplash.com/photo-...">
                            <div class="form-text small">Use this only if you prefer linking an online image instead of uploading a file.</div>
                        </div>

                        <div class="mb-3">
                            <label for="order" class="form-label fw-bold text-navy small">Display Sort Order</label>
                            <input type="number" class="form-control" id="order" name="order" value="{{ old('order', 0) }}" min="0">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label fw-bold text-navy small">Short Description</label>
                            <textarea class="form-control" id="description" name="description" rows="2" placeholder="Brief context about this photograph...">{{ old('description') }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-teal"><i class="fa-solid fa-cloud-arrow-up me-1"></i> Upload & Save to Gallery</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function previewGalleryImage(event) {
            const file = event.target.files[0];
            const wrapper = document.getElementById('galleryImagePreviewWrapper');
            const preview = document.getElementById('galleryImagePreview');
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    wrapper.classList.remove('d-none');
                };
                reader.readAsDataURL(file);
            } else {
                wrapper.classList.add('d-none');
                preview.src = '#';
            }
        }
    </script>
    @endpush

@endsection
