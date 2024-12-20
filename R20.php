<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Задачи по времени</title>
    <style>
        html {
            min-height: 100%;
        }
        body {
            color: #ffffff;
            font-size: 18px;
            background: linear-gradient(to right, #D38312, #C779D0, #4BC0C8);
            padding: 20px;
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        .task {
            background-color: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 10px;
            padding: 20px;
            margin: 20px 0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
        h1 {
            color: #ffffff;
            font-size: 24px;
            margin-bottom: 10px;
        }
        label, p {
            color: #ffffff;
            font-size: 18px;
        }
        input[type="text"], input[type="submit"] {
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            border: 1px solid #fff;
            width: calc(100% - 22px);
            font-size: 16px;
        }
        input[type="submit"] {
            background-color: #f7994f;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #f68e3e;
        }
    </style>
</head>
<body>

<div class="task">
    <h1>Задача 1: Текущая метка времени и дата</h1>
    <p>Метка времени (Unix): <?php echo time(); ?></p>
    <p>Читаемая дата и время: <?php echo date('Y-m-d H:i:s', time()); ?></p>
</div>

<div class="task">
    <h1>Задача 2: Метка времени для 1 марта 2025</h1>
    <p>Метка времени (Unix): <?php echo mktime(0, 0, 0, 3, 1, 2025); ?></p>
    <p>Читаемая дата: <?php echo date('Y-m-d', mktime(0, 0, 0, 3, 1, 2025)); ?></p>
</div>

<div class="task">
    <h1>Задача 3: Метка времени для 31 декабря текущего года</h1>
    <p>Метка времени (Unix): <?php echo mktime(0, 0, 0, 12, 31); ?></p>
    <p>Читаемая дата: <?php echo date('Y-m-d', mktime(0, 0, 0, 12, 31)); ?></p>
</div>

<div class="task">
    <h1>Задача 4: Разница времени с 15 марта 2000 года</h1>
    <p>Разница в секундах: <?php echo time() - mktime(13, 12, 59, 3, 15, 2000); ?></p>
    <p>Разница в днях: <?php echo floor((time() - mktime(13, 12, 59, 3, 15, 2000)) / (60 * 60 * 24)); ?></p>
</div>

<div class="task">
    <h1>Задача 5: Количество часов с 7:23:48</h1>
    <p>Часов с 7:23:48: <?php
        $now = time(); // Текущее время
        $currentDate = date('Y-m-d'); // Получаем текущую дату
        $date = strtotime("$currentDate 07:23:48"); // Создаем timestamp для 7:23:48 текущего дня

        // Проверяем, если текущее время меньше 7:23:48, то отнимаем 1 день
        if ($now < $date) {
            $date = strtotime("$currentDate -1 day 07:23:48");
        }

        // Вычисляем разницу в часах
        $hoursPassed = floor(($now - $date) / 3600); // Выводим количество целых часов
        echo $hoursPassed;

        ?></p>
</div>

<div class="task">
    <h1>Задача 6: Текущая дата и время</h1>
    <p><?php echo date('Y-m-d H:i:s'); ?></p>
</div>

<div class="task">
    <h1>Задача 7: Форматы даты</h1>
    <p>Полная дата: <?php echo date('Y-m-d'); ?></p>
    <p>Формат дд.мм.ГГГГ: <?php echo date('d.m.Y'); ?></p>
    <p>Формат дд.мм.ГГ: <?php echo date('d.m.y'); ?></p>
    <p>Текущее время: <?php echo date('H:i:s'); ?></p>
</div>

<div class="task">
    <h1>Задача 8: Дата 12.02.2025</h1>
    <p>Метка времени: <?php echo mktime(0, 0, 0, 2, 12, 2025); ?></p>
    <p>Читаемая дата: <?php echo date('d.m.Y', mktime(0, 0, 0, 2, 12, 2025)); ?></p>
</div>

<div class="task">
    <h1>Задача 9: День недели для текущей даты</h1>
    <?php
    $week = ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'];
    ?>
    <p>Сегодня: <?php echo $week[date('w', time())]; ?></p>
    <p>6 июня 2006: <?php echo $week[date('w', mktime(0, 0, 0, 6, 6, 2006))]; ?></p>
    <p>26 января 1995: <?php echo $week[date('w', mktime(0, 0, 0, 1, 26, 1995))]; ?></p>
</div>

<div class="task">
    <h1>Задача 10: Текущий месяц</h1>
    <?php
    $month = [1 => 'Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'];
    ?>
    <p>Текущий месяц: <?php echo $month[date('n', time())]; ?></p>
</div>

<div class="task">
    <h1>Задача 11: Количество дней в текущем месяце</h1>
    <p>Дней в текущем месяце: <?php echo date('t', time()); ?></p>
</div>

<div class="task">
    <h1>Задача 12: Проверка високосного года</h1>
    <form action="" method="post">
        <input type="text" name="year" placeholder="Введите год">
        <input type="submit" value="Проверить">
    </form>
    <p>
        <?php
        if (isset($_REQUEST['year'])) {
            $year = trim(strip_tags($_REQUEST['year']));
            if (strlen($year) == 4) {
                echo date('L', mktime(0, 0, 0, 1, 1, $year)) ? 'Високосный' : 'Не високосный';
            } else {
                echo 'Неверный ввод';
            }
        }
        ?>
    </p>
</div>

<div class="task">
    <h1>Задача 13: День недели для введенной даты</h1>
    <form action="" method="post">
        <input type="text" name="date" placeholder="Введите дату (дд.мм.гггг)">
        <input type="submit" value="Проверить">
    </form>
    <p>
        <?php
        if (isset($_REQUEST['date'])) {
            $date = strip_tags(trim($_REQUEST['date']));
            $arrDate = explode('.', $date);
            $dateSec = mktime(0, 0, 0, $arrDate[1], $arrDate[0], $arrDate[2]);
            $week = ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'];
            echo "День недели: " . $week[date('w', $dateSec)];
        }
        ?>
    </p>
</div>

<div class="task">
    <h1>Задача 14: Месяц для введенной даты</h1>
    <form action="" method="post">
        <input type="text" name="datee" placeholder="Введите дату (ГГГГ-ММ-ДД)">
        <input type="submit" value="Проверить">
    </form>
    <p>
        <?php
        if (isset($_REQUEST['datee'])) {
            $date = explode('-', trim(strip_tags($_REQUEST['datee'])));
            $dateSec = mktime(0, 0, 0, $date[1], $date[2], $date[0]);
            $month = [1 => 'Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'];
            echo "Месяц: " . $month[date('n', $dateSec)];
        }
        ?>
    </p>
</div>

<div class="task">
    <h1>Задача 15: Сравнение двух дат</h1>
    <form action="" method="post">
        <input type="text" name="date1" placeholder="Введите первую дату (ГГГГ-ММ-ДД)">
        <input type="text" name="date2" placeholder="Введите вторую дату (ГГГГ-ММ-ДД)">
        <input type="submit" value="Проверить">
    </form>
    <p>
        <?php
        if (isset($_REQUEST['date1']) && isset($_REQUEST['date2'])) {
            $date1 = explode('-', strip_tags(trim($_REQUEST['date1'])));
            $date2 = explode('-', strip_tags(trim($_REQUEST['date2'])));
            $date1sec = mktime(0, 0, 0, $date1[1], $date1[2], $date1[0]);
            $date2sec = mktime(0, 0, 0, $date2[1], $date2[2], $date2[0]);
            echo "Более поздняя дата: " . ($date1sec > $date2sec ? date('Y-m-d', $date1sec) : date('Y-m-d', $date2sec));
        }
        ?>
    </p>
</div>

<div class="task">
    <h1>Задача 16: Форматирование даты</h1>
    <p>Форматированная дата: <?php echo date('d-m-Y', strtotime('2025-12-31')); ?></p>
</div>

<div class="task">
    <h1>Задача 17: Ввод даты и вывод времени</h1>
    <form action="" method="post">
        <input type="text" name="dateee" placeholder="Введите дату">
        <input type="submit" value="Проверить">
    </form>
    <p>
        <?php
        if (isset($_REQUEST['dateee'])) {
            echo date('H:i:s d.m.Y', strtotime($_REQUEST['dateee']));
        }
        ?>
    </p>
</div>

<div class="task">
    <h1>Задача 18: Изменение даты</h1>
    <?php
    $date = date_create('2025-12-31');
    echo "Дата + 1 день: " . date_format(date_modify($date, '1 day'), 'Y-m-d') . "<br>";
    echo "Дата + 1 месяц + 3 дня: " . date_format(date_modify($date, '1 month 3 day'), 'Y-m-d') . "<br>";
    echo "Дата + 1 год: " . date_format(date_modify($date, '1 year'), 'Y-m-d') . "<br>";
    echo "Дата - 3 дня: " . date_format(date_modify($date, '-3 day'), 'Y-m-d') . "<br>";
    ?>
</div>

<div class="task">
    <h1>Задача 19: Осталось дней до Нового года</h1>
    <?php
    $now = time();
    $newYear = mktime(0, 0, 0, 12, 31);
    echo "Дней до Нового года: " . ceil(($newYear - $now) / 60 / 60 / 24);
    ?>
</div>

<div class="task">
    <h1>Задача 20: Даты с 13 числом, попадающим на пятницу</h1>
    <form action="" method="post">
        <input type="text" name="years" placeholder="Введите год">
        <input type="submit" value="Проверить">
    </form>
    <p>
        <?php
        if (isset($_REQUEST['years'])) {
            $year = $_REQUEST['years'];
            for ($i = 1; $i <= 12; $i++) {
                if (date('w', mktime(0, 0, 0, $i, 13, $year)) == 5) {
                    echo date('d-m-Y', mktime(0, 0, 0, $i, 13, $year)) . "<br>";
                }
            }
        }
        ?>
    </p>
</div>

<div class="task">
    <h1>Задача 21: Дата 100 лет назад</h1>
    <p><?php echo date('l jS \of F Y h:i:s A', strtotime('-100 years')); ?></p>
</div>

</body>
</html>
