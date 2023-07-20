@extends('layouts.card')
@section('title', 'Client')

@section('body')
  <h5 class="card-title">List task<a href="{{route('task.create')}}"><i class="far fa-plus-square ms-2"></i></a>
  </h5>
  <p class="card-text">
  @if($items->count() > 0)
    <table class="table">
      <thead>
      <tr>
        <td style="width: 30px"></td>
      </tr>
      </thead>
      <tbody>
      @foreach($items as $task)
        <tr>
          <td>
            {{ $loop->iteration }}
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
    @endif
    </p>
    <example-component counter="{{$items->count()}}" token="{{$token}}"></example-component>
@endsection
