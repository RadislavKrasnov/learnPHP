<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    @yield('link')
</head>
<body>
    <div class="container">
        <div class="row">
            <div class=".col-md-3 col-sm-3 col-lg-3"></div>
            <div class=".col-md-6 col-sm-6 col-lg-6">
                @yield('content')
            </div>
            <div class=".col-md-3 col-sm-3 col-lg-3"></div>
        </div>
    </div>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>