@extends('layout')

@section('content')
<div>
    <a href="{{ url('/') }}" class="bg-orange-400 hover:bg-blue-900 text-white font-bold ml-2 p-0 rounded ">HomePage</a>

    <span class="">

        <form class="mt-8 ml-2" action="edit" method="POST" >
            {{ csrf_field() }}
            <div class="input-group">
                <input type="text"  name="name" placeholder="{{\App\Models\Team::where('id', $team_id)->first()->name}}">
                <input type="hidden"  name="team_id" value="{{$team_id}}">
                <span class="input-group-btn">&nbsp&nbsp&nbsp
                        <button type="submit" class="bg-orange-400 hover:bg-blue-900 text-white font-bold py-1 px-1 rounded">Change a Team Name</button>
                </span>
                <span class="text-red-400">
                    @if($errors->any())
                        {{ implode('', $errors->all(':message')) }}
                    @endif
                    @if(isset($msg))
                        <p class="text-white">{{$msg}}</p>
                    @endif
                </span>
            </div>
        </form>
        <form class="ml-2 mt-8" action="/team/create" method="POST" >
                    {{ csrf_field() }}
                    <input type="hidden"  name="team_id" value="{{$team_id}}">
                    <button type="submit" class="bg-orange-400 hover:bg-blue-900 text-white font-bold rounded">&nbspCatch The Existed Pokemon from their API&nbsp</button>
        </form>
        @if(\App\Models\Pokemon::where('team_id', $team_id)->first() == NULL)
            <form class="mt-16" action="edit" method="POST" >
            {{ csrf_field() }}
            <div class="input-group">
                <input type="hidden"  name="del_team_id" value="{{$team_id}}">
                <span class="input-group-btn">
                <button type="submit" class="bg-orange-400 hover:bg-blue-900 text-white font-bold py-1 px-1 rounded">Delete a Pokemon Team</button>
                </span>
            </div>
        </form>
        @endif
    </span>
    <span>
        @foreach(\App\Models\Pokemon::where('team_id', $team_id)->get() as $pokemon)
        <div class="inline-grid grid-cols-1 mt-16">
           <p class="text-white">{{ucfirst($pokemon->name)}}</p>
           <img src="{{$pokemon->img}}">
            <form action="edit" method="POST">
                {{ csrf_field() }}
                <input type="hidden"  name="poke_id" value="{{$pokemon->id}}">
                <button type="submit" class="bg-orange-400 hover:bg-blue-900 text-white font-bold rounded">Release a Pokemon</button>
            </form>
            </div>
        @endforeach
    </span>
</div>
@endsection
