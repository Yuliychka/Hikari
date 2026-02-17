<div class="row">
    <div class="col-md-4 mb-4">
        <div class="border rounded p-3 bg-light">
            <h5 class="fw-bold mb-3">Add New {{ Str::singular($title) }}</h5>
            <form action="{{ route('admin.card-assets.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="asset_type" value="{{ $type }}">
                
                <div class="mb-3">
                    <label class="form-label small fw-bold text-uppercase">Name</label>
                    <input type="text" name="name" class="form-control" placeholder="{{ $placeholder }}" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label small fw-bold text-uppercase">Image</label>
                    <input type="file" name="image_file" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-dark w-100">
                    <i class="fas fa-plus me-2"></i> UPLOAD ASSET
                </button>
            </form>
        </div>
    </div>

    <div class="col-md-8">
        <h5 class="fw-bold mb-3">Existing {{ $title }}</h5>
        <div class="row g-3">
            @forelse($assets as $asset)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card h-100 shadow-sm border-0 position-relative group-hover">
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center p-2" style="height: 120px;">
                            <img src="{{ asset('storage/' . $asset->image_path) }}" alt="{{ $asset->name }}" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                        </div>
                        <div class="card-body p-2 text-center">
                            <h6 class="card-title small fw-bold mb-0 text-truncate">{{ $asset->name }}</h6>
                        </div>
                        
                        <form action="{{ route('admin.card-assets.destroy', ['type' => $type, 'id' => $asset->id]) }}" method="POST" class="position-absolute top-0 end-0 p-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm py-0 px-1" onclick="return confirm('Delete this asset?')" style="font-size: 0.7rem;">
                                <i class="fas fa-times"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5 text-muted">
                    <i class="fas fa-folder-open fa-3x mb-3"></i>
                    <p>No assets found. Upload one to get started.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
