@extends('layout')

@section('content')
    <div>
        <a href="{{ url('/') }}" class="bg-orange-400 hover:bg-blue-900 text-white font-bold ml-2 p-0 rounded text-center">HomePage</a>
        <span class="m-8">
            @foreach($data as $data)
                <ul class="m-1 pt-1 border text-center">
                <p class="text-white p-1 m-1 bg-gray">{{$data->name}} {{' with a total XP of '.$data->sum}}
                <a href="{{ url('/team/'.$data->id.'/edit') }}" class="bg-orange-400 hover:bg-blue-900 text-white font-bold absolute right-0 mr-4 rounded">Edit a Pokemon Team</a></p>
                    <div class="flex">
                        @foreach(\App\Models\Pokemon::where('team_id', $data->id)->get() as $pokemon)
                            @foreach(explode(',', $pokemon->types) as $type)
                               @if(!in_array(ucfirst($type), $arr))<p class="hidden">{{array_push($arr, ucfirst($type))}}</p>@endif
                            @endforeach
                               @if(isset($filter) AND strpos($pokemon->types, $filter))<img src="{{$pokemon->img}}">
                            @foreach(explode(',', $pokemon->types) as $type)<p class="text-white flex place-self-center">{{ucfirst($type)}} &nbsp;</p>@endforeach @endif
                               @if(!isset($filter))<img src="{{$pokemon->img}}">
                            @foreach(explode(',', $pokemon->types) as $type)<p class="text-white flex place-self-center">{{ucfirst($type)}} &nbsp;</p>@endforeach @endif
                        @endforeach
                    </div>
                </ul>
            @endforeach
        </span>
        <span class="ml-1 text-center">
            <form action="list" method="POST" >
                {{ csrf_field() }}
                <label class="text-white" for="filter">Choose a Pokemon Type: &nbsp&nbsp</label>
                <select id="filter" name="filter">
                    @foreach($arr as $res)
                        <option value="{{lcfirst($res)}}">{{$res}}</option>
                    @endforeach
                </select>&nbsp&nbsp&nbsp
                <button type="submit" class="bg-orange-400 hover:bg-blue-900 text-white font-bold py-1 px-1 rounded">&nbspChoose&nbsp</button>
            </form>
        </span>
    </div>


@endsection
