@extends('layouts.admin')

@section('title', 'Manage Contact Slogan')

@section('content')
<div class="container-fluid">
    <div class="card bg-dark text-white border-secondary mb-4">
        <div class="card-header border-secondary d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Contact Us Page Header</h5>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('admin.contact-slogan.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label">Title (Main Text)</label>
                    <input type="text" name="contact_slogan_title" class="form-control bg-dark text-white border-secondary" 
                           value="{{ old('contact_slogan_title', $settings['contact_slogan_title']) }}" required>
                    <small class="text-secondary">Appears as the large heading (Default: "Contact Us").</small>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Subtitle (Small Text)</label>
                    <input type="text" name="contact_slogan_subtitle" class="form-control bg-dark text-white border-secondary" 
                           value="{{ old('contact_slogan_subtitle', $settings['contact_slogan_subtitle']) }}" required>
                    <small class="text-secondary">Appears underneath the title (Default: "Have a Question? Our Team is Ready to Help.").</small>
                </div>

                <div class="mb-4">
                    <h6 class="text-danger border-bottom border-secondary pb-2 mt-4">Contact Information</h6>
                </div>

                <div class="mb-3">
                    <label class="form-label">Headquarters Address</label>
                    <textarea name="contact_hq_address" class="form-control bg-dark text-white border-secondary" rows="2" required>{{ old('contact_hq_address', $settings['contact_hq_address']) }}</textarea>
                    <small class="text-secondary">Supports multiple lines. Appears under the "Headquarters" icon.</small>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Primary Email Support</label>
                        <input type="text" name="contact_email_support_1" class="form-control bg-dark text-white border-secondary" 
                               value="{{ old('contact_email_support_1', $settings['contact_email_support_1']) }}" required>
                        <small class="text-secondary">Appears as the first email address.</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Secondary Email Support (Optional)</label>
                        <input type="text" name="contact_email_support_2" class="form-control bg-dark text-white border-secondary" 
                               value="{{ old('contact_email_support_2', $settings['contact_email_support_2']) }}">
                        <small class="text-secondary">Appears below the first email address, if provided.</small>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Primary Phone Line</label>
                        <input type="text" name="contact_phone_line_1" class="form-control bg-dark text-white border-secondary" 
                               value="{{ old('contact_phone_line_1', $settings['contact_phone_line_1']) }}" required>
                        <small class="text-secondary">Appears as the first phone line or schedule detail.</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Secondary Phone Line (Optional)</label>
                        <input type="text" name="contact_phone_line_2" class="form-control bg-dark text-white border-secondary" 
                               value="{{ old('contact_phone_line_2', $settings['contact_phone_line_2']) }}">
                        <small class="text-secondary">Appears below the first phone line, if provided.</small>
                    </div>
                </div>

                <div class="mb-4">
                    <h6 class="text-danger border-bottom border-secondary pb-2 mt-4">Page Background</h6>
                </div>

                <div class="mb-4">
                    <label class="form-label">Background Image (Optional)</label>
                    <input type="file" name="contact_slogan_image" class="form-control bg-dark text-white border-secondary" accept="image/*">
                    <small class="text-secondary">If no image is provided, the background will default to a solid black design.</small>
                    
                    @if(isset($settings['contact_slogan_image']) && $settings['contact_slogan_image'])
                        <div class="mt-3">
                            <label class="form-label d-block text-muted">Current Image:</label>
                            <img src="{{ asset('storage/' . $settings['contact_slogan_image']) }}" alt="Contact Slogan Background" style="max-height: 150px; border-radius: 4px; border: 1px solid #555;">
                        </div>
                    @endif
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-danger px-4 fw-bold">Save Settings</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
