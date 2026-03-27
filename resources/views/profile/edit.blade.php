@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Mijn profiel</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="username" class="form-label">Gebruikersnaam</label>
                        <input type="text" class="form-control" id="username" value="{{ $user->username }}" disabled>
                        <small class="text-muted">Gebruikersnaam kan niet worden gewijzigd</small>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Volledige naam</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                               id="name" name="name" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">E-mailadres</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                               id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr>
                    <h5>Wachtwoord wijzigen (optioneel)</h5>

                    <div class="mb-3">
                        <label for="current_password" class="form-label">Huidig wachtwoord</label>
                        <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                               id="current_password" name="current_password">
                        @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="new_password" class="form-label">Nieuw wachtwoord</label>
                        <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                               id="new_password" name="new_password">
                        @error('new_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="new_password_confirmation" class="form-label">Bevestig nieuw wachtwoord</label>
                        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
                    </div>

                    <div class="alert alert-info">
                        <strong>Rol:</strong> {{ $user->role == 'maker' ? 'Maker' : ($user->role == 'koper' ? 'Koper' : 'Moderator') }}
                    </div>

                    <button type="submit" class="btn btn-primary">Profiel bijwerken</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
