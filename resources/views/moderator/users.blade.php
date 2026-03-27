@extends('layouts.app')

@section('content')
<h1>Gebruikers beheren</h1>

<div class="table-responsive">
    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Gebruikersnaam</th>
                <th>Naam</th>
                <th>E-mail</th>
                <th>Rol</th>
                <th>Geregistreerd</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->user_id }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if($user->role == 'maker') 🎨 Maker
                    @elseif($user->role == 'koper') 🛒 Koper
                    @else ⚖️ Moderator
                    @endif
                </td>
                <td>{{ $user->created_at->format('d-m-Y') }}</td>
                <td>
                    @if($user->role != 'moderator')
                        <form action="{{ route('moderator.delete.user', $user) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Weet je zeker dat je deze gebruiker wilt verwijderen?')">Verwijderen</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{ $users->links() }}
@endsection
