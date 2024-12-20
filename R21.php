<?php
function square($a) {
    return $a * $a;
}

function add($a, $b) {
    return $a + $b;
}

function subAndProduct($a, $b, $c) {
    return ($a - $b) / $c;
}

function russin_week($day) {
    if ($day < 1 || $day > 7) return "Ошибка";
    $week_days = [ "",
        "понедельник",
        "вторник",
        "среда",
        "четверг",
        "пятница",
        "суббота",
        "воскресенье"
    ];
    return $week_days[$day];
}

$day = 0;
if (isset($_POST['d'])) {
    $day = $_POST['d'];
}

$a = 8;
$b = 2;
$c = 3;

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Математические функции</title>
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
        .result {
            background: #fff;
            border: 1px solid #ddd;
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
        }
        form {
            margin-top: 20px;
        }
        input[type="text"] {
            padding: 8px;
            margin-right: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            background-color: #5cb85c;
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #4cae4c;
        }
    </style>
</head>
<body>

<h1>Математические функции</h1>

<div class="result">
    <p>Квадрат числа = <?= square($a) ?></p>
    <p>Сумма двух чисел = <?= add($a, $b) ?></p>
    <p>Результат метода = <?= subAndProduct($a, $b, $c) ?></p>
    <p>День недели: <?= russin_week($day) ?></p>
</div>

<form method="POST">
    <label for="day">Введите номер дня (1-7):</label>
    <input type="text" name="d" id="day" required>
    <input type="submit" value="Отправить">
</form>

</body>
</html>
