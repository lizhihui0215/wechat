@extends('layouts.master')
@section('content')
<div class="middle-box text-center loginscreen   animated fadeInDown">
    <div>
        <div>
            <h1 class="logo-name">WeChat</h1>
        </div>
        <h3>加入WeChat</h3>
        <p>创建账户一起开始WeChat之旅.</p>
        <form id="form" class="m-t" role="form" action="{{ url( 'auth/register' ) }}" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="用户名" required value="{{ old('username')}}">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="电子邮件" required value="{{ old('email') }}">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="密码" required />
            </div>
            <div class="form-group">
                <div class="checkbox i-checks"><label> <input type="checkbox"><span> 同意我们的条款。</span></label></div>
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">注册</button>

            <p class="text-muted text-center"><small>已经有WeChat账户?</small></p>
            <a class="btn btn-sm btn-white btn-block" href="{{ url('auth/login') }}">登录</a>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
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

            $("#form").validate({
                rules: {
                    password: {
                        required: true,
                        minlength: 3
                    },
                    url: {
                        required: true,
                        url: true
                    },
                    number: {
                        required: true,
                        number: true
                    },
                    min: {
                        required: true,
                        minlength: 6
                    },
                    max: {
                        required: true,
                        maxlength: 4
                    }
                }
            });
        });
    </script>
@endsection
