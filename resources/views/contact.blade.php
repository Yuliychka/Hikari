@extends('layouts.frontend')

@php
    $title = 'Contact Us - Hikari Anime Store';
@endphp

@push('styles')
    <style>
        .contact-header {
            background: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.8)), url('https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?q=80&w=1920&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            padding: 6rem 0;
            border-bottom: 4px solid crimson;
            text-align: center;
        }

        .contact-card {
            background: rgba(0, 0, 0, 0.9);
            border: 2px solid crimson;
            padding: 3rem;
            box-shadow: 0 0 30px rgba(220, 20, 60, 0.2);
            position: relative;
            overflow: hidden;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(220, 20, 60, 0.3);
            color: #fff;
            border-radius: 0;
            padding: 0.8rem;
            transition: all 0.3s;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: crimson;
            box-shadow: 0 0 10px rgba(220, 20, 60, 0.3);
            color: #fff;
        }

        .contact-info-item {
            margin-bottom: 2rem;
            transition: transform 0.3s;
        }

        .contact-info-item:hover {
            transform: translateX(10px);
        }

        .info-icon {
            width: 50px;
            height: 50px;
            background: crimson;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
            box-shadow: 0 0 15px rgba(220, 20, 60, 0.5);
        }

        .kanji-bg {
            position: absolute;
            font-size: 15rem;
            color: rgba(220, 20, 60, 0.03);
            font-weight: 900;
            z-index: -1;
            pointer-events: none;
            bottom: -50px;
            right: -50px;
        }
        @media (max-width: 991px) {
            .contact-header { padding: 4rem 1rem; }
            .contact-card { padding: 1.5rem; }
            .kanji-bg { font-size: 8rem; bottom: -20px; right: -20px; }
            .contact-info-item { text-align: center; }
            .info-icon { margin-left: auto; margin-right: auto; }
        }
    </style>
@endpush

@section('content')
<header class="contact-header">
    <div class="container">
        <h1 class="display-3 fw-bold" style="font-family: 'Kaushan Script', cursive; color: crimson; text-shadow: 3px 3px 0 #fff;">Contact Us</h1>
        <p class="lead text-white-50">Have a Question? Our Team is Ready to Help.</p>
    </div>
</header>

<div class="container py-5">
    <div class="row g-5">
        <!-- Contact Info -->
        <div class="col-lg-4" data-aos="fade-right">
            <div class="contact-info-item">
                <div class="info-icon">
                    <i class="bi bi-geo-alt-fill"></i>
                </div>
                <h4 class="fw-bold text-uppercase">Headquarters</h4>
                <p class="text-secondary">Akihabara District, 1-2-3 Chiyoda<br>Tokyo, Japan 101-0021</p>
            </div>

            <div class="contact-info-item">
                <div class="info-icon">
                    <i class="bi bi-envelope-at-fill"></i>
                </div>
                <h4 class="fw-bold text-uppercase">Email Support</h4>
                <p class="text-secondary">support@hikari-store.jp<br>orders@hikari-store.jp</p>
            </div>

            <div class="contact-info-item">
                <div class="info-icon">
                    <i class="bi bi-telephone-outbound-fill"></i>
                </div>
                <h4 class="fw-bold text-uppercase">Phone Line</h4>
                <p class="text-secondary">+81 (03) 1234-5678<br>Mon-Fri: 9AM - 6PM JST</p>
            </div>

            <div class="mt-5">
                <h6 class="text-danger text-uppercase fw-bold mb-3">Join Our Community</h6>
                <div class="d-flex gap-3">
                    <a href="{{ \App\Models\Setting::get('facebook_url', '#') }}" target="_blank" class="btn btn-outline-light rounded-circle p-2" style="width: 40px; height: 40px;"><i class="bi bi-facebook"></i></a>
                    <a href="{{ \App\Models\Setting::get('discord_url', '#') }}" target="_blank" class="btn btn-outline-light rounded-circle p-2" style="width: 40px; height: 40px;"><i class="bi bi-discord"></i></a>
                    <a href="{{ \App\Models\Setting::get('twitter_url', '#') }}" target="_blank" class="btn btn-outline-light rounded-circle p-2" style="width: 40px; height: 40px;"><i class="bi bi-twitter-x"></i></a>
                    <a href="{{ \App\Models\Setting::get('instagram_url', '#') }}" target="_blank" class="btn btn-outline-light rounded-circle p-2" style="width: 40px; height: 40px;"><i class="bi bi-instagram"></i></a>
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="col-lg-8" data-aos="fade-left">
            <div class="contact-card">
                <div class="kanji-bg">話</div>
                <h2 class="fw-bold mb-4 text-uppercase" style="letter-spacing: 2px;">Send a Message</h2>
                <form>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-secondary text-uppercase">Your Name</label>
                            <input type="text" class="form-control" placeholder="Ichigo Kurosaki">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-secondary text-uppercase">Email Address</label>
                            <input type="email" class="form-control" placeholder="ichigo@soul-society.com">
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-bold text-secondary text-uppercase">Subject</label>
                            <input type="text" class="form-control" placeholder="Inquiry about Zanpakuto">
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-bold text-secondary text-uppercase">Message</label>
                            <textarea class="form-control" rows="5" placeholder="Write your message here..."></textarea>
                        </div>
                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-danger btn-lg w-100 rounded-0 fw-bold py-3 text-uppercase" style="letter-spacing: 3px;">
                                Send to the Void <i class="bi bi-send-fill ms-2"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
