     @if (session('status') === 'password-updated')
        <p class="alert alert-success">{{ __('Saved.') }}</p>
    @endif
    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="form-group">
            <div class="controls">
                @if($errors->updatePassword->has('current_password'))
                    <div class="mt-2 alert alert-danger">{{$errors->updatePassword->get('current_password')[0]}}</div>
                @endif
                <label for="current_password">{{__('Current Password')}}</label>
                <input type="password" class="form-control" id="current_password" name="current_password"
                       placeholder="Current Password"
                       data-validation-required-message="This old password field is required" aria-invalid="false">
            </div>
        </div>
        <div class="form-group">
            <div class="controls">
                @if($errors->updatePassword->has('password'))
                    <div class="mt-2 alert alert-danger">{{$errors->updatePassword->get('password')[0]}}</div>
                @endif
                <label for="password">{{__('New Password')}}</label>
                <input type="password" class="form-control" id="password" name="password"
                       placeholder="New Password"
                       data-validation-required-message="The new password is required" aria-invalid="false">
            </div>
        </div>

        <div class="form-group">
            <div class="controls">
                @if($errors->updatePassword->has('password_confirmation'))
                    <div class="mt-2 alert alert-danger">{{$errors->updatePassword->get('password_confirmation')}}</div>
                @endif
                <label for="password_confirmation">{{__('Confirm Password')}}</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                       placeholder="Confirm new Password"
                       data-validation-required-message="The confirmation new password is required"
                       aria-invalid="false">
            </div>
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="btn btn-primary mt-2">{{ __('Save') }}</button>
        </div>
    </form>

