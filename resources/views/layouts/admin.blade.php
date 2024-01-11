<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
 
  <title>@yield('title','Ruwww')</title>
 
  <!-- AdminKit CSS file -->
  <link href="{{ mix('css/admin.css') }}" rel="stylesheet">
  @stack('css-top')
  @stack('script-top')

</head>
<body>
  <div class="wrapper">
  	@include('partials.admin.sidebar')
	@include('partials.admin.navbar')
	<main class="content">
		@yield('main-content')
	</main>
	@include('partials.admin.footer')
  </div>
  @stack('css-bot')
  <!-- AdminKit JS file -->
  <script src="{{ mix('js/admin.js') }}"></script>
  @stack('script-bot')
</body>
</html>
