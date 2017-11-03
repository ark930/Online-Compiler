<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>ByteWave在线编译</title>
  <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">
  @yield('css')
</head>
<body>
<div id="app">
  <nav class="navbar main">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="/">ByteWave在线编译</a>
      </div>
      <ul class="nav navbar-nav navbar-right">
        @guest
          <li><a href="{{ route('login') }}">登录</a></li>
          <li><a href="{{ route('register') }}">注册</a></li>
        @else
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
               aria-expanded="false">
              {{ Auth::user()->name }}<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#">个人中心</a></li>
              {{--<li><a href="#">回到首页</a></li>--}}
              <li role="separator" class="divider"></li>
              <li>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                  退出
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
                </form>
              </li>
            </ul>
          </li>
        @endguest
      </ul>
    </div>
  </nav>
  @yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
@yield('footer_script')
</body>
</html>
