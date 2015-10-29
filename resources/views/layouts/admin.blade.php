@extends('layouts.master')
@section('content')
<?php
    $user = Auth::user();
    $profile = $user->profile;
?>
  @include('partials.nav')
  <div id="page-wrapper" class="gray-bg">
    @include('partials.top-nav-bar')
    @yield('admin-content')
  </div>
@endsection
