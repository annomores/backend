<?php
  $user = 'u52822';
  $pass = '8321484';
  $db = new PDO('mysql:host=localhost;dbname=u52822', $user, $pass, array(PDO::ATTR_PERSISTENT => true));
$pass_hash = array();
try {
  $get = $db->prepare("select pass_user from admin where user=?");
  $get->execute(array('admin'));
} catch (PDOException $e) {
  print('Error: ' . $e->getMessage());
}

if (empty($_SERVER['PHP_AUTH_USER']) ||
    empty($_SERVER['PHP_AUTH_PW']) ||
    $_SERVER['PHP_AUTH_USER'] != 'admin' ||
    $_SERVER['PHP_AUTH_PW'] != '1234') {
  header('HTTP/1.1 401 Unauthorized');
  header('WWW-Authenticate: Basic realm="My site"');
  header('Content-Type: text/html; charset=UTF-8');
  print '<h1>401 Требуется авторизация</h1>';
  exit();
}
if (empty($_GET['edit_id'])) {
  header('Location: admin.php');
}

header('Content-Type: text/html; charset=UTF-8');
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $messages = array();
  if (!empty($_COOKIE['save'])) {
    setcookie('save', '', 100000);
    setcookie('login', '', 100000);
    setcookie('password', '', 100000);
    $messages[] = 'Спасибо, результаты сохранены.';
    if (!empty($_COOKIE['password'])) {
      $messages[] = sprintf('<br> Вы можете <a href="login.php">войти</a> с логином <strong>%s</strong>
        и паролем <strong>%s</strong> для изменения данных.',
        strip_tags($_COOKIE['login']),
        strip_tags($_COOKIE['password'])
      );
    }
    setcookie('name_value', '', 100000);
    setcookie('email_value', '', 100000);
    setcookie('year_value', '', 100000);
    setcookie('gender_value', '', 100000);
    setcookie('count_limb_value', '', 100000);
    setcookie('biography_value', '', 100000);
    setcookie('1_value', '', 100000);
    setcookie('2_value', '', 100000);
    setcookie('3_value', '', 100000);
    setcookie('checked_value', '', 100000);
  }
  $errors = array();
  $errors['name'] = !empty($_COOKIE['name_error']);
  $errors['year'] = !empty($_COOKIE['year_error']);
  $errors['email'] = !empty($_COOKIE['email_error']);
  $errors['gender'] = !empty($_COOKIE['gender_error']);
  $errors['count_limb'] = !empty($_COOKIE['count_limb_error']);
  $errors['biography'] = !empty($_COOKIE['biography_error']);
  $errors['checked'] = !empty($_COOKIE['checked_error']);
  $errors['super_power'] = !empty($_COOKIE['super_power_error']);


  if ($errors['name']) {
    setcookie('name_error', '', 100000);
    $messages[] = '<div class="error">Неправильная форма имени</div>';
  }
  if ($errors['year']) {
    setcookie('year_error', '', 100000);
    $messages[] = '<div class="error">Неправильная форма года</div>';
  }
  if ($errors['email']) {
    setcookie('email_error', '', 100000);
    $messages[] = '<div class="error">Неправильная форма email</div>';
  }
  if ($errors['gender']) {
    setcookie('gender_error', '', 100000);
    $messages[] = '<div class="error">Выберите пол</div>';
  }
  if ($errors['count_limb']) {
    setcookie('count_limb_error', '', 100000);
    $messages[] = '<div class="error">Выберите кол-во конечностей</div>';
  }
  if ($errors['biography']) {
    setcookie('biography_error', '', 100000);
    $messages[] = '<div class="error">Неправильная форма биографии</div>';
  }
  if ($errors['checked']) {
    setcookie('checked_error', '', 100000);
    $messages[] = '<div class="error">Примите согласие</div>';
  }
  if ($errors['super_power']) {
    setcookie('super_power_error', '', 100000);
    $messages[] = '<div class="error">Выберите суперсилу</div>';
  }

  $values = array();
 
  $values['name'] = empty($_COOKIE['name_value']) || !empty($_SESSION['is_admin']) ? '' : $_COOKIE['name_value'];
  $values['email'] = empty($_COOKIE['email_value']) || !empty($_SESSION['is_admin']) ? '' : $_COOKIE['email_value'];
  $values['year'] = empty($_COOKIE['year']) || !empty($_SESSION['is_admin']) ? '' : $_COOKIE['year_value'];
  $values['biography'] = empty($_COOKIE['biography_value']) || !empty($_SESSION['is_admin']) ? '' : $_COOKIE['biography_value'];
  $values['gender'] = empty($_COOKIE['gender_value']) || !empty($_SESSION['is_admin']) ? '' : $_COOKIE['gender_value'];
  $values['1'] = empty($_COOKIE['1_value']) || !empty($_SESSION['is_admin']) ? '' : $_COOKIE['1_value'];
  $values['2'] = empty($_COOKIE['2_value']) || !empty($_SESSION['is_admin']) ? '' : $_COOKIE['2_value'];
  $values['3'] = empty($_COOKIE['3_value']) || !empty($_SESSION['is_admin']) ? '' : $_COOKIE['3_value'];
  $values['checked'] = empty($_COOKIE['checked_value']) || !empty($_SESSION['is_admin']) ? '' : $_COOKIE['checked_value'];

  if (!empty($_COOKIE[session_name()]) && !empty($_SESSION['login'])) {
  $user = 'u52822';
  $pass = '8321484';
  $db = new PDO('mysql:host=localhost;dbname=u52822', $user, $pass, array(PDO::ATTR_PERSISTENT => true));
    try {
            $id=$_GET['edit_id'];
      $get = $db->prepare("SELECT * FROM person WHERE id=?");
      $get->bindParam(1, $id);
      $get->execute();
      $inf = $get->fetchALL();
      $values['name'] = $inf[0]['name'];
      $values['email'] = $inf[0]['email'];
      $values['year'] = $inf[0]['year'];
      $values['gender'] = $inf[0]['gender'];
      $values['count_limb'] = $inf[0]['count_limb'];
      $values['biography'] = $inf[0]['biography'];
      $values['checked'] = $inf[0]['checked'];
      $get2 = $db->prepare("SELECT power_id FROM super_power WHERE person_id=?");
      $get2->bindParam(1, $id);
      $get2->execute();
      $inf2 = $get2->fetchALL();
      for ($i = 0; $i < count($inf2); $i++) {
        if ($inf2[$i]['power_id'] == '1') {
          $values['1'] = 1;
        }
        if ($inf2[$i]['power_id'] == '2') {
          $values['2'] = 1;
        }
        if ($inf2[$i]['power_id'] == '3') {
          $values['3'] = 1;
        }
      }
    } catch (PDOException $e) {
      print('Error: ' . $e->getMessage());
      exit();
    }
    printf('Произведен вход с логином %s, uid %d', $_SESSION['login'], $_SESSION['uid']);
  }
  include('form.php');
} 
else if (session_start() && isset($_SESSION['csrf_token']) && $_SESSION['csrf_token'] == $_POST['csrf_token']) {


    //Регулярные выражения
    $bioreg = "/^\s*\w+[\w\s\.,-]*$/";
    $reg = "/^\w+[\w\s-]*$/";
    $mailreg = "/^[\w\.-]+@([\w-]+\.)+[\w-]{2,4}$/";


    if (empty($_SESSION['login'])) {
      $checked = $_POST['checked'];
    }
      else if (!preg_match("/^[а-яА-Яa-zA-Z ]+$/u", $_POST['name'])) {
      setcookie('name_error', '1', time() + 24 * 60 * 60);
      $errors = TRUE;
    } else {
      setcookie('name_value', $_POST['name'], time() + 30 * 24 * 60 * 60 * 12);
    }

     if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      setcookie('email_error', '1', time() + 24 * 60 * 60);
      $errors = TRUE;
    } else {
      setcookie('email_value', $_POST['email'], time() + 30 * 24 * 60 * 60 * 12);
    }
    if (empty($_POST['year']) || !is_numeric($_POST['year']) || !preg_match('/^\d+$/', $_POST['year'])) {
      setcookie('year_error', '1', time() + 24 * 60 * 60);
      $errors = TRUE;
    } else {
      setcookie('year_value', $_POST['year'], time() + 30 * 24 * 60 * 60 * 12);
    }
    if (empty($_POST['biography']) || !preg_match($bioreg, $_POST['biography'])) {
      setcookie('biography_error', '1', time() + 24 * 60 * 60);
      $errors = TRUE;
    } else {
      setcookie('biography_value', $_POST['biography'], time() + 30 * 24 * 60 * 60 * 12);
    }
    if (empty($_POST['gender'])) {
      setcookie('gender_error', '1', time() + 24 * 60 * 60);
      $errors = TRUE;
    } else {
      setcookie('gender_value', $_POST['gender'], time() + 30 * 24 * 60 * 60 * 12);
    }
    if (empty($_POST['count_limb'])) {
      setcookie('count_limb_error', '1', time() + 24 * 60 * 60);
      $errors = TRUE;
    } else {
      setcookie('count_limb_value', $_POST['count_limb'], time() + 30 * 24 * 60 * 60 * 12);
    }
    if (empty($_POST['checked'])) {
      setcookie('checked_error', '1', time() + 24 * 60 * 60);
      $errors = TRUE;
    } else {
      setcookie('checked_value', $_POST['checked'], time() + 30 * 24 * 60 * 60 * 12);
    }
    if (!isset($super_power)) {
      setcookie('super_power_error', '1', time() + 24 * 60 * 60);
      setcookie('1_value', '', 100000);
      setcookie('2_value', '', 100000);
      setcookie('3_value', '', 100000);
      $errors = TRUE;
    }
    if (empty($_SESSION['login'])) {
      if (!isset($checked)) {
        setcookie('checked_error', '1', time() + 24 * 60 * 60);
        setcookie('checked_value', '', 100000);
        $errors = TRUE;
      } else {
        setcookie('checked_value', TRUE, time() + 60 * 60);
        setcookie('checked_error', '', 100000);
      }
    }
    if ($errors) {
      setcookie('save', '', 100000);
      header('Location: login.php');
    } else {
      setcookie('name_error', '', 100000);
      setcookie('email_error', '', 100000);
      setcookie('year_error', '', 100000);
      setcookie('gender_error', '', 100000);
      setcookie('count_limb_error', '', 100000);
      setcookie('super_power_error', '', 100000);
      setcookie('biography_error', '', 100000);
      setcookie('checked_error', '', 100000);
    }
try {
            $id = getUserId($_SESSION['login']);
            $second_stmt = $db->prepare("UPDATE application SET name=:name,email=:email, year=:year, gender=:gender,  limbs=:count_limb, bio=:biography  WHERE id =:id");
            $second_stmt -> execute(array("name" => $_POST['name'],"email" => $_POST['email'], "year" => $_POST['year'], "gender" => $_POST['gender'], "limb"=>$_POST['count_limb'], "biography"=>$_POST['biography'], "id"=>$id));
            $third_stmt = $db->prepare("UPDATE app_ability SET abil_id WHERE app_id=:id");
        }
        catch(PDOException $e) {
            print('Error : ' . $e->getMessage());
            exit();
        }
    }
    else {
        $login = uniqid("user");
        $pwd = rand(10000000,100000000);
        setcookie('login', $login);
        setcookie('pass', $pwd);

        try {
            $db = new PDO('mysql:host=localhost;dbname=u52822', $user, $pass);
            $first_stmt = $db->prepare("INSERT INTO person (name,email,year,gender,limbs,biography) VALUES (?,?,?,?,?,?)");

            try{
                $db->beginTransaction();
                $first_stmt->execute(array($_POST['name'],  $_POST['email'], $_POST['year'], $_POST['gender'],  $_POST['limb'],$_POST['bio'],));
                $id = $db->lastInsertId();
                $db->commit();
            } catch (PDOException $exception){
                print "Error: " . $exception->getMessage() . "</br>";
            }

             $app_id = $db->lastInsertId();
             $second_stmt = $db->prepare("INSERT INTO super_power SET power_id=?, power_id = ?");
             foreach ($abilities as $ability) {
             $second_stmt -> execute([$app_id, $ability]);
             }
         
            try {
                $third_stmt = $db->prepare("INSERT INTO login (app_id, login, pwd) VALUES (?,?,?)");
                $db->beginTransaction();
                $third_stmt->execute(array($id, $login, password_hash($pwd, PASSWORD_DEFAULT)));
                $db->commit();
            } catch (PDOException $exception){
                print "Error: " . $exception->getMessage() . "</br>";
            }
        }
        catch(PDOException $e) {
            print('Error : ' . $e->getMessage());
            exit();
        }
    }
  $user = 'u52822';
  $pass = '8321484';
  $db = new PDO('mysql:host=localhost;dbname=u52822', $user, $pass, array(PDO::ATTR_PERSISTENT => true));
      if (!$errors) {
      $upd = $db->prepare("UPDATE person SET name=:name, email=:email, year=:year, gender=:gender, count_limb=:count_limb, biography=:biography WHERE id=:id");
      $cols = array(
        ':name' => $name,
        ':email' => $email,
        ':year' => $year,
        ':gender' => $gender,
        ':count_limb' => $count_limb,
        ':biography' => $biography
      );
      foreach ($cols as $k => &$v) {
        $upd->bindParam($k, $v);
      }
      $upd->bindParam(':id', $id);
      $upd->execute();
      $del = $db->prepare("DELETE FROM super_power WHERE person_id=?");
      $del->execute(array($id));
      $upd1 = $db->prepare("INSERT INTO super_power SET person_id=:id, power_id=:power");
      $upd1->bindParam(':id', $id);
      foreach($super_power as $value){
          $upd1->bindParam(':power', $value);
          $upd1->execute();
      }
    }
    if (!$errors) {
      setcookie('save', '1');
    }
    header('Location: index.php?edit_id=' . $id);
   else {
    $id = $_POST['dd'];
    $user = 'u52822';
    $pass = '8321484';
    $db = new PDO('mysql:host=localhost;dbname=u52822', $user, $pass, array(PDO::ATTR_PERSISTENT => true));
    try {
      $del = $db->prepare("DELETE FROM super_power WHERE person_id=?");
      $del->execute(array($id));
      $stmt = $db->prepare("DELETE FROM person WHERE id=?");
      $stmt->execute(array($id));
    } catch (PDOException $e) {
      print('Error : ' . $e->getMessage());
      exit();
    }
    setcookie('del', '1');
    setcookie('del_user', $id);
    header('Location: admin.php');
  }

}
