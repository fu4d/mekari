<!DOCTYPE html>
<html>
	<head>
		@include('components.head')
	</head>
	<body ng-app="main-App">
		<div class="container">
			<header id="header" class="row header">
				@include('components.header')
			</header>
			<div>
				@yield('content')
				<div>@yield('customjs')</div>
			</div>
			<footer class="row">
				@include('components.footer')
			</footer>
		</div>
	</body>
</html>
