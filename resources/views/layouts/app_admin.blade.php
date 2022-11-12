<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet"> 
  <link href="{{asset('assets/css/style.css')}}" rel="stylesheet"> 
  <script src="{{asset('assets/bootstrap/js/jquery.min.js')}}"></script>
  <script src="{{asset('assets/bootstrap/js/popper.min.js')}}"></script>
  <script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
  
</head>
<body>
      @include('layouts.pages.navbar')
      @include('layouts.pages.sidebar')


  <main role="main" class="px-5 pt-3">
      @yield('content')
  </main>
</body>
</html>