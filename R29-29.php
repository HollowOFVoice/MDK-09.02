<?php

////Устанавливаем кодировку (не обязательно, но поможет избежать проблем):
//mysqli_query($link, "SET NAMES 'utf8'");
//
////Формируем тестовый запрос:
//// TEST
//$query = "SELECT * FROM workers WHERE id > 0";
//
//// 1 Из таблицы workers достаньте первые 6 записей.
////
//
//// 2 Из таблицы workers достаньте записи со вторую, 3 штуки
////$query = "SELECT * FROM workers LIMIT 2, 3";
//
//// 3 Из таблицы workers достаньте всех работников и отсортируйте их по возрастанию зарплаты.
////$query = "SELECT * FROM workers ORDER BY salary";
//
//// 4 Из таблицы workers достаньте всех работников и отсортируйте их по убыванию зарплаты.
////$query = "SELECT * FROM workers ORDER BY salary DESC";
//
//// 5 Из таблицы workers достаньте работников со второго по шестого и отсортируйте их по возрастанию возраста.
////$query = "SELECT * FROM workers LIMIT 2, 4 ORDER BY age";
//
//// 6 В таблице workers подсчитайте всех работников.
////$query = "SELECT COUNT(*) as count FROM workers";
//
//// 7 В таблице workers подсчитайте всех работников c зарплатой 300$.
////$query = "SELECT COUNT(*) as count FROM workers WHERE salary = 300";
//
//// 8 В таблице pages найти строки, в которых фамилия автора заканчивается на "ов"
////$query = "SELECT * FROM pages WHERE athor LIKE '%ов'";
//
//// 9 В таблице pages найти строки, в которых есть слово "элемент" (искать только по колонке article).
////$query = "SELECT * FROM pages WHERE article LIKE '%элемент%'";
//
//// 10 В таблице workers найти строки, в которых возраст работника начинается с числа 3, а далее идет только одна цифра.
////$query = "SELECT * FROM workers WHERE age LIKE '3_'";
//
//// 11 В таблице workers найти строки, в которых имя работника заканчивается на "я".
////$query = "SELECT * FROM workers WHERE name LIKE '%я'";
////Делаем запрос к БД, результат запроса пишем в $result:
//$result = mysqli_query($link, $query) or die(mysqli_error($link));
//for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
////Проверяем что же нам отдала база данных, если null – то какие-то проблемы:
//var_dump($data);
//
//
//?>










<?php
$host = 'localhost';
$user = 'root';
$password = ''; // оставьте пустым, если у root нет пароля
$db_name = 'r2829';

$link = mysqli_connect($host, $user, $password, $db_name) or die(mysqli_error($link));
mysqli_query($link, "SET NAMES 'utf8'");

// Удаление работника
if (isset($_GET['del_id'])) {
    $del_id = intval($_GET['del_id']);
    mysqli_query($link, "DELETE FROM workers WHERE id = $del_id") or die(mysqli_error($link));
}

// Добавление нового работника
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_worker'])) {
    $name = htmlspecialchars($_POST['name']);
    $age = intval($_POST['age']);
    $salary = floatval($_POST['salary']);
    mysqli_query($link, "INSERT INTO workers (name, age, salary) VALUES ('$name', $age, $salary)") or die(mysqli_error($link));
}

// Получение всех работников
$result = mysqli_query($link, "SELECT * FROM workers") or die(mysqli_error($link));

// Обновление данных работника
if (isset($_GET['edit_id'])) {
    $edit_id = intval($_GET['edit_id']);
    $result_edit = mysqli_query($link, "SELECT * FROM workers WHERE id = $edit_id") or die(mysqli_error($link));
    $worker = mysqli_fetch_assoc($result_edit);

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_worker'])) {
        $name = htmlspecialchars($_POST['name']);
        $age = intval($_POST['age']);
        $salary = floatval($_POST['salary']);
        mysqli_query($link, "UPDATE workers SET name='$name', age=$age, salary=$salary WHERE id=$edit_id") or die(mysqli_error($link));
        header('Location: workers.php');
    }
}

// Запросы для выполнения заданий
$first_six = mysqli_query($link, "SELECT * FROM workers LIMIT 6");
$second_to_third = mysqli_query($link, "SELECT * FROM workers LIMIT 1, 3");
$sorted_by_salary_asc = mysqli_query($link, "SELECT * FROM workers ORDER BY salary ASC");
$sorted_by_salary_desc = mysqli_query($link, "SELECT * FROM workers ORDER BY salary DESC");
$sorted_by_age = mysqli_query($link, "SELECT * FROM workers ORDER BY age ASC LIMIT 1, 5");
$count_all_workers = mysqli_query($link, "SELECT COUNT(*) as count FROM workers");
$count_salary_300 = mysqli_query($link, "SELECT COUNT(*) as count FROM workers WHERE salary = 300");
$like_author = mysqli_query($link, "SELECT * FROM pages WHERE author LIKE '%ов'");
$like_element = mysqli_query($link, "SELECT * FROM pages WHERE article LIKE '%элемент%'");
$like_age = mysqli_query($link, "SELECT * FROM workers WHERE age LIKE '3_'");
$like_name = mysqli_query($link, "SELECT * FROM workers WHERE name LIKE '%я'");

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Работники</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>

<h1>Список работников</h1>

<table>
    <tr>
        <th>ID</th>
        <th>Имя</th>
        <th>Возраст</th>
        <th>Зарплата</th>
        <th>Удаление</th>
        <th>Редактировать</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['age']; ?></td>
            <td><?php echo $row['salary']; ?></td>
            <td><a href="?del_id=<?php echo $row['id']; ?>">удалить</a></td>
            <td><a href="?edit_id=<?php echo $row['id']; ?>">редактировать</a></td>
        </tr>
    <?php endwhile; ?>
</table>

<h2>Добавить нового работника</h2>
<form method="POST" action="">
    <label for="name">Имя:</label>
    <input type="text" name="name" required>
    <label for="age">Возраст:</label>
    <input type="number" name="age" required>
    <label for="salary">Зарплата:</label>
    <input type="number" name="salary" step="0.01" required>
    <button type="submit" name="add_worker">Добавить</button>
</form>

<?php if (isset($worker)): ?>
    <h2>Редактировать работника</h2>
    <form method="POST" action="">
        <label for="name">Имя:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($worker['name']); ?>" required>
        <label for="age">Возраст:</label>
        <input type="number" name="age" value="<?php echo $worker['age']; ?>" required>
        <label for="salary">Зарплата:</label>
        <input type="number" name="salary" value="<?php echo $worker['salary']; ?>" step="0.01" required>
        <button type="submit" name="update_worker">Обновить</button>
    </form>
<?php endif; ?>

<h2>Запросы</h2>
<h3>Первые 6 записей:</h3>
<table>
    <tr>
        <th>ID</th>
        <th>Имя</th>
        <th>Возраст</th>
        <th>Зарплата</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($first_six)): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['age']; ?></td>
            <td><?php echo $row['salary']; ?></td>
        </tr>
    <?php endwhile; ?>
</table>

<h3>Записи со второй по третью:</h3>
<table>
    <tr>
        <th>ID</th>
        <th>Имя</th>
        <th>Возраст</th>
        <th>Зарплата</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($second_to_third)): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['age']; ?></td>
            <td><?php echo $row['salary']; ?></td>
        </tr>
    <?php endwhile; ?>
</table>

<h3>Сортировка по зарплате (по возрастанию):</h3>
<table>
    <tr>
        <th>ID</th>
        <th>Имя</th>
        <th>Возраст</th>
        <th>Зарплата</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($sorted_by_salary_asc)): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['age']; ?></td>
            <td><?php echo $row['salary']; ?></td>
        </tr>
    <?php endwhile; ?>
</table>

<h3>Сортировка по зарплате (по убыванию):</h3>
<table>
    <tr>
        <th>ID</th>
        <th>Имя</th>
        <th>Возраст</th>
        <th>Зарплата</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($sorted_by_salary_desc)): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['age']; ?></td>
            <td><?php echo $row['salary']; ?></td>
        </tr>
    <?php endwhile; ?>
</table>

<h3>Сортировка по возрасту:</h3>
<table>
    <tr>
        <th>ID</th>
        <th>Имя</th>
        <th>Возраст</th>
        <th>Зарплата</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($sorted_by_age)): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['age']; ?></td>
            <td><?php echo $row['salary']; ?></td>
        </tr>
    <?php endwhile; ?>
</table>

<h3>Подсчет работников:</h3>
<?php
$count = mysqli_fetch_assoc($count_all_workers);
echo "Всего работников: " . $count['count'] . "<br>";

$count_300 = mysqli_fetch_assoc($count_salary_300);
echo "Количество работников с зарплатой 300: " . $count_300['count'] . "<br>";
?>

<h3>Поиск по LIKE:</h3>
<h4>Авторы, фамилия которых заканчивается на "ов":</h4>
<table>
    <tr>
        <th>ID</th>
        <th>Автор</th>
        <th>Статья</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($like_author)): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['author']; ?></td>
            <td><?php echo $row['article']; ?></td>
        </tr>
    <?php endwhile; ?>
</table>

<h4>Статьи, содержащие слово "элемент":</h4>
<table>
    <tr>
        <th>ID</th>
        <th>Автор</th>
        <th>Статья</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($like_element)): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['author']; ?></td>
            <td><?php echo $row['article']; ?></td>
        </tr>
    <?php endwhile; ?>
</table>

<h4>Работники, возраст которых начинается с "3":</h4>
<table>
    <tr>
        <th>ID</th>
        <th>Имя</th>
        <th>Возраст</th>
        <th>Зарплата</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($like_age)): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['age']; ?></td>
            <td><?php echo $row['salary']; ?></td>
        </tr>
    <?php endwhile; ?>
</table>

<h4>Работники, имя которых заканчивается на "я":</h4>
<table>
    <tr>
        <th>ID</th>
        <th>Имя</th>
        <th>Возраст</th>
        <th>Зарплата</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($like_name)): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['age']; ?></td>
            <td><?php echo $row['salary']; ?></td>
        </tr>
    <?php endwhile; ?>
</table>

</body>
</html>

<?php
mysqli_close($link);
?>





