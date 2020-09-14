<!-- Add anything that comes under HTML <HEAD> tag here -->

<meta charset="utf-8">
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- you can change app name in .env file. Also, you can change page title to something else -->
<title>{{config('app.name', 'Ittila')}}</title>

<!-- Latest compiled and minified CSS (Bootstrap link) -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- The css folder is in public folder. This is because we are using css files as asset 
    Don't need to provide relative or physical path this way. 
    For assets it goes directly to public folder. Assets could be CSS, images, JS or font files
    https://stackoverflow.com/questions/13433683/using-css-in-laravel-views
    
    This is sample css file I found over net to test. 
    I am not sure if it is working correctly, it showed the same result when I commented out bootstrap reference -->
<link rel="stylesheet" href="{{asset('css/app.css')}}" >
<link rel="stylesheet" href="{{asset('css/style.css')}}" >

<!-- fonts used -->
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">

