@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="glass-card p-4">
                <h2 class="text-crimson mb-4 fw-bold"><i class="fas fa-cog me-2"></i> SITE SETTINGS</h2>

                <form action="{{ route('admin.settings.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="form-label text-white-50 small text-uppercase fw-bold">Facebook URL</label>
                        <div class="input-group">
                            <span class="input-group-text bg-crimson text-white border-0"><i class="fab fa-facebook-f"></i></span>
                            <input type="url" name="facebook_url" class="form-control bg-dark text-white border-crimson" value="{{ $settings['facebook_url'] ?? '' }}" placeholder="https://facebook.com/yourpage">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-white-50 small text-uppercase fw-bold">Instagram URL</label>
                        <div class="input-group">
                            <span class="input-group-text bg-crimson text-white border-0"><i class="fab fa-instagram"></i></span>
                            <input type="url" name="instagram_url" class="form-control bg-dark text-white border-crimson" value="{{ $settings['instagram_url'] ?? '' }}" placeholder="https://instagram.com/yourprofile">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-white-50 small text-uppercase fw-bold">Discord URL</label>
                        <div class="input-group">
                            <span class="input-group-text bg-crimson text-white border-0"><i class="fab fa-discord"></i></span>
                            <input type="url" name="discord_url" class="form-control bg-dark text-white border-crimson" value="{{ $settings['discord_url'] ?? '' }}" placeholder="https://discord.gg/yourserver">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label text-white-50 small text-uppercase fw-bold">Twitter (X) URL</label>
                        <div class="input-group">
                            <span class="input-group-text bg-crimson text-white border-0"><i class="fab fa-twitter"></i></span>
                            <input type="url" name="twitter_url" class="form-control bg-dark text-white border-crimson" value="{{ $settings['twitter_url'] ?? '' }}" placeholder="https://twitter.com/youraccount">
                        </div>
                    </div>

                    <div class="text-end mt-5">
                        <button type="submit" class="btn btn-danger px-5 py-2 fw-bold rounded-0 transition-all border-2 border-white shadow-lg">
                            SAVE SETTINGS
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .glass-card {
        background: rgba(0, 0, 0, 0.8);
        backdrop-filter: blur(15px);
        border: 2px solid crimson;
        box-shadow: 0 0 30px rgba(220, 20, 60, 0.2);
    }
    .text-crimson { color: crimson; }
    .border-crimson { border-color: rgba(220, 20, 60, 0.5) !important; }
    .form-control:focus {
        background: rgba(20, 20, 20, 1);
        border-color: crimson;
        color: white;
        box-shadow: 0 0 10px rgba(220, 20, 60, 0.3);
    }
    .input-group-text { width: 45px; justify-content: center; }
</style>
@endsection
