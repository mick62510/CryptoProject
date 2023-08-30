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
                <label for="current_password">Mot de passe actuel</label>
                <input type="password" class="form-control" id="current_password" name="current_password"
                       placeholder="Mot de passe actuel"
                       data-validation-required-message="Le mot de passe est obligatoire" aria-invalid="false">
            </div>
        </div>
        <div class="form-group">
            <div class="controls">
                @if($errors->updatePassword->has('password'))
                    <div class="mt-2 alert alert-danger">{{$errors->updatePassword->get('password')[0]}}</div>
                @endif
                <label for="password">Nouveau mot de passe</label>
                <input type="password" class="form-control" id="password" name="password"
                       placeholder="Nouveau mot de passe"
                       data-validation-required-message="Le nouveau mot de passe est obligatoire" aria-invalid="false">
            </div>
        </div>

        <div class="form-group">
            <div class="controls">
                @if($errors->updatePassword->has('password_confirmation'))
                    <div class="mt-2 alert alert-danger">{{$errors->updatePassword->get('password_confirmation')}}</div>
                @endif
                <label for="password_confirmation">Confirmer le nouveau mot de passe</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                       placeholder="Confirmer le nouveau mot de passe"
                       data-validation-required-message="La confirmation du nouveau mot de passe est obligatoire"
                       aria-invalid="false">
            </div>
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="btn btn-primary mt-2">Sauvegarder</button>
        </div>
    </form>

