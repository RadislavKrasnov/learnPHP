<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Calculator</title>

    <!-- Bootstrap -->
    <link href="bootstrap.css" rel="stylesheet">
    <link href="calculator.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<?php include "calculator.php";?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <div class="container-fluid calculator">
                    <div class="row">
                            <h1>Calculator</h1>
                            <form action="clientSideCalculator.php" method="post" class="cleatfix">
                                <input type="text" name="num-1" placeholder="num" required class="form-control">
                                <select required name="mathSymbol" class="btn btn-success align">
                                    <option value="+">+</option>
                                    <option value="-">-</option>
                                    <option value="*">*</option>
                                    <option value="/">/</option>
                                    <option value="**">x^n</option>
                                    <option value="%">%</option>
                                </select>
                                <input type="text" name="num-2" placeholder="num" required class="form-control">
                                <input type="submit" name="submit" value="=" class="btn btn-success">
                                <input type="text" name="result" placeholder="result" value="<?=$result;?>" class="form-control">
                                <input type="reset" name="reset" value="clear" class="btn btn-success">
                            </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-3 col-sm-3 col-xs-3"></div>
        </div>
    </div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="bootstrap.js"></script>
</body>
</html>
<?php
//col-lg-6 col-md-8 col-sm-8 col-xs-10