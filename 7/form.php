<html>
<header>
  <link rel="stylesheet" href="style.css" type="text/css">
</header>

<head>
  <style>
    .error {
      margin: 0 auto 2px auto;
      width: 200px;
      border: 2px solid ;
    }
  </style>
</head>

<body>
  <?php
  function generate_token(){
    return $_SESSION['csrf_token'] = md5(str_shuffle( 'qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM'));
}
  if (!empty($messages)) {
    print('<div id="messages">');
    foreach ($messages as $message) {
      print($message);
    }
    print('</div>');
  }
  ?>
  <form action="index.php" method="POST">
    <br>
    <label>
      <?php
      printf('Имя пользователя:');
      ?>
      <br>
       <input name="csrf_token" type="hidden" value="<?php print generate_token() ?>">
      <input name="name" placeholder="name" <?php if ($errors['name']) {
        print 'class="error"';
      } ?>
        value="<?php print $values['name']; ?>">
    </label>
    <label>
      <?php
      printf('Почта:');
      ?>
      <br>
      <input name="email" type="email" placeholder="email" <?php if ($errors['email']) {
        print 'class="error"';
      } ?>
        value="<?php print $values['email']; ?>">
    </label>
    <label>
      <?php
      printf('Год рождения:');
      ?>
      <br>
      <input name="year" placeholder="year" <?php if ($errors['year']) {
        print 'class="error"';
      } ?>
        value="<?php print $values['year']; ?>">
    </label>
    <label <?php if ($errors['gender']) {
      print 'class="error"';
    } ?>>
      <?php
      printf('Пол:');
      ?>
      <br>
      <?php
      printf('М');
      ?>
      <input type="radio" name="gender" value="1" <?php if (!empty($values['gender'] == '1')) {
        print 'checked';
      } ?>>
      <?php
      printf('Ж');
      ?>
      <input type="radio" name="gender" value="2" <?php if (!empty($values['gender'] == '2')) {
        print 'checked';
      } ?>>
    </label>
    <label <?php if ($errors['count_limb']) {
      print 'class="error"';
    } ?>>
      <?php
      printf('Количество конечностей: ');
      ?>
      <br>
      <?php
      printf('2');
      ?>
      <input type="radio" value="1" name="count_limb" <?php if (!empty($values['count_limb'] == '1')) {
        print 'checked';
      } ?>>
      <?php
      printf('4');
      ?>
      <input type="radio" value="2" name="count_limb" <?php if (!empty($values['count_limb'] == '2')) {
        print 'checked';
      } ?>>
      <?php
      printf('6');
      ?>
      <input type="radio" value="3" name="count_limb" <?php if (!empty($values['count_limb'] == '3')) {
        print 'checked';
      } ?>>
    </label>
    <label>
      <?php
      printf('Сверхспособности:');
      ?>
      <br>
      <select name="super_power[]" multiple="multiple" <?php if ($errors['super_power']) {
        print 'class="error"';
      } ?>>
        <option value="1" <?php if (!empty($values['1'] == 1)) {
          print 'selected';
        } ?>>Безнаказанный пропуск пар</option>
        <option value="2" <?php if (!empty($values['2'] == 1)) {
          print 'selected';
        } ?>>Чтение мыслей</option>
        <option value="3" <?php if (!empty($values['3'] == 1)) {
          print 'selected';
        } ?>>Левитация</option>
      </select>
    </label>
    <label>
      <?php
      printf('Биография:');
      ?>
      <br>
      <textarea name="biography" placeholder="about me" <?php if ($errors['biography']) {
        print 'class="error"';
      } ?>> <?php print $values['biography'] ?></textarea>
    </label>
    <label <?php if ($errors['checked']) {
      print 'class="error"';
    } ?>>
      <?php
      printf('Принять соглашение');
      ?>
      <input type="checkbox" name="checked" <?php if (!empty($values['checked'] == 'on')) {
        print 'checked';
      } ?>>
    </label>

    <input name='dd' hidden value=<?php print($_GET['edit_id']);?>>
      <input type="submit" name='save' value="Save"/>
      <input type="submit" name='del' value="Delete"/>
  </form>
  <p>
    <a href='admin.php' class="button">Назад</a>
    </p>
</body>

</html>
