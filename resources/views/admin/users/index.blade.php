@extends('layouts.admin')

@section('title', 'System Member Management')

@section('content')
<div class="row g-4">
    <!-- Staff Management Section -->
    <div class="col-12">
        <div class="glass-card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0 text-uppercase fw-900 border-start border-crimson border-4 ps-3">Guild & Staff Personnel</h4>
                <a href="{{ route('admin.users.create_staff') }}" class="btn btn-premium">
                    <i class="fas fa-user-plus me-2"></i> RECRUIT STAFF
                </a>
            </div>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Member Name</th>
                            <th>Email</th>
                            <th>System Role (Status)</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($staff as $member)
                        <tr>
                            <td><span class="fw-bold">{{ $member->name }}</span></td>
                            <td><code>{{ $member->email }}</code></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <form action="{{ route('admin.users.update_role', $member->id) }}" method="POST" class="d-flex gap-1">
                                        @csrf
                                        <select name="role" class="form-select form-select-sm rounded-0 border-dark" onchange="this.form.submit()" style="width: auto; font-size: 0.75rem;">
                                            @foreach(['super admin', 'admin', 'manager', 'seller', 'delivery', 'user'] as $role)
                                                <option value="{{ $role }}" {{ $member->role == $role ? 'selected' : '' }}>{{ strtoupper($role) }}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                    @php
                                        $slRole = match($member->role) {
                                            'super admin' => 'NATIONAL LEVEL HUNTER',
                                            'admin' => 'SHADOW MONARCH',
                                            'manager' => 'GUILD MASTER',
                                            'seller' => 'MONSTER MERCHANT',
                                            'delivery' => 'SHADOW EXTRACTOR',
                                            default => 'HUNTER'
                                        };
                                    @endphp
                                    <span class="badge bg-dark rounded-0 border border-white text-uppercase sl-badge" style="white-space: nowrap;">
                                        {{ $slRole }}
                                    </span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <form action="{{ route('admin.users.destroy', $member->id) }}" method="POST" onsubmit="return confirm('Eliminate this staff member?')">
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
    </div>

    <!-- Client / Hunter Management Section -->
    <div class="col-12">
        <div class="glass-card mt-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0 text-uppercase fw-900 border-start border-crimson border-4 ps-3">Awakened Clients (Hunters)</h4>
            </div>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Player Name</th>
                            <th>Email</th>
                            <th>Shield Integrity (Warnings)</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $client)
                        <tr>
                            <td><span class="fw-bold">{{ $client->name }}</span></td>
                            <td><code>{{ $client->email }}</code></td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="warning-counter">
                                        @for($i = 0; $i < 3; $i++)
                                            <div class="warning-slot {{ $client->warnings > $i ? 'active' : '' }}"></div>
                                        @endfor
                                    </div>
                                    <span class="small fw-bold {{ $client->warnings >= 3 ? 'text-danger' : 'text-secondary' }}">
                                        {{ $client->warnings }} / 3 WARNINGS
                                    </span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex gap-2 align-items-center">
                                    <form action="{{ route('admin.users.update_role', $client->id) }}" method="POST" class="d-flex gap-1">
                                        @csrf
                                        <select name="role" class="form-select form-select-sm rounded-0 border-dark" onchange="this.form.submit()" style="width: 120px; font-size: 0.7rem;">
                                            <option value="user" selected>PLAYER (USER)</option>
                                            <option value="seller">PROMOTE: SELLER</option>
                                            <option value="delivery">PROMOTE: DELIVERY</option>
                                            <option value="manager">PROMOTE: MANAGER</option>
                                            <option value="admin">PROMOTE: ADMIN</option>
                                        </select>
                                    </form>
                                    <form action="{{ route('admin.users.add_warning', $client->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-warning" title="Add Warning">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.users.remove_warning', $client->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-success" title="Remove Warning">
                                            <i class="fas fa-heart"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.users.destroy', $client->id) }}" method="POST" onsubmit="return confirm('Eliminate this player?')">
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
    </div>
</div>

<style>
    .glass-card {
        background: #fff;
        border: 2px solid #000;
        box-shadow: 8px 8px 0 rgba(0,0,0,0.1);
        padding: 2rem;
    }
    .border-crimson { border-color: crimson !important; }
    .fw-900 { font-weight: 900; }
    
    .table thead th {
        font-family: 'Courier New', monospace;
        text-transform: uppercase;
        border-bottom: 2px solid #000;
    }

    .sl-badge {
        letter-spacing: 1px;
        font-size: 0.75rem;
        padding: 6px 10px;
    }

    /* Warning System Styling */
    .warning-counter {
        display: flex;
        gap: 5px;
    }
    .warning-slot {
        width: 25px;
        height: 6px;
        background: #eee;
        border: 1px solid #ddd;
    }
    .warning-slot.active {
        background: crimson;
        box-shadow: 0 0 5px crimson;
        border-color: #000;
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
        background: crimson !important;
        border-color: crimson !important;
    }
    .btn-outline-warning, .btn-outline-success, .btn-outline-danger {
        border-radius: 0 !important;
        border-width: 2px !important;
        font-weight: bold;
    }
</style>
@endsection
