@extends('layouts.admin')

@section('title', 'Manage Flash Sales')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-white">Flash Sales</h2>
            <a href="{{ route('admin.flash-sales.create') }}" class="btn btn-premium">
                <i class="bi bi-plus-lg"></i> Create New Flash Sale
            </a>
        </div>

        <div class="glass-card">
            <table class="table table-dark table-hover align-middle">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Banner</th>
                        <th>End Time</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($flashSales as $sale)
                    <tr>
                        <td>{{ $sale->title }}</td>
                        <td>
                            @if($sale->banner_image)
                            <img src="{{ Storage::url($sale->banner_image) }}" class="rounded" style="height: 50px; width: 100px; object-fit: cover;">
                            @else
                            <span class="text-secondary">-</span>
                            @endif
                        </td>
                        <td>{{ $sale->end_time->format('M d, Y H:i') }}</td>
                        <td>
                            <span class="badge {{ $sale->is_active ? 'bg-success' : 'bg-secondary' }}">
                                {{ $sale->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.flash-sales.edit', $sale->id) }}" class="btn btn-sm btn-outline-info me-2">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.flash-sales.destroy', $sale->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this Flash Sale?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
