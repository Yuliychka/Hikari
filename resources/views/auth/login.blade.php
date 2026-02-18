@extends('layouts.frontend')

@php
    $title = 'HIKARI ACCESS - Login';
@endphp

@push('styles')
<style>
    .auth-container {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        background: radial-gradient(circle at center, rgba(220, 20, 60, 0.05) 0%, transparent 70%);
    }

    .auth-card {
        background: rgba(0, 0, 0, 0.8);
        border: 2px solid crimson;
        box-shadow: 10px 10px 0 crimson;
        width: 100%;
        max-width: 450px;
        padding: 3rem;
        backdrop-filter: blur(15px);
        position: relative;
        overflow: hidden;
    }

    .auth-card::before {
        content: 'ACCESS';
        position: absolute;
        top: -20px;
        right: -20px;
        font-size: 5rem;
        font-weight: 900;
        color: rgba(220, 20, 60, 0.05);
        z-index: 0;
        transform: rotate(-15deg);
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
    .glitch-auth::after {
        content: attr(data-text);
        position: absolute;
        left: 2px;
        text-shadow: -1px 0 red;
        top: 0;
        color: white;
        background: black;
        overflow: hidden;
        clip: rect(0, 900px, 0, 0);
        animation: noise-anim 2s infinite linear alternate-reverse;
    }

    @keyframes noise-anim {
        0% { clip: rect(41px, 9999px, 86px, 0); }
        10% { clip: rect(10px, 9999px, 50px, 0); }
        /* ... simplified glitch ... */
    }
</style>
@endpush

@section('content')
<div class="auth-container">
    <div class="auth-card" data-aos="zoom-in">
        <h2 class="auth-title glitch-auth" data-text="HIKARI ACCESS">HIKARI ACCESS</h2>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4 text-success" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-4">
                <label for="email" class="form-label">Username / Email</label>
                <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="current-password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="mb-4 form-check">
                <input id="remember_me" type="checkbox" class="form-check-input" name="remember" style="background-color: transparent; border: 1px solid #444;">
                <label class="form-check-label ms-2" for="remember_me" style="font-size: 0.75rem; color: #888;">REMEMBER MY SESSION</label>
            </div>

            <button type="submit" class="btn-auth">
                INITIATE LOGIN
            </button>

            <div class="auth-links">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">LOST CREDENTIALS?</a>
                    <span class="mx-2 text-dark">|</span>
                @endif
                <a href="{{ route('register') }}">JOIN THE SQUAD</a>
            </div>
        </form>
    </div>
</div>
@endsection
