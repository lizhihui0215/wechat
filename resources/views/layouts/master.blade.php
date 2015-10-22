<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>WeChat</title>
  <link rel="stylesheet" type="text/css" href="{{ url(elixir('css/site.css')) }}">
  <script type="text/javascript">
  var baseURL = "{{ url('/') }}"
  </script>
</head>
<body>
  @if(session()->has('ok'))
			@include('partials.error', ['type' => 'success', 'message' => session('ok')])
  @endif

  @if (count($errors) > 0)
    @include('partials.error', ['type' => 'danger','message' => $errors->all()])
  @endif

  @if(isset($info))
		@include('partials.error', ['type' => 'info', 'message' => $info])
	@endif

  @yield('content')
  <script type="text/javascript" src="{{ url( elixir('js/site.js') ) }}"></script>
  @yield('javascript')
</body>
</html>
