<html>
  <head>
    <style>
/* Сообщения об ошибках и поля с ошибками выводим с красным бордюром. */
.error {
  border: 2px solid red;
}
    </style>
  </head>
  <body>
<body>
<div class="container">
  <h1 class="text-center m-5">Web Backend Lab 4</h1>

  <div class="container-sm theme-list py-3 pl-0 mb-3">
    <div class="d-flex flex-column align-items-center">

      <form class="d-block p-2" action="index.php" method="POST">

          <div class="form-floating mb-3">
                  <input class="form-control" name="fio" type="text" placeholder="FirstName LastName" id="fio">
                  <label for="fio" class="form-label">Ваше имя</label> <?php 
            if(isset($_COOKIE['fio']))
              print $_COOKIE['fio'];?>
                </div>
<div class="form-floating mb-3">
                  <input class="form-control" name="email" type="email" placeholder="name@example.com" id="email">
                  <label for="email" class="form-label">Ваш email</label>
        <?php 
            if(isset($_COOKIE['email']))
              print $_COOKIE['email'];?>
        </div>
         <div class="mb-3">
                  <label for="year" class="form-label">Дата рождения</label>
                  <select class="form-select" name="year" id="year">
                    <?php 
                       for($i = 1900; $i < 2020; $i++){
            if(isset($_COOKIE['email']))
              printf('<option value="%d" selected>%d год</option>', $i, $i);
                         else 
                           printf('<option value="%d">%d год</option>', $i, $i);
                       }
                    }
                    else{
                      (for $i=2023; $i>=1900; $i--){
                        printf('<option value="%d">%d год</option>', $i, $i);
                      }
                    }
                    ?>
           </select>
        </div>
                        
                           
              
<?php
if (!empty($messages)) {
  print('<div id="messages">');
  // Выводим все сообщения.
  foreach ($messages as $message) {
    print($message);
  }
  print('</div>');
}

// Далее выводим форму отмечая элементы с ошибками классом error
// и задавая начальные значения элементов ранее сохраненными.
?>

    <form action="" method="POST">
      <input name="fio" <?php if ($errors['fio']) {print 'class="error"';} ?> value="<?php print $values['fio']; ?>" />
      <input type="submit" value="ok" />
    </form>
  </body>
</html>
