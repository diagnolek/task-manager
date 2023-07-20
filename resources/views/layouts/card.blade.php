@extends('layouts.app')

@section('content')
  <div class="card <?=$cardColor ?? 'card-primary'?> <?=$cardType ?? 'card-outline'?>">
    @hasSection('header')
      <div class="card-header">
        @yield('header')
      </div>
    @endif
    <div class="card-body">
      @yield('body')
    </div>
    @hasSection('footer')
      <div class="card-footer">
        @yield('footer')
      </div>
    @endif
  </div>
@endsection
