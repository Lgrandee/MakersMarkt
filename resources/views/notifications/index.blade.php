@extends('layouts.app')

@section('content')
<h1>Notificaties</h1>

@if($notifications->count() > 0)
    <div class="list-group">
        @foreach($notifications as $notification)
            <div class="list-group-item @if(!$notification->is_read) list-group-item-warning @endif">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{ $notification->message }}</h5>
                    <small>{{ $notification->created_at->diffForHumans() }}</small>
                </div>
                @if(!$notification->is_read)
                    <div class="mt-2">
                        <form action="{{ route('notifications.read', $notification->notification_id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-sm btn-primary">Markeer als gelezen</button>
                        </form>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
    <div class="mt-4">
        {{ $notifications->links() }}
    </div>
@else
    <div class="alert alert-info text-center">
        Je hebt geen notificaties.
    </div>
@endif
@endsection
