@extends('layouts.master')
@section('content')
  @include('partials.nav')
  <div id="page-wrapper" class="gray-bg">
    @include('partials.top-nav-bar')
    @yield('admin-content')
  </div>
@endsection
