<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Calculator</title>
    <style>

        body {
            background: rgba(212, 219, 193, 0.8) repeat;
            margin: 0;
        }

        h1 {
            font-family: Geneva, Arial, Helvetica, sans-serif;
            color: dimgray;
            font-weight: bold;
            margin: -37px 0 0 0;
            padding-bottom: 5px;
            text-align: center;
        }

        .calculator {
            display: block;
            position: absolute;
            padding: 120px 50px 120px 50px;
            top: 50%;
            left: 50%;
            margin: -120px 0 0 -300px;
            border: 1px solid rgba(201, 197, 174, 1);;
            background: rgba(255, 255, 255, 1) repeat;
            box-shadow: 5px 5px 10px rgba(45, 38, 40, 0.8);
            -ms-box-shadow: 5px 5px 10px rgba(45, 38, 40, 0.8);
            -moz-box-shadow: 5px 5px 10px rgba(45, 38, 40, 0.8);
            -o-box-shadow: 5px 5px 10px rgba(45, 38, 40, 0.8);
            -webkit-box-shadow: 5px 5px 10px rgba(45, 38, 40, 0.8);
        }

        input {
            width: 100px;
            height: 25px;
        }
        input[type="reset"] {
            position: absolute;
            bottom:75px;
            left: 50px;
        }
    </style>
</head>
<body>
<?php include 'calculator.php';?>
    <div class="calculator">
        <h1>Calculator</h1>
        <form action="formCalculator.php" method="post">
            <input type="text" name="num-1" placeholder="num" required>
            <select required name="mathSymbol">
                <option value="+">+</option>
                <option value="-">-</option>
                <option value="*">*</option>
                <option value="/">/</option>
                <option value="**">x^n</option>
                <option value="%">%</option>
            </select>
            <input type="text" name="num-2" placeholder="num" required>
            <input type="submit" name="submit" value="=">
            <input type="text" name="result" placeholder="result" value="<?=$result;?>">
            <input type="reset" name="reset" value="clear">
        </form>
    </div>
    <script>
        if ()
    </script>
</body>
</html>