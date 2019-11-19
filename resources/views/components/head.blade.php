<meta charset="utf-8">
<meta name="description" content="">
<title>{{ $title }}</title>
<link href="{{asset('css/style.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
<!-- Fonts -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.validate.js')}}"></script>
<script type="text/javascript" src="{{asset('js/popper.min.js')}}"></script>


@yield('additionaljs')
@yield('additionalcss')
