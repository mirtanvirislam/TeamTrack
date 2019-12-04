<!DOCTYPE html>
<html class="no-js h-100" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <title>TeamTrack</title>
    @include('layouts.cssimports')
  </head>
  <body class="h-100">

    <!-- Settings icon
    <div class="color-switcher-toggle animated pulse infinite">
      <i class="material-icons">settings</i>
    </div> -->

    <div class="container-fluid">
      <div class="row">

        <!-- Sidebar -->
        @include('inc.sidebar')
      
        <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
          <div class="main-navbar sticky-top bg-white">
            <!-- Main Navbar -->
            @include('inc.navbar')
          </div>

          <div class="main-content-container container-fluid px-4">

              <!-- Content -->
                <main class="py-4">
                  <div class="content">
                    @yield('content')
                  </div>
                    
                </main>
           
          </div>

          <!-- Footer -->
          <footer class="main-footer d-flex p-2 px-3 bg-white border-top">
            <span class="copyright ml-auto my-auto mr-2">Copyright © 2019
              <a href="teamtrack.me" rel="nofollow">TeamTrack</a>
            </span>
          </footer>

        </main>
      </div>
    </div>

  </body>

  @include('modals.new_team_modal')

  @include('js.jsimports')

  {{-- @include('layouts.jsimports') --}}
{{--   
  <script src="{{ asset('../../js/ajax/ajaxfunctions.js') }}"></script> --}}

</html>