<?php
// // Задача 1: Записать в куку с именем test текст '123'
// if (!isset($_COOKIE['test'])) {
//     setcookie('test', '123', time() + 3600);
//     echo "Кука записана. Обновите страницу.";
// } else {
//     echo "Содержимое куки: " . $_COOKIE['test'];
// }

// // Задача 2: Удалить куку с именем test
// if (isset($_COOKIE['test'])) {
//     setcookie('test', '', time() - 3600);
//     echo "Кука удалена.";
// }

// // Задача 3: Счетчик посещения сайта
// if (!isset($_COOKIE['visit'])) {
//     setcookie('visit', 1, time() + 3600 * 24 * 30);
//     echo "Вы посетили наш сайт 1 раз!";
// } else {
//     $visit = $_COOKIE['visit'] + 1;
//     setcookie('visit', $visit, time() + 3600 * 24 * 30);
//     echo "Вы посетили наш сайт $visit раз!";
// }



// Check if the birthday cookie is set
if (!isset($_COOKIE['birthday'])) {
    // If not, display the form to input the birthday
    echo "Введите дату рождения (в формате дд-мм-гггг): ";
    echo "<form method=\"post\" action=\"\">";
    echo "<input type=\"text\" name=\"birthday\"><br>";
    echo "<input type=\"submit\" value=\"Отправить\">";
    echo "</form>";
} elseif (isset($_POST['birthday'])) {
    // If the form is submitted, validate the input
    $birthday = $_POST['birthday'];
    if (empty($birthday)) {
        echo "Вы не ввели дату рождения.";
    } elseif (!preg_match('/^(\d{2})-(\d{2})-(\d{4})$/', $birthday, $matches)) {
        echo "Неправильный формат даты рождения. Пожалуйста, введите дату в формате дд-мм-гггг.";
    } else {
        // Set the birthday cookie
        setcookie('birthday', $birthday, time() + 3600 * 24 * 365);
        echo "Дата рождения записана.";
        echo "<br>Cookie set: " . $_COOKIE['birthday']; // Add this debug statement
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }
} else {
    // If the cookie is set, calculate the days until the birthday
    $birthday = explode('-', $_COOKIE['birthday']);
    $today = getdate();
    $birthday_timestamp = mktime(0, 0, 0, $birthday[1], $birthday[0], $today['year']);
    echo "<br>Birthday timestamp: $birthday_timestamp"; // Add this debug statement
    echo "<br>Today's timestamp: " . time(); // Add this debug statement
    $daysToBirthday = floor(($birthday_timestamp - time()) / 86400);
    if ($daysToBirthday < 0) {
        $daysToBirthday += 365;
    }
    if ($daysToBirthday == 0) {
        echo "С днём рождения!";
    } else {
        echo "До вашего дня рождения осталось $daysToBirthday дней.";
    }
}



?>
