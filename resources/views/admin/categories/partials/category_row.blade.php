@php
    $depth = $depth ?? 0;
    $padding = $depth * 25;
@endphp

<tr class="category-row {{ $category->parent_id ? 'child-of-' . $category->parent_id . ' d-none' : 'parent-row' }}" 
    style="cursor: pointer; background: {{ $depth == 0 ? 'rgba(220, 20, 60, 0.02)' : 'white' }};" 
    onclick="toggleSubChapters({{ $category->id }})">
    
    <td class="text-center" style="width: 50px;">
        @if($category->children->count() > 0)
            <i class="fas fa-chevron-right transition-transform" id="icon-{{ $category->id }}"></i>
        @endif
    </td>
    
    <td style="padding-left: {{ $padding + 15 }}px !important;">
        <div class="d-flex align-items-center">
            @if($depth > 0)
                <i class="fas fa-level-up-alt fa-rotate-90 text-secondary me-2" style="opacity: 0.5;"></i>
            @endif
            
            @if($category->image_path)
                <img src="{{ Str::startsWith($category->image_path, 'http') ? $category->image_path : asset('storage/' . $category->image_path) }}" 
                     class="rounded-3 me-3" style="width: {{ 45 - ($depth * 5) }}px; height: {{ 45 - ($depth * 5) }}px; object-fit: cover; border: 2px solid #000;">
            @else
                <div class="rounded-3 me-3 bg-secondary d-flex align-items-center justify-content-center text-white" 
                     style="width: {{ 45 - ($depth * 5) }}px; height: {{ 45 - ($depth * 5) }}px; font-size: 0.7rem;">
                    <i class="fas fa-image"></i>
                </div>
            @endif
            
            <div>
                <div class="fw-bold text-uppercase d-flex align-items-center">
                    {{ $category->name }}
                    @if($depth == 0)
                        <span class="badge bg-dark ms-2" style="font-size: 0.6rem;">MAIN CHAPTER</span>
                    @else
                        <span class="badge bg-secondary ms-2" style="font-size: 0.55rem; opacity: 0.7;">SUB v{{ $depth }}</span>
                    @endif
                </div>
                <small class="text-secondary font-monospace" style="font-size: 0.7rem;">{{ $category->slug }}</small>
            </div>
        </div>
    </td>
    
    <td>
        <span class="badge rounded-pill {{ $category->children->count() > 0 ? 'bg-crimson' : 'bg-secondary' }} px-3" style="font-size: 0.7rem;">
            {{ $category->children->count() }} CHILDREN
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
            <a href="{{ route('admin.categories.create', ['parent_id' => $category->id]) }}" 
               class="btn btn-outline-dark btn-sm py-0 px-2" style="font-size: 0.65rem;" title="Add Sub-chapter">
                <i class="fas fa-plus me-1"></i> SUB
            </a>
            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-outline-info btn-sm">
                <i class="fas fa-edit"></i>
            </a>
            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Delete this chapter and ALL its descendants?');">
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
    @include('admin.categories.partials.category_row', ['category' => $child, 'depth' => $depth + 1])
@endforeach
