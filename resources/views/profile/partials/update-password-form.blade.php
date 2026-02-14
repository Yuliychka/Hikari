    <p class="mb-4" style="color: rgba(255,255,255,0.5); font-size: 0.85rem;">
        {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </p>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="mb-4">
            <label for="current_password">{{ __('Current Password') }}</label>
            <input id="current_password" name="current_password" type="password" class="form-control" autocomplete="current-password" />
            @if($errors->updatePassword->get('current_password'))
                <div class="text-danger mt-1 small">{{ $errors->updatePassword->get('current_password')[0] }}</div>
            @endif
        </div>

        <div class="mb-4">
            <label for="password">{{ __('New Password') }}</label>
            <input id="password" name="password" type="password" class="form-control" autocomplete="new-password" />
            @if($errors->updatePassword->get('password'))
                <div class="text-danger mt-1 small">{{ $errors->updatePassword->get('password')[0] }}</div>
            @endif
        </div>

        <div class="mb-4">
            <label for="password_confirmation">{{ __('Confirm Password') }}</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password" />
            @if($errors->updatePassword->get('password_confirmation'))
                <div class="text-danger mt-1 small">{{ $errors->updatePassword->get('password_confirmation')[0] }}</div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn-hikari">{{ __('Update Shield') }}</button>

            @if (session('status') === 'password-updated')
                <p class="m-0 small text-success">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
