@extends('layouts.app')

@section('content')
    <div class="container">

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{action('ProfileController@update', ['id' => $user->id])}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="row">

                <div class="form-group">
                    <label for="bio">Bio:</label>
                    <textarea class="form-control" name="bio" rows="5" id="bio">{{$user->profile->bio}}</textarea>
                </div>

                <div class="form-group">
                    <label for="city">City:</label>
                    <input type="text" class="form-control" name="city" id="city" value="{{$user->profile->location->city}}" />
                </div>

                <div class="form-group">
                @foreach($games as $game)
                        <div class="checkbox">
                            <label>
                                <input {{ $user->games->contains($game)?'checked':null }} type="checkbox" name="games[]" id="{{$game->id}}" value="{{$game->id}}">{{$game->name}}
                            </label>
                        </div>
                    @endforeach
                </div>

                <div class="form-group">
                    <label for="gender">Gender:</label>
                    @foreach(Config('enums.gender') as $key=>$gender)
                        <label class="radio-inline"><input {{($key===$user->profile->gender)?'checked':null}} type="radio" value='{{$key}}' name="gender">{{$gender}}</label>
                    @endforeach
                </div>

                <div class="col-md-12">
                    <input type="file" name="avatar" />
                </div>

                <div class="col-md-12">
                    <button type="submit" class="btn btn-success">Upload</button>
                </div>

            </div>
        </form>
    </div>

@stop
