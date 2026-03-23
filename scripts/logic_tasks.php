<?php
// пользователь вводит сумму вклада и процент, который будет начисляться ежегодно

$sum = 9999;
$percent = 7;

for ($i = 1; $i <= 10; $i++) {
    $sum = $sum + ($sum * $percent / 100);
    echo "Год $i: " . round($sum, 2) . " руб." . "<br>";
}

echo "______________________________________________<br><br>";

// переменные a и b, нужно проверить, что a делится без остатка на b, и выводить результат
$a = 9;
$b = 3;

// 10 % 3 = 1
// 10 % 2 = 0

echo($a);
echo("<br>");
echo($b);
echo("<br>");

if ($a % $b == 0) {
    echo "Делится, ответ " . ($a / $b);
} else {
    echo "Не делится, есть остаток " . ($a % $b);
}

echo "<br><br>______________________________________________<br><br>";

// заполнить массив с помощью цикла следующим образом, что в первый элемент пишется "1", "22", в третий "333" и т.д.

$result = [];
for ($i = 1; $i <= 9; $i++) {
    $str = "";
    for ($j = 1; $j <= $i; $j++) {
        $str .= $i;
    }
    $result[] = $str;
}
print_r($result);

echo "<br><br>______________________________________________<br><br>";

$result_2 = [];
for ($i = 1; $i <= 9; $i++) {
    $result_2[] = str_repeat($i, $i);
}
print_r($result_2);

echo "<br><br>______________________________________________<br><br>";

// конвертер валют - написать функцию, которая принимает нашу сумму в рублях, и которая обрабатывает сумму с помощью текущего курса доллара, и возвращает сумму в долларах

function convert_currency($rubles, $exchangeRate) {
    $result_currency = $rubles / $exchangeRate;
    return $result_currency;
}

$myCash = 1000;
$dollarRate = 80;

echo "После конвертации вы получите " . convert_currency($myCash, $dollarRate) . "<br>";

$myCashYuan = 10000;
$dollarRateYuan = 50;

echo "После конвертации вы получите " . convert_currency($myCashYuan, $dollarRateYuan) . " юаней <br>";

echo "<br><br>______________________________________________<br><br>";

// сделать функцию, которая принимает оценку в виде числа. Если оценка выше или равна 3 - предмет сдан, иначе студент идёт на пересдачу

function check_grade($score) {
    if ($score == 3) {
        return "Удовлетворительно";
    } else if ($score == 4) {
        return "Хорошо";
    } else if ($score == 5) {
        return "Отлично";
    } else if ($score < 3) {
        return "Надо идти на пересдачу";
    } else {
        return "Проверьте число!";
    }
}

echo "Иван Иванов: " . check_grade(5) . "<br>";
echo "Петр Петров: " . check_grade(2) . "<br>";








?>