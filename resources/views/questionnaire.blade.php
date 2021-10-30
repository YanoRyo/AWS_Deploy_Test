@extends('layouts.app')

@section('content')
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
	
	  <form method='POST' action="{{ route('store1') }}" enctype="multipart/form-data" id="addClass_form">
        @csrf
	      <span>Question1</span>
	      <input type="radio" name="que_1" value=1>1
	      <input type="radio" name="que_1" value=2>2
	      <input type="radio" name="que_1" value=3>3
	      <input type="radio" name="que_1" value=4>4
	      <input type="radio" name="que_1" value="5">5
	
	      <span>Question2</span>
	      <input type="radio" name="que_2" value=1>1
	      <input type="radio" name="que_2" value=2>2
	      <input type="radio" name="que_2" value=3>3
	      <input type="radio" name="que_2" value=4>4
	      <input type="radio" name="que_2" value="5">5
	
	      <span>Question3</span>
	      <input type="radio" name="que_3" value=1>1
	      <input type="radio" name="que_3" value=2>2
	      <input type="radio" name="que_3" value=3>3
	      <input type="radio" name="que_3" value=4>4
	      <input type="radio" name="que_3" value=5>5
	
	      <span>Question4</span>
	      <input type="radio" name="que_4" value=1>1
	      <input type="radio" name="que_4" value=2>2
	      <input type="radio" name="que_4" value=3>3
	      <input type="radio" name="que_4" value=4>4
	      <input type="radio" name="que_4" value=5>5
	
	      <span>Question5</span>
	      <input type="radio" name="que_5" value=1>1
	      <input type="radio" name="que_5" value=2>2
	      <input type="radio" name="que_5" value=3>3
	      <input type="radio" name="que_5" value=4>4
	      <input type="radio" name="que_5" value=5>5
	
	      <span>Comment2</span>
	      <textarea name="comment" id="" cols="300" rows="10"></textarea>
	      
	      <input type="submit" name="submit" value="Submit">
	  </form>



</body>
</html>

@endsection