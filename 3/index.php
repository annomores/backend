<?php
// Отправляем браузеру правильную кодировку,
// файл index.php должен быть в кодировке UTF-8 без BOM.
header('Content-Type: text/html; charset=UTF-8');

// В суперглобальном массиве $_SERVER PHP сохраняет некторые заголовки запроса HTTP
// и другие сведения о клиненте и сервере, например метод текущего запроса $_SERVER['REQUEST_METHOD'].
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  // В суперглобальном массиве $_GET PHP хранит все параметры, переданные в текущем запросе через URL.
  if (!empty($_GET['save'])) {
    // Если есть параметр save, то выводим сообщение пользователю.
   // print('Спасибо, результаты сохранены.');
  }
  // Включаем содержимое файла form.php.
  include('form.php');
  // Завершаем работу скрипта.
  exit();
}
// Иначе, если запрос был методом POST, т.е. нужно проверить данные и сохранить их в XML-файл.

// Проверяем ошибки.
$errors = FALSE;
if (empty($_POST['name'])) {
  print('Заполните имя.<br/>');
  $errors = TRUE;
}
if (empty($_POST['email'])) {
  print('Заполните email.<br/>');
  $errors = TRUE;
}else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  print('Неверный email.<br/>');
  $errors = TRUE;
}
if (empty($_POST['yob']) || !is_numeric($_POST['yob']) || !preg_match('/^\d+$/', $_POST['yob'])) {
  print('Заполните год.<br/>');
  $errors = TRUE;
}
if(empty($_POST['superpowers'])){
  print('Выберите хотя бы 1 суперспособность.<br/>');
  $errors = TRUE;
}
if(empty($_POST['policyCheckBox'])){
  print('Необходимо подтвердить ознакомление с контрактом.<br/>');
  $errors = TRUE;
}


if ($errors) {
  exit();
}

// Сохранение в базу данных.
try{
$user = 'u52822';
$pass = '8321484';
$db = new PDO('mysql:host=localhost;dbname=u52822', $user, $pass, [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);}
catch(PDOException $e){
  die($e->getMessage());
}
// Подготовленный запрос. Не именованные метки.
try{
  $stmt = $db->prepare("INSERT INTO application VALUES (null,:name,:email,:yob,:sex,:num_of_limbs,:biography)");
  $stmt -> execute(['name'=>$_POST['name'], 'email'=>$_POST['email'],'yob'=>$_POST['yob'],'sex'=>$_POST['sex'],'num_of_limbs'=>$_POST['num_of_limbs'],'biography'=>$_POST['biography']]);
  $ap_id = $db->lastInsertId();
  foreach ($_POST['superpowers'] as $sup_id) {
    $stmt = $db->prepare("INSERT INTO application_superpower VALUES (null,:ap_id,:sup_id)");
    $stmt -> execute(['ap_id'=>$ap_id, 'sup_id'=>$sup_id]);
} catch(PDOException $e){
    print('Error : ' . $e->getMessage());
    exit();
}

//  stmt - это "дескриптор состояния".
 
//  Именованные метки.
//$stmt = $db->prepare("INSERT INTO test (label,color) VALUES (:label,:color)");
//$stmt -> execute(['label'=>'perfect', 'color'=>'green']);
 
//Еще вариант
/*$stmt = $db->prepare("INSERT INTO users (firstname, lastname, email) VALUES (:firstname, :lastname, :email)");
$stmt->bindParam(':firstname', $firstname);
$stmt->bindParam(':lastname', $lastname);
$stmt->bindParam(':email', $email);
$firstname = "John";
$lastname = "Smith";
$email = "john@test.com";
$stmt->execute();
*/

// Делаем перенаправление.
// Если запись не сохраняется, но ошибок не видно, то можно закомментировать эту строку чтобы увидеть ошибку.
// Если ошибок при этом не видно, то необходимо настроить параметр display_errors для PHP.
header('Location: /3');
