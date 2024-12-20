<?php
$host = 'localhost';
$user = 'root';
$password = ''; // оставьте пустым, если у root нет пароля
$db_name = 'r27';

$link = mysqli_connect($host, $user, $password, $db_name) or die(mysqli_error($link));
mysqli_query($link, "SET NAMES 'utf8'");

$queries = [
    // Задания на SELECT
    "Задание 1" => "SELECT * FROM workers WHERE id = 3",
    "Задание 2" => "SELECT * FROM workers WHERE salary = 1000",
    "Задание 3" => "SELECT * FROM workers WHERE age = 23",
    "Задание 4" => "SELECT * FROM workers WHERE salary > 400",
    "Задание 5" => "SELECT * FROM workers WHERE salary >= 500",
    "Задание 6" => "SELECT * FROM workers WHERE salary <> 500",
    "Задание 7" => "SELECT * FROM workers WHERE salary <= 900",
    "Задание 8" => "SELECT salary, age FROM workers WHERE name='Вася'",
    "Задание 9" => "SELECT * FROM workers WHERE age > 25 AND age < 28",
    "Задание 10" => "SELECT * FROM workers WHERE name='Вася'",
    "Задание 11" => "SELECT * FROM workers WHERE name='Петя' OR name='Вася'",
    "Задание 12" => "SELECT * FROM workers WHERE name <> 'Петя'",
    "Задание 13" => "SELECT * FROM workers WHERE age = 27 OR salary = 1000",
    "Задание 14" => "SELECT * FROM workers WHERE (age >= 23 AND age < 27) OR salary = 1000",
    "Задание 15" => "SELECT * FROM workers WHERE (age > 23 AND age < 27) OR (salary > 400 AND salary < 1000)",
    "Задание 16" => "SELECT * FROM workers WHERE age = 27 OR salary <> 400",

    // Задания на INSERT
    "Задание 17" => "INSERT INTO workers SET name='Никита', age=26, salary=300",
    "Задание 18" => "INSERT INTO workers (name, age, salary) VALUES ('Светлана', 0, 1200)",
    "Задание 29" => "INSERT INTO workers (name, age, salary) VALUES ('Ярослав', 30, 1200), ('Петр', 31, 1000)",

    // Задания на DELETE
    "Задание 20" => "DELETE FROM workers WHERE id = 7",
    "Задание 21" => "DELETE FROM workers WHERE name = 'Коля'",
    "Задание 22" => "DELETE FROM workers WHERE age = 23",

    // Задания на UPDATE
    "Задание 23" => "UPDATE workers SET salary = 200 WHERE name = 'Вася'",
    "Задание 24" => "UPDATE workers SET age = 35 WHERE id = 4",
    "Задание 25" => "UPDATE workers SET salary = 700 WHERE salary = 500",
    "Задание 26" => "UPDATE workers SET age = 23 WHERE id > 2 AND id <= 5",
    "Задание 27" => "UPDATE workers SET salary = 900, name = 'Женя' WHERE name = 'Ярослав'"
];

// Выполнение запросов и вывод результатов
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQL Запросы</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #333;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }
        pre {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 10px;
            overflow-x: auto;
        }
        p {
            background-color: #e7f3fe;
            padding: 10px;
            border-left: 6px solid #007bff;
            margin: 10px 0;
        }
        .query-result {
            margin: 20px 0;
            padding: 15px;
            background: #ffffff;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<?php
foreach ($queries as $title => $query) {
    echo "<h1>$title</h1><br>";

    if (strpos($query, 'SELECT') === 0) {
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        if ($data) {
            echo "<div class='query-result'><pre>" . var_export($data, true) . "</pre></div>";
        } else {
            echo "<p>Нет данных для отображения.</p>";
        }
    } elseif (strpos($query, 'INSERT') === 0 || strpos($query, 'DELETE') === 0 || strpos($query, 'UPDATE') === 0) {
        // Добавляем кнопку для выполнения запросов INSERT, DELETE и UPDATE
        echo "<form method='post' action=''>";
        echo "<input type='hidden' name='query' value='" . htmlspecialchars($query) . "'>";
        echo "<button type='submit'>Выполнить</button>";
        echo "</form>";

        // Выполнение запроса, если кнопка нажата
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['query']) && $_POST['query'] === $query) {
            $executeResult = mysqli_query($link, $query) or die(mysqli_error($link));
            echo "<p>Запрос выполнен успешно.</p>";
        }
    } else {
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        echo "<p>Запрос выполнен успешно.</p>";
    }
}

mysqli_close($link);
?>

</body>
</html>
