<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Задачи на PHP</title>
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
    function five($arr)
    {
        foreach ($arr as $item) {
            if ($item == 5) {
                return true;
            }
        }
        return false;
    }
    $num = [1, 2, 3, 4, 5, 6];
    if (five($num)) {
        echo '<p class="result">True</p>';
    } else {
        echo '<p class="result">False</p>';
    }
    ?>
</div>

<div class="task">
    <h1>Задача 2</h1>
    <?php
    function delitel($x)
    {
        for ($i = 2; $i < $x; $i++) {
            if ($x % $i == 0) {
                return true;
            }
        }
        return false;
    }
    $num = 31;
    if (delitel($num)) {
        echo '<p class="result">True</p>';
    } else {
        echo '<p class="result">False</p>';
    }
    ?>
</div>

<div class="task">
    <h1>Задача 3</h1>
    <?php
    function has_consecutive_duplicates($array) {
        for ($i = 0; $i < count($array) - 1; $i++) {
            if ($array[$i] === $array[$i + 1]) {
                return 'да';
            }
        }
        return 'нет';
    }

    // Пример использования
    $numbers = [1, 2, 3, 4, 4, 5];
    echo '<p class="result">' . has_consecutive_duplicates($numbers) . '</p>'; // Выведет 'да'
    ?>
</div>

</body>
</html>
