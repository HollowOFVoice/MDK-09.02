<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Голосование и Файлообменник</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, rgb(211, 131, 18), rgb(199, 121, 208), rgb(75, 192, 200));
            color: white;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
        }
        .form-container {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 20px;
            border-radius: 10px;
            margin: 20px auto;
            width: 80%;
            max-width: 600px;
        }
        input[type="text"], input[type="submit"], input[type="radio"], input[type="file"] {
            margin: 10px 0;
            padding: 10px;
            font-size: 18px;
            border-radius: 5px;
            border: 1px solid #fff;
            width: calc(100% - 22px);
        }
        input[type="submit"] {
            background-color: #f7994f;
            color: white;
            cursor: pointer;
        }
        .results {
            margin-top: 20px;
        }
        .vote-bar {
            background-color: #FF1493;
            height: 20px;
            border-radius: 5px;
        }
        .file-list {
            margin-top: 20px;
            background-color: rgba(255, 255, 255, 0.1);
            padding: 10px;
            border-radius: 5px;
        }
        .file-item {
            display: flex;
            justify-content: space-between;
            margin: 5px 0;
        }
    </style>
</head>
<body>
<h1>______________Задание 1 и 2______________</h1>
<h1>Оцените наш магазин</h1>
<div class="form-container">
    <form method="POST" action="">
        <input type="radio" name="vote" value="5"> Отлично - 5<br>
        <input type="radio" name="vote" value="4"> Хорошо - 4<br>
        <input type="radio" name="vote" value="3"> Удовлетворительно - 3<br>
        <input type="radio" name="vote" value="2"> Плохо - 2<br>
        <input type="submit" value="Проголосовать">
    </form>
</div>

<?php
// Обработка голосования
if (isset($_POST['vote'])) {
    $file = $_POST['vote'] . ".txt";

    // Открыть файл и прочитать текущее количество голосов
    if (file_exists($file)) {
        $f = fopen($file, "r");
        $votes = (int)fread($f, filesize($file));
        fclose($f);

        // Увеличить количество голосов и записать обратно в файл
        $votes++;
        $f = fopen($file, "w");
        fwrite($f, $votes);
        fclose($f);
    } else {
        file_put_contents($file, 1); // Создаем файл, если он не существует
    }
}

// Вывод результатов голосования
$results = [];
$files = ["2.txt", "3.txt", "4.txt", "5.txt"];
$totalVotes = 0;

foreach ($files as $file) {
    if (file_exists($file)) {
        $votes = (int)file_get_contents($file);
        $results[basename($file, ".txt")] = $votes;
        $totalVotes += $votes;
    }
}

echo "<div class='results'><h2>Результаты голосования:</h2>";
foreach ($results as $value => $votes) {
    echo "<p>Оценка $value: $votes голосов</p>";
}
echo "</div>";

// Вывод диаграммы
echo "<h2>Диаграмма голосования:</h2>";
foreach ($results as $value => $votes) {
    $percentage = ($totalVotes > 0) ? ($votes / $totalVotes) * 100 : 0;
    echo "<div>Оценка $value: <div class='vote-bar' style='width: {$percentage}%;'></div> {$percentage}%</div>";
}
?>

<h1>Задание 3</h1>
<div class="form-container">
    <?php
    // Функция для добавления нового абонента
    function add_abonent($name, $phone) {
        $file = "phonebook.txt";
        $f = fopen($file, "a");
        fwrite($f, "$name|$phone\n");
        fclose($f);
    }

    // Функция для вывода всех абонентов
    function show_abonents() {
        $file = "phonebook.txt";
        if (file_exists($file)) {
            $f = fopen($file, "r");
            while ($line = fgets($f)) {
                list($name, $phone) = explode("|", $line);
                echo "$name: $phone<br>";
            }
            fclose($f);
        }
    }

    // Форма для добавления нового абонента
    echo "<form method='post' action=''>";
    echo "<p>Введите имя абонента:</p>";
    echo "<input type='text' name='name' placeholder='Имя абонента' required>";
    echo "<p>Введите телефон абонента:</p>";
    echo "<input type='text' name='phone' placeholder='Телефон абонента' required>";
    echo "<input type='submit' value='Добавить'>";
    echo "</form>";

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name']) && isset($_POST['phone'])) {
        add_abonent($_POST['name'], $_POST['phone']);
    }

    // Выводим всех абонентов
    show_abonents();
    ?>
</div>

<h1>Задание 4</h1>
<div class="form-container">
    <?php
    function check_server($server) {
        // Проверка на корректность URL
        if (!filter_var($server, FILTER_VALIDATE_URL)) {
            echo "<div class='error-text'>Ошибка: некорректный URL.</div>";
            return;
        }

        $url_parts = parse_url($server);

        // Если протокол не указан, добавляем HTTP
        if (!isset($url_parts['host'])) {
            echo "<div class='error-text'>Ошибка: не удалось определить хост.</div>";
            return;
        }

        $server = $url_parts['host'];
        $fp = fsockopen($server, 80, $errno, $errstr, 10);
        if (!$fp) {
            echo "<div class='error-text'>Сервер недоступен: $errstr ($errno)</div>";
        } else {
            fclose($fp);
            echo "Сервер доступен";
        }
    }


    // Форма для проверки сервера
    echo "<form method='post' action=''>";
    echo "<p>Введите URL-адрес сервера:</p>";
    echo "<input type='text' name='server' placeholder='http://www.example.com' required>";
    echo "<input type='submit' value='Проверить'>";
    echo "</form>";

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['server'])) {
        check_server($_POST['server']);
    }
    ?>
</div>

<h1>Файлообменник</h1>
<div class="form-container">
    <h2>Загрузить файл</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="file" required>
        <input type="submit" value="Загрузить">
    </form>

    <?php
    // Настройки
    $uploadDir = "uploads/";
    $allowedTypes = ['image/jpeg', 'image/png', 'application/pdf', 'text/plain'];
    $maxDiskSpace = 10 * 1024 * 1024; // 10 МБ

    // Создание директории, если не существует
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir);
    }

    // Обработка загрузки файла
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
        $file = $_FILES['file'];
        $filePath = $uploadDir . basename($file['name']);
        $fileSize = $file['size'];
        $fileType = $file['type'];

        // Проверка типа файла
        if (!in_array($fileType, $allowedTypes)) {
            echo "<p>Ошибка: неподдерживаемый тип файла. Разрешены только JPEG, PNG, PDF и TXT.</p>";
        } else {
            // Проверка свободного места на диске
            $freeSpace = disk_free_space($uploadDir);
            if ($fileSize > $freeSpace) {
                echo "<p>Ошибка: недостаточно места на диске для загрузки файла.</p>";
            } else {
                if (move_uploaded_file($file['tmp_name'], $filePath)) {
                    echo "<p>Файл загружен успешно: $filePath</p>";
                } else {
                    echo "<p>Ошибка при загрузке файла.</p>";
                }
            }
        }
    }


    // Вывод загруженных файлов
    echo "<h2>Список загруженных файлов:</h2>";
    if (is_dir($uploadDir)) {
        $files = array_diff(scandir($uploadDir), ['.', '..']);
        if (count($files) > 0) {
            echo "<div class='file-list'>";
            foreach ($files as $file) {
                echo "<div class='file-item'>";
                echo "<span>$file</span>";
                echo "<form method='POST' action='' style='display:inline;'>";
                echo "<input type='hidden' name='delete_file' value='$file'>";
                echo "<input type='submit' value='Удалить' style='background-color: red;margin: 10px'>";
                echo "</form>";
                echo "</div>";
            }
            echo "</div>";
        } else {
            echo "<p>Нет загруженных файлов.</p>";
        }
    }

    // Удаление файла
    if (isset($_POST['delete_file'])) {
        $fileToDelete = $uploadDir . $_POST['delete_file'];
        if (file_exists($fileToDelete)) {
            unlink($fileToDelete);
            echo "<p>Файл удален: {$_POST['delete_file']}</p>";
        } else {
            echo "<p>Ошибка: файл не найден.</p>";
        }
    }
    ?>
</div>

</body>
</html>
