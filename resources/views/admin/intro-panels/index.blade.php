@extends('layouts.admin')

@section('title', 'Manage Intro Panels')

@section('content')
<div class="glass-card">
    <!-- Intro Settings -->
    <div class="mb-4 border-bottom border-light pb-4">
        <form action="{{ route('admin.intro-panels.update-settings') }}" method="POST" class="d-flex align-items-center justify-content-between">
            @csrf
            <div>
                <h5 class="fw-bold mb-1">Intro Configuration</h5>
                <p class="text-secondary small mb-0">Toggle the Marvel-style intro animation on homepage load.</p>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="intro_active" value="1" id="introToggle" {{ $introActive == '1' ? 'checked' : '' }} style="transform: scale(1.5);">
                    <label class="form-check-label ms-2 fw-bold" for="introToggle">Enable Intro</label>
                </div>
                <button type="submit" class="btn btn-dark btn-sm rounded-0 text-uppercase fw-bold">
                    <i class="fas fa-save me-1"></i> Save
                </button>
            </div>
        </form>
    </div>

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-0">Intro Panels List</h4>
        </div>
        <a href="{{ route('admin.intro-panels.create') }}" class="btn btn-premium">
            <i class="fas fa-plus me-2"></i> Add Panel
        </a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Preview</th>
                    <th>Title</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($banners as $banner)
                <tr>
                    <td>
                        <img src="{{ Str::startsWith($banner->image_path, 'http') ? $banner->image_path : asset('storage/' . $banner->image_path) }}" 
                             alt="{{ $banner->title }}" 
                             style="width: 80px; height: 80px; object-fit: cover; border-radius: 4px; border: 2px solid crimson; filter: grayscale(100%) contrast(1.5);">
                    </td>
                    <td><span class="fw-bold">{{ $banner->title ?? 'Panel ' . $banner->order }}</span></td>
                    <td><code>{{ $banner->order }}</code></td>
                    <td>
                        <span class="status-badge {{ $banner->is_active ? 'status-active' : 'status-inactive' }}">
                            {{ $banner->is_active ? 'Active' : 'Hidden' }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.intro-panels.edit', $banner->id) }}" class="btn btn-sm btn-outline-info">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.intro-panels.destroy', $banner->id) }}" method="POST" onsubmit="return confirm('Delete this intro panel?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-secondary py-4">
                        <i class="fas fa-film fa-3x mb-3 opacity-50"></i>
                        <p>No intro panels yet. Create your first one!</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
