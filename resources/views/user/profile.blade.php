@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($user->profile)
        <h1>{{ $user->username }}</h1>
        <div class="bio">
            <p>
                {{ $user->profile->bio }}
            </p>
            <p>
                {{ $user->profile->gender }}
            </p>
            <p>
                {{ $user->profile->location->city }}
            </p>
            <p>
                <img src="{{$user->profile->avatar_url }}">
            </p>
            <p>
                <ul>
                @foreach($user->games as $game)
                    <li>
                        {{$game->name}}
                    </li>
                @endforeach
                </ul>

            </p>

        </div>
            @can('update', $user->profile)
                <a class="btn btn-small btn-info" href="{{ URL('user/profile/' . $user->id . '/edit') }}">Edit this Profile</a>
            @endcan

    @else
        <p>No profile yet.</p>
    @endif

    </div>

@stop
