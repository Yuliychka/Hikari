    <p class="mb-4" style="color: rgba(255,255,255,0.5); font-size: 0.85rem;">
        {{ __("Update your account's profile information and email address.") }}
    </p>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="mb-4 text-center">
            @if($user->avatar)
                <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="rounded-circle mb-3 border border-danger p-1" style="width: 100px; height: 100px; object-fit: cover;">
            @else
                <div class="rounded-circle mb-3 border border-danger p-1 d-inline-flex align-items-center justify-content-center bg-dark" style="width: 100px; height: 100px;">
                    <i class="bi bi-person fs-1 text-crimson"></i>
                </div>
            @endif
            <div class="mt-2 text-start">
                <label for="avatar">{{ __('Avatar / Character Face') }}</label>
                <input id="avatar" name="avatar" type="file" class="form-control" accept="image/*" />
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-4">
                <label for="name">{{ __('Name') }}</label>
                <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                @if($errors->get('name'))
                    <div class="text-danger mt-1 small">{{ $errors->get('name')[0] }}</div>
                @endif
            </div>

            <div class="col-md-6 mb-4">
                <label for="email">{{ __('Email') }}</label>
                <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="username" />
                @if($errors->get('email'))
                    <div class="text-danger mt-1 small">{{ $errors->get('email')[0] }}</div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-4">
                <label for="phone">{{ __('Katana Hotline (Phone)') }}</label>
                <input id="phone" name="phone" type="text" class="form-control" value="{{ old('phone', $user->phone) }}" />
                @if($errors->get('phone'))
                    <div class="text-danger mt-1 small">{{ $errors->get('phone')[0] }}</div>
                @endif
            </div>
            <div class="col-md-6 mb-4">
                <label for="city">{{ __('Village / City') }}</label>
                <input id="city" name="city" type="text" class="form-control" value="{{ old('city', $user->city) }}" />
            </div>
        </div>

        <div class="mb-4">
            <label for="address">{{ __('Delivery Fortress (Address)') }}</label>
            <textarea id="address" name="address" class="form-control" rows="2">{{ old('address', $user->address) }}</textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-4">
                <label for="zip_code">{{ __('Scroll Zip Code') }}</label>
                <input id="zip_code" name="zip_code" type="text" class="form-control" value="{{ old('zip_code', $user->zip_code) }}" />
            </div>
            <div class="col-md-6 mb-4">
                <label for="country">{{ __('Territory / Country') }}</label>
                <input id="country" name="country" type="text" class="form-control" value="{{ old('country', $user->country) }}" />
            </div>
        </div>

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3">
                    <p class="small text-white-50">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification" class="btn btn-link p-0 text-danger text-decoration-none small">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>
                </div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn-hikari">{{ __('Save Changes') }}</button>

            @if (session('status') === 'profile-updated')
                <p class="m-0 small text-success">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
