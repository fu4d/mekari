@extends('layouts.base',['title'=>'Laravel Angular'])

@section('content')
<ng-view></ng-view>
@stop
@section('additionaljs')
<!-- Angular JS -->
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.2/angular.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.2/angular-route.min.js"></script>

<!-- MY App -->
<script src="{{ asset('/app/packages/dirPagination.js') }}"></script>
<script src="{{ asset('/app/route.js') }}"></script>
<script src="{{ asset('/app/services/customServices.js') }}"></script>
<script src="{{ asset('/app/helper/myHelper.js') }}"></script>
<!-- App Controller -->
<script src="{{ asset('/app/controllers/ItemController.js') }}"></script>
@stop
