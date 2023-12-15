<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="imagetoolbar" content="no" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link rel="stylesheet" href="/colorbox.css" />
    <script src="/jquery.colorbox.js"></script>
		<script>
			$(document).ready(function(){
				//Examples of how to assign the Colorbox event to elements
				// $(".group1").colorbox({rel:'group1'});
				// $(".group2").colorbox({rel:'group2', transition:"fade"});
				// $(".group3").colorbox({rel:'group3', transition:"none", width:"75%", height:"75%"});
				// $(".group4").colorbox({rel:'group4', slideshow:true});
				// $(".ajax").colorbox();
				// $(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:390});
				// $(".vimeo").colorbox({iframe:true, innerWidth:500, innerHeight:409});
				$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
				// $(".inline").colorbox({inline:true, width:"50%"});
				// $(".callbacks").colorbox({
				// 	onOpen:function(){ alert('onOpen: colorbox is about to open'); },
				// 	onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
				// 	onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
				// 	onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
				// 	onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
				// });

				// $('.non-retina').colorbox({rel:'group5', transition:'none'})
				// $('.retina').colorbox({rel:'group5', transition:'none', retinaImage:true, retinaUrl:true});

				// //Example of preserving a JavaScript event for inline calls.
				// $("#click").click(function(){
				// 	$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
				// 	return false;
				// });
			});
		</script>
</head>
<body>
    <div id="app">

        @yield('content')
    </div>
    {{-- <script src="https://code.jquery.com/jquery-3.7.0.js"></script> --}}
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script>
        // new DataTable('#example');
    </script>
    @yield('script')
</body>
</html>
