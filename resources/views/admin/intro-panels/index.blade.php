@extends('layouts.admin')

@section('title', 'Manage Intro Panels')

@section('content')
<div class="glass-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-0">Intro Panels (Manga Animation)</h4>
            <p class="text-secondary small mb-0">Manage the manga-style intro animation panels</p>
        </div>
        <a href="{{ route('admin.intro-panels.create') }}" class="btn btn-premium">
            <i class="fas fa-plus me-2"></i> Add Intro Panel
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
