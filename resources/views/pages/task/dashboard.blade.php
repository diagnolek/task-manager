@extends('layouts.card')
@section('title', 'Manager Task')

@section('body')
    <task-component token="{{$token}}"></task-component>
@endsection
