@extends('layouts.app')

@section('content')
<div class="container">
    <table class="table">
        <tr>
            <th>Name</th>
            <th>Location</th>
            <th>Gender</th>
            <th>Games</th>
        </tr>
        @foreach ($users as $user)
            <tr>
                <td><a href="{{action('ProfileController@show', ['id' => $user->id])}}">{{ $user->username }}</a></td>
                <td>
                @if($user->profile->location)
                    {{$user->profile->location->city}}
                @endif
                </td>
                <td>{{ $user->profile->gender }}</td>
                <td>
                    <ul>
                        @foreach($user->games as $game)
                            <li>{{ $game->name }}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
        @endforeach
    </table>
</div>
@endsection

