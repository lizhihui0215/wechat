<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>{{$title}}</h2>

        <div>
            Thanks for creating an account with the verification demo app.
            Please follow the link below to verify your email address
            <?php $path = url('auth/confirm/') ."/" . $confirmation_code ?>
            <a href="{{$path}}">{{$confirmation_code}}</a>.<br/>
        </div>
    </body>
</html>
