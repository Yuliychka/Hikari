@extends('layouts.admin')

@section('title', 'Recruit New Staff')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="glass-card">
            <h4 class="mb-4 text-uppercase fw-900 border-start border-crimson border-4 ps-3">Awaken New Staff Member</h4>
            
            <form action="{{ route('admin.users.store_staff') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold text-uppercase small">Identification Name</label>
                    <input type="text" name="name" class="form-control rounded-0 border-dark" required placeholder="Enter player name">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold text-uppercase small">System Email Account</label>
                    <input type="email" name="email" class="form-control rounded-0 border-dark" required placeholder="player@hikari.com">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold text-uppercase small">Assigned Role (Job)</label>
                        <select name="role" class="form-select rounded-0 border-dark" required>
                            <option value="admin">SHADOW MONARCH (ADMIN)</option>
                            <option value="manager">GUILD MASTER (MANAGER)</option>
                            <option value="seller">MONSTER MERCHANT (SELLER)</option>
                            <option value="delivery">SHADOW EXTRACTOR (DELIVERY)</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold text-uppercase small">Access Encryption (Password)</label>
                        <input type="password" name="password" class="form-control rounded-0 border-dark" required placeholder="Min 8 characters">
                    </div>
                </div>

                <div class="mt-4 pt-3 border-top">
                    <button type="submit" class="btn btn-premium w-100 py-3">
                        <i class="fas fa-check-circle me-2"></i> INITIALIZE RECRUITMENT
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-dark w-100 mt-2 py-2 rounded-0">
                        ABORT PROCEDURE
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .glass-card { background: #fff; border: 2px solid #000; box-shadow: 8px 8px 0 rgba(0,0,0,0.1); padding: 2.5rem; }
    .border-crimson { border-color: crimson !important; }
    .fw-900 { font-weight: 900; }
    .btn-premium {
        background: #000 !important;
        border: 2px solid #000 !important;
        color: #fff !important;
        border-radius: 0 !important;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 2px;
    }
    .btn-premium:hover { background: crimson !important; border-color: crimson !important; }
    .form-control:focus, .form-select:focus {
        border-color: crimson;
        box-shadow: none;
    }
</style>
@endsection
