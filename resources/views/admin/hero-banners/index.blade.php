@extends('layouts.admin')

@section('title', 'Manage Hero Banners')

@section('content')
<div class="glass-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-0">Hero Banners</h4>
            <p class="text-secondary small mb-0">Manage main hero section background images</p>
        </div>
        <a href="{{ route('admin.hero-banners.create') }}" class="btn btn-premium">
            <i class="fas fa-plus me-2"></i> Add Hero Banner
        </a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Preview</th>
                    <th>Title</th>
                    <th>Link/Route</th>
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
                             style="width: 120px; height: 70px; object-fit: cover; border-radius: 4px; border: 1px solid crimson;">
                    </td>
                    <td><span class="fw-bold">{{ $banner->title ?? 'Untitled' }}</span></td>
                    <td><small class="text-secondary">{{ $banner->link ?? 'N/A' }}</small></td>
                    <td><code>{{ $banner->order }}</code></td>
                    <td>
                        <span class="status-badge {{ $banner->is_active ? 'status-active' : 'status-inactive' }}">
                            {{ $banner->is_active ? 'Active' : 'Hidden' }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.hero-banners.edit', $banner->id) }}" class="btn btn-sm btn-outline-info">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.hero-banners.destroy', $banner->id) }}" method="POST" onsubmit="return confirm('Delete this hero banner?')">
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
                    <td colspan="6" class="text-center text-secondary py-4">
                        <i class="fas fa-image fa-3x mb-3 opacity-50"></i>
                        <p>No hero banners yet. Create your first one!</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
