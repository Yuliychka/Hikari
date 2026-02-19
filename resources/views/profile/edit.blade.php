@extends('layouts.frontend')

@section('content')
<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8" data-aos="fade-up">
            <div class="glass-card p-5" style="background: rgba(0,0,0,0.9); border: 2px solid crimson;">
                <h2 class="section-header text-start mb-5" style="font-size: 2.5rem;">Modify Identity</h2>

                <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="row g-4">
                    @csrf
                    @method('patch')

                    <div class="col-md-12 text-center mb-4">
                        <div class="mb-3">
                            @if($user->avatar)
                                <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="mb-3" style="width: 120px; height: 120px; border: 2px solid crimson; border-radius: 10px; object-fit: cover;">
                            @endif
                            <label class="form-label d-block text-white-50 small text-uppercase fw-bold">Update Avatar</label>
                            <input type="file" name="avatar" class="form-control bg-dark text-white border-crimson">
                            @error('avatar') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-white-50 small text-uppercase fw-bold">Name</label>
                        <input type="text" name="name" class="form-control bg-dark text-white border-crimson" value="{{ old('name', $user->name) }}" required>
                        @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-white-50 small text-uppercase fw-bold">Email</label>
                        <input type="email" name="email" class="form-control bg-dark text-white border-crimson" value="{{ old('email', $user->email) }}" required>
                        @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-white-50 small text-uppercase fw-bold">Phone</label>
                        <input type="text" name="phone" class="form-control bg-dark text-white border-crimson" value="{{ old('phone', $user->phone) }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-white-50 small text-uppercase fw-bold">City / Village</label>
                        <input type="text" name="city" class="form-control bg-dark text-white border-crimson" value="{{ old('city', $user->city) }}">
                    </div>

                    <div class="col-12">
                        <label class="form-label text-white-50 small text-uppercase fw-bold">Full Address</label>
                        <textarea name="address" rows="3" class="form-control bg-dark text-white border-crimson">{{ old('address', $user->address) }}</textarea>
                    </div>

                    <div class="col-12 mt-5">
                        <button type="submit" class="btn btn-danger btn-lg px-5 rounded-0 fw-bold w-100" style="letter-spacing: 2px;">REFORGE IDENTITY</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .border-crimson { border-color: rgba(220, 20, 60, 0.5) !important; }
    .form-control:focus { background: #111; border-color: crimson; color: #fff; box-shadow: 0 0 10px rgba(220, 20, 60, 0.3); }
</style>
@endsection
