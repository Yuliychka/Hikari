    <p class="mb-4" style="color: rgba(255,255,255,0.5); font-size: 0.85rem;">
        {{ __("Update your account's profile information and email address.") }}
    </p>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="mb-4">
            <label for="name">{{ __('Name') }}</label>
            <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            @if($errors->get('name'))
                <div class="text-danger mt-1 small">{{ $errors->get('name')[0] }}</div>
            @endif
        </div>

        <div class="mb-4">
            <label for="email">{{ __('Email') }}</label>
            <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="username" />
            @if($errors->get('email'))
                <div class="text-danger mt-1 small">{{ $errors->get('email')[0] }}</div>
            @endif

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
