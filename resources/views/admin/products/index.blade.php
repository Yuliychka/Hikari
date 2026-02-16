@extends('layouts.admin')

@section('title', 'Manage Products')

@section('content')
<div class="glass-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Product Catalog</h4>
        <a href="{{ route('admin.products.create') }}" class="btn btn-premium">
            <i class="fas fa-plus me-2"></i> Add New Product
        </a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Subcategory</th>
                    <th>Price</th>
                    <th>SKU</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>
                        <img src="{{ Str::startsWith($product->image, 'http') ? $product->image : asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                    </td>
                    <td><span class="fw-bold">{{ $product->name }}</span></td>
                    <td><span class="badge bg-dark rounded-0">{{ $product->category->name ?? 'N/A' }}</span></td>
                    <td><span class="badge bg-secondary rounded-0">{{ $product->subcategory->name ?? 'N/A' }}</span></td>
                    <td>${{ $product->price }}</td>
                    <td><code>{{ $product->sku }}</code></td>
                    <td>
                        <form action="{{ route('admin.products.toggle', $product->id) }}" method="POST" style="display:inline; cursor:pointer;" class="status-form">
                            @csrf
                            <button type="button" class="border-0 bg-transparent p-0 ajax-status-toggle" 
                                    data-id="{{ $product->id }}" 
                                    data-url="{{ route('admin.products.toggle', $product->id) }}"
                                    title="Click to Toggle Status">
                                <span class="badge {{ $product->status ? 'bg-dark' : 'bg-secondary' }} text-white rounded-0 text-uppercase border {{ $product->status ? 'border-white' : 'border-dark' }} status-badge-ui">
                                    {{ $product->status ? 'ACTIVE' : 'INACTIVE' }} <i class="fas fa-sync-alt ms-1 small opacity-50"></i>
                                </span>
                            </button>
                        </form>
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-outline-dark rounded-0">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Delete this product?')">
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

    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('.ajax-status-toggle').on('click', function(e) {
        e.preventDefault();
        const btn = $(this);
        const url = btn.data('url');
        const badge = btn.find('.status-badge-ui');
        
        btn.prop('disabled', true);
        
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if(response.success) {
                    badge.text(response.label + ' ');
                    badge.append('<i class="fas fa-sync-alt ms-1 small opacity-50"></i>');
                    
                    if(response.status) {
                        badge.removeClass('bg-secondary border-dark').addClass('bg-dark border-white');
                    } else {
                        badge.removeClass('bg-dark border-white').addClass('bg-secondary border-dark');
                    }
                }
                btn.prop('disabled', false);
            },
            error: function() {
                alert('An error occurred. Please try again.');
                btn.prop('disabled', false);
            }
        });
    });
});
</script>

<style>
    /* Manga Theme Overrides for Products Index */
    .glass-card {
        background: rgba(255, 255, 255, 0.95);
        border: 2px solid #000;
        box-shadow: 8px 8px 0 rgba(0,0,0,0.1);
        padding: 2rem;
    }
    .table thead th {
        font-family: 'Courier New', monospace;
        font-weight: bold;
        text-transform: uppercase;
        color: #000;
        border-bottom: 2px solid #000;
    }
    .btn-premium {
        background: #000 !important;
        border: 2px solid #000 !important;
        color: #fff !important;
        border-radius: 0 !important;
        font-weight: bold;
        text-transform: uppercase;
    }
    .btn-premium:hover {
        background: #fff !important;
        color: #000 !important;
    }
    .status-badge-ui {
        font-family: 'Courier New', monospace;
        font-weight: bold;
        letter-spacing: 1px;
    }
    .btn-outline-dark, .btn-outline-danger {
        border-radius: 0 !important;
    }
</style>
@endsection
