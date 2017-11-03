@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/xterm.css') }}"/>
@endsection

@section('content')
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
      <div class="col-sm-7">
        <label for="source-code">源代码</label>
        <textarea id="source-code" class="form-control" rows="30"></textarea>
      </div>
      <div class="col-sm-5">
        {{--<div class="form-group">--}}
          {{--<label for="input">输入</label>--}}
          {{--<textarea id="input" class="form-control" rows="5"></textarea>--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
          {{--<label for="complier-result">编译结果</label>--}}
          {{--<textarea id="complier-result" class="form-control" rows="7"></textarea>--}}
        {{--</div>--}}
        <div class="form-group">
          <label for="output">程序输出</label>
          <div id="terminal"></div>
          {{--<textarea id="output" class="form-control" rows="13"></textarea>--}}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('footer_script')
  <script src="{{ asset('js/xterm.js') }}"></script>
  <script src="{{ asset('js/addons/attach/attach.js') }}"></script>
  <script src="{{ asset('js/index.js') }}"></script>
  <script>
      var term = new Terminal();
      term.open(document.getElementById('terminal'));

      var protocol = (location.protocol === 'https:') ? 'wss://' : 'ws://';
      var socketURL = protocol + location.hostname + ((location.port) ? (':' + '3000') : '') + '/terminals/';
      socketURL += {{ session()->get('pid') }};
      var socket = new WebSocket(socketURL);
      socket.onopen = runRealTerminal;
  //    $.ajax({
  //        url: "http://127.0.0.1:3000/terminals",
  //        method: 'post',
  //        data: {},
  //        success: function(result) {
  //            var pid = result;
  //
  //        },
  //        error: function (result) {
  //            console.log('error', result)
  //        }
  //    });

  //    socket.onclose = runFakeTerminal;
  //    socket.onerror = runFakeTerminal;

      function runRealTerminal() {
          term.attach(socket);
          term._initialized = true;
      }
  </script>
@endsection
</body>
</html>