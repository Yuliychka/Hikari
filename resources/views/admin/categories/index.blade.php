@extends('layouts.admin')

@section('title', 'Category Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 font-weight-bold text-dark text-uppercase">Chapters & Collections</h2>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-premium">
        <i class="fas fa-plus me-2"></i> NEW MAIN CHAPTER
    </a>
</div>

<div class="glass-card p-0 overflow-hidden">
    <div class="table-responsive">
        <table class="table mb-0 align-middle">
            <thead>
                <tr>
                    <th style="width: 50px;"></th>
                    <th>CHAPTER NAME</th>
                    <th>SUB-CHAPTERS</th>
                    <th>BANNER SYNC</th>
                    <th class="text-end">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr class="parent-row" style="cursor: pointer; background: rgba(0, 0, 0, 0.03);" onclick="toggleSubCategories({{ $category->id }})">
                        <td class="text-center" style="width: 50px;">
                            @if($category->children->count() > 0)
                                <i class="fas fa-chevron-right transition-transform" id="icon-{{ $category->id }}"></i>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                @if($category->image_path)
                                    <img src="{{ Str::startsWith($category->image_path, 'http') ? $category->image_path : asset('storage/' . $category->image_path) }}" 
                                         class="rounded-3 me-3" style="width: 45px; height: 45px; object-fit: cover; border: 2px solid #000;">
                                @else
                                    <div class="rounded-3 me-3 bg-secondary d-flex align-items-center justify-content-center text-white" style="width: 45px; height: 45px; font-size: 0.8rem;">
                                        <i class="fas fa-image"></i>
                                    </div>
                                @endif
                                <div>
                                    <div class="fw-bold text-uppercase d-flex align-items-center">
                                        {{ $category->name }}
                                        <span class="badge bg-dark ms-2" style="font-size: 0.6rem;">CATEGORY</span>
                                    </div>
                                    <small class="text-secondary font-monospace">{{ $category->slug }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge rounded-pill {{ $category->children->count() > 0 ? 'bg-crimson' : 'bg-secondary' }} px-3">
                                {{ $category->children->count() }} SUBCATEGORIES
                            </span>
                        </td>
                        <td>
                            <div class="d-flex flex-column gap-1">
                                <span class="badge {{ $category->is_active ? 'bg-success' : 'bg-danger' }} py-1" style="font-size: 0.65rem;">
                                    {{ $category->is_active ? 'VISIBLE' : 'HIDDEN' }}
                                </span>
                                <span class="text-secondary small fw-bold" style="font-size: 0.65rem;">ORDER: {{ $category->order }}</span>
                            </div>
                        </td>
                        <td class="text-end" onclick="event.stopPropagation()">
                            <div class="btn-group gap-2">
                                <a href="{{ route('admin.categories.create', ['parent_id' => $category->id]) }}" class="btn btn-outline-dark btn-sm py-0 px-2" style="font-size: 0.7rem;">
                                    <i class="fas fa-plus me-1"></i> ADD SUB
                                </a>
                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-outline-info btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Delete this category and all its subcategories?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @foreach($category->children as $child)
                        <tr class="child-row-{{ $category->id }} d-none" style="background: white;">
                            <td></td>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-level-up-alt fa-rotate-90 text-secondary me-2"></i>
                                    @if($child->image_path)
                                        <img src="{{ Str::startsWith($child->image_path, 'http') ? $child->image_path : asset('storage/' . $child->image_path) }}" 
                                             class="rounded-3 me-2" style="width: 30px; height: 30px; object-fit: cover; border: 1px solid #000;">
                                    @endif
                                    <span>{{ $child->name }}</span>
                                </div>
                            </td>
                            <td><small class="text-secondary text-uppercase" style="font-size: 0.65rem;">SUBCATEGORY</small></td>
                            <td>
                                <span class="badge {{ $child->is_active ? 'bg-success' : 'bg-danger' }} py-0 px-2" style="font-size: 0.6rem;">
                                    {{ $child->is_active ? 'VISIBLE' : 'HIDDEN' }}
                                </span>
                            </td>
                            <td class="text-end">
                                <div class="btn-group gap-2">
                                    <a href="{{ route('admin.categories.edit', $child->id) }}" class="btn btn-outline-secondary btn-sm" style="font-size: 0.7rem;">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.categories.destroy', $child->id) }}" method="POST" onsubmit="return confirm('Delete this subcategory?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm" style="font-size: 0.7rem;">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<style>
    .bg-crimson { background-color: crimson; color: white; }
    .transition-transform { transition: transform 0.3s ease; }
    .rotate-90 { transform: rotate(90deg); }
    .parent-row:hover { background: rgba(0, 0, 0, 0.05) !important; }
</style>

<script>
function toggleSubCategories(parentId) {
    const rows = document.querySelectorAll('.child-row-' + parentId);
    const icon = document.getElementById('icon-' + parentId);
    
    rows.forEach(row => {
        row.classList.toggle('d-none');
    });
    
    if (icon) {
        icon.classList.toggle('rotate-90');
    }
}
</script>
@endsection
