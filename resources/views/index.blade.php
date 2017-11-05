@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/xterm.css') }}"/>
@endsection

@section('content')
<div class="main-content">
  <nav class="navbar sub">
    <div class="container-fluid">
      @auth
      <div class="navbar-header">
        <button type="button" class="btn btn-default navbar-btn">打开</button>
        <button id="save" type="button" class="btn btn-default navbar-btn">保存</button>
      </div>
      @endauth
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
        {{--<textarea id="source-code" class="form-control" rows="30" style="display: none;"></textarea>--}}
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

<div id="save-modal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">保存代码</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
          <div class="form-group">
            <label for="fileName" class="col-sm-2 control-label">文件名称</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="filename" placeholder="请输入文件名称" required>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="submit" class="btn btn-primary" onclick="submitCode(event)">保存</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

@section('footer_script')
  <script src="{{ asset('js/xterm.js') }}"></script>
  <script src="{{ asset('js/addons/attach/attach.js') }}"></script>
  <script src="{{ asset('js/addons/fit/fit.js') }}"></script>
  <script src="{{ asset('js/index.js') }}"></script>
  <script>
  </script>
@endsection
</body>
</html>