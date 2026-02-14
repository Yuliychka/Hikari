    <p class="mb-4" style="color: rgba(255,255,255,0.4); font-size: 0.8rem;">
        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. This action is irreversible.') }}
    </p>

    <button type="button" class="btn btn-outline-danger rounded-0 fw-bold px-4" data-bs-toggle="modal" data-bs-target="#confirmDeletionModal">
        {{ __('Deactivate Account') }}
    </button>

    <!-- Bootstrap Modal -->
    <div class="modal fade" id="confirmDeletionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background: rgba(10, 10, 10, 0.95); border: 1px solid crimson; border-radius: 0; backdrop-filter: blur(20px);">
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')
                    
                    <div class="modal-header border-0 p-4 pb-0">
                        <h5 class="modal-title fw-bold text-white uppercase tracking-wider" style="font-size: 0.9rem;">
                            {{ __('Final Confirmation') }}
                            <div class="small text-danger opacity-50">{{ __('最終確認') }}</div>
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body p-4">
                        <p class="text-white-50 small mb-4">
                            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm.') }}
                        </p>

                        <div class="mb-3">
                            <label for="password" class="sr-only">{{ __('Password') }}</label>
                            <input id="password" name="password" type="password" class="form-control" placeholder="{{ __('Verify Password') }}" required />
                            @if($errors->userDeletion->get('password'))
                                <div class="text-danger mt-1 small">{{ $errors->userDeletion->get('password')[0] }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="modal-footer border-0 p-4 pt-0 gap-3">
                        <button type="button" class="btn btn-link text-white-50 text-decoration-none small" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-danger rounded-0 px-4 fw-bold small uppercase">{{ __('Delete Permanently') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
