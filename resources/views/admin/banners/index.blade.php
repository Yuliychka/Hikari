@extends('layouts.admin')

@section('title', 'Manage Banners & Media')

@section('content')
<div class="glass-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-0">Banners & Intro Panels</h4>
            <p class="text-secondary small mb-0">Manage sliders, categories, and the manga intro</p>
        </div>
        <a href="{{ route('admin.banners.create') }}" class="btn btn-premium">
            <i class="fas fa-plus me-2"></i> Add New Image/Banner
        </a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Preview</th>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Link/Route</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($banners as $banner)
                <tr>
                    <td>
                        <img src="{{ Str::startsWith($banner->image_path, 'http') ? $banner->image_path : asset($banner->image_path) }}" 
                             alt="{{ $banner->title }}" 
                             style="width: 100px; height: 60px; object-fit: cover; border-radius: 4px; border: 1px solid crimson;">
                    </td>
                    <td><span class="fw-bold">{{ $banner->title ?? 'Untitled' }}</span></td>
                    <td>
                        <span class="badge bg-{{ $banner->type == 'intro' ? 'danger' : ($banner->type == 'hero' ? 'primary' : 'warning') }}">
                            {{ strtoupper($banner->type) }}
                        </span>
                    </td>
                    <td><small class="text-secondary">{{ $banner->link ?? 'N/A' }}</small></td>
                    <td><code>{{ $banner->order }}</code></td>
                    <td>
                        <span class="status-badge {{ $banner->is_active ? 'status-active' : 'status-inactive' }}">
                            {{ $banner->is_active ? 'Active' : 'Hidden' }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.banners.edit', $banner->id) }}" class="btn btn-sm btn-outline-info">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" onsubmit="return confirm('Delete this banner?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
