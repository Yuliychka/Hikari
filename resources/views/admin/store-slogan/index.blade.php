@extends('layouts.admin')

@section('title', 'Manage Store Slogun')

@section('content')
<div class="container-fluid">
    <div class="card bg-dark text-white border-secondary mb-4">
        <div class="card-header border-secondary d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Products Page Header</h5>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('admin.store-slogan.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label">Title (Main Text)</label>
                    <input type="text" name="store_slogan_title" class="form-control bg-dark text-white border-secondary" 
                           value="{{ old('store_slogan_title', $settings['store_slogan_title']) }}" required>
                    <small class="text-secondary">Appears as the large heading (Default: "Anime Collection").</small>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Subtitle (Small Text)</label>
                    <input type="text" name="store_slogan_subtitle" class="form-control bg-dark text-white border-secondary" 
                           value="{{ old('store_slogan_subtitle', $settings['store_slogan_subtitle']) }}" required>
                    <small class="text-secondary">Appears underneath the title (Default: "Discover Your Next Obsession").</small>
                </div>

                <div class="mb-4">
                    <label class="form-label">Background Image (Optional)</label>
                    <input type="file" name="store_slogan_image" class="form-control bg-dark text-white border-secondary" accept="image/*">
                    <small class="text-secondary">If no image is provided, the background will default to a solid black design.</small>
                    
                    @if(isset($settings['store_slogan_image']) && $settings['store_slogan_image'])
                        <div class="mt-3">
                            <label class="form-label d-block text-muted">Current Image:</label>
                            <img src="{{ asset('storage/' . $settings['store_slogan_image']) }}" alt="Slogan Background" style="max-height: 150px; border-radius: 4px; border: 1px solid #555;">
                        </div>
                    @endif
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-danger px-4 fw-bold">Save Settings</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
