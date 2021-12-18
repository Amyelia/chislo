<form method="post" action="">
Счастливый билет: <input type="text" name="number" value="<?php
//Создаем переменные для нашего билета
$i= rand(0,9);
$q= rand(0,9);
$w= rand(0,9);
$e= rand(0,9);
$r= rand(0,9);
$t= rand(0,9);
//Суммируем первые три числа
$first = $i + $q + $w;
//Суммируем последние три числа
$last = $e + $r + $t;
$full=$i.$q.$w.$e.$r.$t;
//Выводим наш билет в форму
echo $full
?>">
<input type="submit" name="yes" value="Да">
<?php
//Устанавливаем событие при нажатии на кнопку
if (isset($_POST['yes'])){
    if ($first == $last) {
        echo 'Верно';
        //Создаем соединение с базой PostgreSQL с указанными параметрами и записываем в таблицу numbers счастливый билет и выбор
        $dbconn = pg_connect("host=localhost dbname=chislo user=postgres password=123");
        $query = pg_query($dbconn, "INSERT INTO numbers (lucky_number,guess) VALUES('$full','yes')");
    }
    else {
        echo 'Не Верно';
        $dbconn = pg_connect("host=localhost dbname=chislo user=postgres password=123");
        $query = pg_query($dbconn, "INSERT INTO numbers (lucky_number,guess) VALUES('$full','no')");
    }
}
?>
<input type="submit" name="no" value="Нет">
    <?php
    if (isset($_POST['no'])){
        if ($first != $last) {
            echo 'Верно';
            //Создаем соединение с базой PostgreSQL с указанными параметрами и записываем в таблицу numbers не счастливый билет и выбор
            $dbconn = pg_connect("host=localhost dbname=chislo user=postgres password=123");
            $query = pg_query($dbconn, "INSERT INTO numbers (unlucky_number,guess) VALUES('$full','yes')");
        }
        else {
            echo 'Не Верно';
            $dbconn = pg_connect("host=localhost dbname=chislo user=postgres password=123");
            $query = pg_query($dbconn, "INSERT INTO numbers (unlucky_number,guess) VALUES('$full','no')");
        }
    }
    ?>