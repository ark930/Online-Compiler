<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>ByteWave</title>
  <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
<nav class="navbar main">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">ByteWave在线编译</a>
    </div>

    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">user1<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">个人中心</a></li>
          <li><a href="#">回到首页</a></li>
          <li role="separator" class="divider"></li>
          <li><a href="#">注销登录</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>

<div class="main-content">
  <nav class="navbar sub">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="btn btn-default navbar-btn">打开</button>
        <button type="button" class="btn btn-default navbar-btn">保存</button>
      </div>
      <div class="navbar-left">
        <div class="navbar-form">
          <div class="form-group">
            <label for="font-family">字体</label>
            <select id="font-family" class="form-control">
              <option value ="Helvetica">Helvetica</option>
              <option value ="Tahoma">Tahoma</option>
              <option value="Serif">Serif</option>
              <option value="微软雅黑">微软雅黑</option>
              <option value="Droid Sans">Droid Sans</option>
            </select>
          </div>
          <div class="form-group">
            <label for="font-size">字号</label>
            <select id="font-size" class="form-control">
              <option value="16px">16</option>
              <option value="18px">18</option>
              <option value="20px">20</option>
              <option value="22px">22</option>
              <option value="24px">24</option>
              <option value="26px">26</option>
              <option value="28px">28</option>
              <option value="30px">30</option>
            </select>
          </div>
          <div class="form-group">
            <label for="color">文字颜色</label>
            <select id="color" class="form-control">
              <option value="black">黑色</option>
              <option value="white">白色</option>
              <option value="DarkSlateGray">深蓝</option>
            </select>
          </div>
          <div class="form-group">
            <label for="background">背景</label>
            <select id="background" class="form-control">
              <option value="black">黑色</option>
              <option value="white">白色</option>
              <option value="grey">灰色</option>
              <option value="DarkSlateGray">深蓝</option>
            </select>
          </div>
          <div class="form-group">
            <label for="language">编译语言选择</label>
            <select id="language" class="form-control">
              <option>C语言</option>
              <option>C++</option>
              {{--<option>Java</option>--}}
              <option>Python2.7</option>
              <option>Python3</option>
              <option>PHP</option>
            </select>
          </div>
        </div>
      </div>
      <button type="button" id="run" class="btn btn-default navbar-btn">运行</button>
    </div>
  </nav>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-8">
        <label for="source-code">源代码</label>
        <textarea id="source-code" class="form-control" rows="30"></textarea>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <label for="input">输入</label>
          <textarea id="input" class="form-control" rows="5"></textarea>
        </div>
        <div class="form-group">
          <label for="complier-result">编译结果</label>
          <textarea id="complier-result" class="form-control" rows="7"></textarea>
        </div>
        <div class="form-group">
          <label for="output">程序输出</label>
          <textarea id="output" class="form-control" rows="13"></textarea>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="{{ asset('js/index.js') }}"></script>
</body>
</html>