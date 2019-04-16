@extends('layouts.master')

@section('app-content')

    <nav id="sidebar" class="bg-light sidebar">
        <div class="sidebar-sticky">
            <ul class="nav flex-column">
                @include('dashboard.panel')
            </ul>
        </div>
    </nav>

    <main class="ml-sm-auto pt-3 px-4 main">
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
      <div class="row">
        <ol class="breadcrumb">
          <li><a href="#">
            <em class="fa fa-home"></em>
          </a></li>
          <li class="active">@yield('pageTitle')</li>
        </ol>
      </div><!--/.row-->

      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">@yield('pageTitle')</h1>
        </div>
      </div><!--/.row-->
        @yield('content')
      </div>	<!--/.main-->
    </main>

@stop
