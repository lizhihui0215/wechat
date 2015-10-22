@extends('layouts.master')
@section('content')
<div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">WeChat</h1>

            </div>
            <h3>欢迎来到WeChat</h3>
            <p>WeChat提供了对微信公众号的管理，等功能.
                <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
            </p>
            <p>登录开始WeChat之旅你的.</p>
            <form class="m-t" role="form" action="{{ url('auth/login') }}" method="post">
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="用户名/邮箱" required="">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="密码" required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">登录</button>

                <a href="#"><small>忘记密码了?</small></a>
                <p class="text-muted text-center"><small>加入我们一起开启WeChat之旅?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="{{ url('auth/register') }}">创建一个账号</a>
                {{ csrf_field() }}
            </form>
            <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
        </div>
    </div>
@endsection
