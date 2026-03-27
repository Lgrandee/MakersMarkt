@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Registreren</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="username" class="form-label">Gebruikersnaam *</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                   id="username" name="username" value="{{ old('username') }}" required>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Volledige naam *</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mailadres *</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                               id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Wachtwoord *</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   id="password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="password_confirmation" class="form-label">Bevestig wachtwoord *</label>
                            <input type="password" class="form-control"
                                   id="password_confirmation" name="password_confirmation" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ik wil me registreren als *</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="role" id="maker" value="maker" {{ old('role') == 'maker' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="maker">
                                🎨 Maker - Ik verkoop zelfgemaakte producten
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="role" id="koper" value="koper" {{ old('role') == 'koper' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="koper">
                                🛒 Koper - Ik wil producten kopen
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Registreren</button>
                </form>
                <hr>
                <p class="text-center mb-0">Heb je al een account? <a href="{{ route('login') }}">Log hier in</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
