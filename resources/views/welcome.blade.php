@extends('layout')

@section('content')
    <div class="p-16">
    <span>
        <p class="p-2 text-center text-white text-white text-xl">Welcome To Pokemon tournament</p>
    </span>
        <br><br>
    <span>
        <p class="p-2 text-center text-white text-white text-xl">
        <a href="{{ url('/team/create') }}" class="border bg-orange-800 hover:bg-blue-900 text-white p-4 m-2 font-bold rounded">Create Pokemon Team</a>
        <a href="{{ url('/team/list') }}" class="border bg-orange-800 hover:bg-blue-900 text-white p-4 m-2 font-bold rounded">Pokemon Team Listing</a>
  </p>  </span>
    <span>
        @if(isset($msg))
            <p class="mt-8 ml-2 text-white">{{$msg}}</p>
        @endif
    </span>
    </div>
@endsection
