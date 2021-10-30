<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>OpenClass</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!--<script src="node_modules/chartjs/dist/Chart.js"></script>-->
    
</head>
<body>
	<!--<form method='POST' action="{{route('store2')}}"enctype="multipart/form-data">-->
	<!--	@csrf-->
	<!--	<input type="text" name="name" placeholder="名前">-->
	<!--	<input type="text" name="email" placeholder="Email">-->
	<!--	<input type="submit" value="保存">-->
	<!--</form>	-->
	<form method='POST' action="{{route('send')}}"enctype="multipart/form-data">
		@csrf
		<input type="file" name="image"  accept="image">
		<input type="submit" value="送信">
	</form>
		@foreach($teachers as $teacher)
			<p>名前：{{ $teacher->name}}
			<p>画像：{{$teacher->image}}
		@endforeach
</body>
</html>
