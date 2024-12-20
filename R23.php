<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Функции на PHP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #333;
        }
        .task {
            background: #fff;
            border: 1px solid #ddd;
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
        }
        .result {
            font-weight: bold;
            color: #5cb85c;
        }
    </style>
</head>
<body>

<div class="task">
    <h1>Задача 1</h1>
    <?php
    // 1 Сделайте функцию, которая параметрами принимает 2 числа. Если эти числа равны - пусть функция вернет true, а если не равны - false.
    function ravenstvo($a, $b)
    {
        return $a == $b;
    }

    $a = 6; $b = 6;
    echo '<p class="result">Результат: ' . (ravenstvo($a, $b) ? 'True' : 'False') . '</p>';
    ?>
</div>

<div class="task">
    <h1>Задача 2</h1>
    <?php
    // 2 Сделайте функцию, которая параметрами принимает 2 числа. Если их сумма больше 10 - пусть функция вернет true, а если нет - false.
    function summa($a, $b)
    {
        return ($a + $b) > 10;
    }

    echo '<p class="result">Результат: ' . (summa($a, $b) ? 'True' : 'False') . '</p>';
    ?>
</div>

<div class="task">
    <h1>Задача 3</h1>
    <?php
    // 3 Сделайте функцию, которая параметром принимает число и проверяет - отрицательное оно или нет. Если отрицательное - пусть функция вернет true, а если нет - false.
    function otric($x)
    {
        return $x < 0;
    }

    $x = -1;
    echo '<p class="result">Результат: ' . (otric($x) ? 'True' : 'False') . '</p>';
    ?>
</div>

</body>
</html>
