@extends('layout')

@section('content')
    <div name="container" class="flex justify-center">
        <span class="flex m-8 place-self-center">
        <a href="{{ url('/') }}" class="bg-orange-400 hover:bg-blue-900 text-white font-bold mr-8 p-1 rounded">&nbspHomePage&nbsp</a>
               <form class="" action="create" method="POST" >
                    {{ csrf_field() }}
                    <div class="input-group">
                        <input type="text"  name="name" placeholder="Create Team">
                        <span class="input-group-btn">&nbsp&nbsp&nbsp
                    <button type="submit" class="bg-orange-400 hover:bg-blue-900 text-white font-bold py-1 px-1 rounded">&nbspCreate a Team&nbsp</button>
                        </span>
                        <span class="text-red-400">
                         @if($errors->any())
                                {{ implode('', $errors->all(':message')) }}
                         @endif
                         @if(isset($err))
                                 <p class="text-white">{{$err}}</p>
                         @endif
                         </span>
                    </div>
               </form>
        </span>
        <span class="m-8 place-self-center text-white">
        @if (isset($team_id))
                <form action="create" method="POST" >
                    {{ csrf_field() }}
                    <input type="hidden"  name="team_id" value="{{$team_id}}">&nbsp&nbsp
                    <button type="submit" class="bg-orange-400 hover:bg-blue-900 text-white font-bold py-1 px-1 rounded">&nbspCatch The Existed Pokemon from their API&nbsp</button>
                </form>
            </span>
            @endif


            @if (isset($data))
            <span class="m-8 place-self-center text-white border-4 border-orange-500">
                <div class="p-8 text-white">
                    <h1 class="text-xl">Pokemon Captured From their API</h1>
                </div>
            <div class="flex p-8 text-white">
                <span>
                    <div class="flex"><p>{{ucfirst($data->name)}} - </p>  <p> - XP : </p> {{$data->xp}}</div>
                    <h2 class="text-lg underline text-black font-bold">Pokemon Abilities:</h2>@foreach(explode(',', $data->abilities) as $ability) <ul>{{ucfirst($ability)}}</ul> @endforeach
                    <ul class="text-lg underline text-black font-bold">Pokemon Type:</ul>@foreach(explode(',', $data->types) as $type) <ul>{{ucfirst($type)}}</ul> @endforeach

                 </span>
                <span>
                    <img class="ml-2" src="{{ $data->img }}">
                </span>
            </div>
                </span>
            @endif

    </div>

@endsection
