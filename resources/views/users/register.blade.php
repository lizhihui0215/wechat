@extends('layouts.master')
@section('content')
<div class="middle-box text-center loginscreen   animated fadeInDown">
    <div>
        <div>

            <h1 class="logo-name">WeChat</h1>

        </div>
        <h3>加入WeChat</h3>
        <p>创建账户一起开始WeChat之旅.</p>
        <form class="m-t" role="form" action="#">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="用户名" required="">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" placeholder="电子邮件" required="">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="密码" required="">
            </div>
            <div class="form-group">
                <div class="checkbox i-checks"><label> <input type="checkbox"><i></i> 同意我们的条款。 </label></div>
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">注册</button>

            <p class="text-muted text-center"><small>已经有WeChat账户?</small></p>
            <a class="btn btn-sm btn-white btn-block" href="#">登录</a>
        </form>
        <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
    </div>
</div>
@endsection
@section('javascript')

<script>
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>
@endsection
