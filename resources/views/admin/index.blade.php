@extends('layouts.admin')
@section('content')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2"></span> 
        <div>
        @if (session('message'))
    <div class="alert alert-info">
        {{ session('message') }}
    </div>
@endif
        </div>
        <div class="title">
            <i class="uil uil-estate"></i>
            <span class="text">Welcome to Admin Panel: {{ Auth::user()->first_name }}</span>
        </div>
        <div class="title">
            <i class="uil uil-tachometer-fast-alt"></i>
            <span class="text">Dashboard</span>
        </div>
      </h3>
    </div>

    <!-- Stats Boxes -->
    <div class="boxes">
        <div class="box box1">
            <i class="uil uil-briefcase-alt"></i>
            <span class="text">Portfolio</span>
            <span class="number">{{ $portfolios }}</span>
        </div>
        <div class="box box2">
            <i class="uil uil-folder"></i>
            <span class="text">Category</span>
            <span class="number">{{ $categories }}</span>
        </div>
        <div class="box box3">
            <i class="uil uil-layer-group"></i>
            <span class="text">Project</span>
            <span class="number">{{ $projects }}</span>
        </div>
    </div>
    <br>
    <div class="boxes">
        <div class="box box4">
            <i class="uil uil-chart-growth"></i>
            <span class="text">Services</span>
            <span class="number">{{ $services }}</span>
        </div>
        <div class="box box5">
            <i class="uil uil-pen"></i>
            <span class="text">Skill</span>
            <span class="number">{{ $skills }}</span>
        </div>
        <div class="box box6">
            <i class="uil uil-envelope"></i>
            <span class="text">Contact</span>
            <span class="number">{{ $contacts }}</span>
        </div>
    </div>
    <br>
    <div class="boxes">
        <div class="box box7">
            <i class="uil uil-user"></i>
            <span class="text">User</span>
            <span class="number">{{ $users }}</span>
        </div>
        <div class="box box8">
            <i class="uil uil-briefcase-alt"></i>
            <span class="text">Experiences</span>
            <span class="number">{{ $experiences }}</span>
        </div>
        <div class="box box9">
            <i class="uil uil-graduation-cap"></i>
            <span class="text">Education</span>
            <span class="number">{{ $educations }}</span>
        </div>
    </div>

  </div>
</div>
@endsection