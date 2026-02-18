@extends('layouts.frontend')

@php
    $title = 'SQUAD INITIATION - Register';
@endphp

@push('styles')
<style>
    .auth-container {
        min-height: 85vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        background: radial-gradient(circle at center, rgba(220, 20, 60, 0.05) 0%, transparent 70%);
    }

    .auth-card {
        background: rgba(0, 0, 0, 0.85);
        border: 2px solid crimson;
        box-shadow: 10px 10px 0 crimson;
        width: 100%;
        max-width: 500px;
        padding: 3rem;
        backdrop-filter: blur(15px);
        position: relative;
        overflow: hidden;
    }

    .auth-card::before {
        content: 'INITIATE';
        position: absolute;
        bottom: -20px;
        left: -20px;
        font-size: 5rem;
        font-weight: 900;
        color: rgba(220, 20, 60, 0.05);
        z-index: 0;
        transform: rotate(15deg);
        pointer-events: none;
    }

    .auth-title {
        font-family: 'Kaushan Script', cursive;
        color: crimson;
        font-size: 2.5rem;
        margin-bottom: 2rem;
        text-align: center;
    }

    .form-label {
        color: #fff;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.8rem;
    }

    .form-control {
        background: rgba(0, 0, 0, 0.5) !important;
        border: 1px solid #333 !important;
        border-radius: 0 !important;
        color: #fff !important;
        padding: 0.8rem 1rem;
        transition: all 0.3s;
    }

    .form-control:focus {
        border-color: crimson !important;
        box-shadow: 0 0 10px rgba(220, 20, 60, 0.3) !important;
    }

    .btn-auth {
        background: crimson;
        color: #fff;
        border: none;
        border-radius: 0;
        padding: 1rem;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 2px;
        width: 100%;
        margin-top: 1.5rem;
        transition: all 0.3s;
        box-shadow: 4px 4px 0 #fff;
    }

    .btn-auth:hover {
        background: #fff;
        color: crimson;
        box-shadow: 4px 4px 0 crimson;
        transform: translate(-2px, -2px);
    }

    .auth-links {
        margin-top: 2rem;
        text-align: center;
        font-size: 0.85rem;
    }

    .auth-links a {
        color: #aaa;
        text-decoration: none;
        transition: color 0.3s;
    }

    .auth-links a:hover {
        color: crimson;
    }

    .glitch-auth {
        position: relative;
    }
</style>
@endpush

@section('content')
<div class="auth-container">
    <div class="auth-card" data-aos="flip-up">
        <h2 class="auth-title glitch-auth" data-text="SQUAD INITIATION">SQUAD INITIATION</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="form-label">Full Name</label>
                <input id="name" class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email Address -->
            <div class="mb-4">
                <label for="email" class="form-label">Email Address</label>
                <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="new-password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password">
            </div>

            <button type="submit" class="btn-auth">
                REGISTER TO HIKARI
            </button>

            <div class="auth-links">
                <a href="{{ route('login') }}">ALREADY IN THE SQUAD? LOGIN</a>
            </div>
        </form>
    </div>
</div>
@endsection
