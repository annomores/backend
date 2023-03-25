<link rel="stylesheet" href="/3/style.css">
<form action="" method="POST">
  <div class="col-md-6">
            <label for="formName" class="form-label">Имя</label>
            <input name="name" id="formName" class="form-control" placeholder="Введите имя" value="<?php  
              if(isset($_COOKIE['name']))
              print $_COOKIE['name'];
              ?>">
          </div>
  <div class="col-md-6">
            <label for="formEmail" class="form-label">Email</label>
            <input name="email" id="formEmail" class="form-control" type="email" placeholder="Введите почту" value="<?php  
              if(isset($_COOKIE['email']))
              print $_COOKIE['email'];
              ?>">
          </div>
   <div class="col-md-6">
   <label for="year" class="form-label">Год рождения</label>
            <select name="yob" id="year" class="form-select">
            <?php 
    for ($i = 1922; $i <= 2022; $i++) {
      printf('<option value="%d">%d год</option>', $i, $i);
    }
    ?>
    </select>
          </div>
  
   <div class="col-md-6 d-flex justify-content-center">
     <div class="col-6 m-auto row">
              <label class="form-label">Пол</label>
              <div class="col-6 ">
                <input class="form-check-input" type="radio" name="sex" value="1"
                       id="M">
                <label class="form-check-label" for="M">М</label>
              </div>
              <div class="col-6">
                <input class="form-check-input" type="radio" name="sex" value="0"
                       id="ZH">
                <label class="form-check-label" for="ZH">Ж</label>
              </div>
            </div>
     
      <div class="col-6 m-auto row">
              <label class="form-label">Количество конечностей</label>
              <div class="col-6 col-md-2">
                <input class="form-check-input" type="radio" name="num_of_limbs" value="0"
                       id="0">
                <label class="form-check-label" for="0">0</label>
              </div>
         <div class="col-6 col-md-2">
                <input class="form-check-input" type="radio" name="num_of_limbs" value="1"
                       id="1">
                <label class="form-check-label" for="1">1</label>
              </div>
              <div class="col-6 col-md-2">
                <input class="form-check-input" type="radio" name="num_of_limbs" value="2"
                       id="2">
                <label class="form-check-label" for="2">2</label>
              </div>
        <div class="col-6 col-md-2">
                <input class="form-check-input" type="radio" name="num_of_limbs" value="3"
                       id="3">
                <label class="form-check-label" for="3">3</label>
              </div>
              <div class="col-6 col-md-2">
                <input class="form-check-input" type="radio" name="num_of_limbs" value="4" 
                id="4">
                <label class="form-check-label" for="4">4</label>
              </div>
              <div class="col-6 col-md-2">
                <input class="form-check-input" type="radio" name="num_of_limbs" value="5" 
                       id="5">
                <label class="form-check-label" for="5">5</label>
              </div>
            </div>

          </div>
   <div class="col-12">
            <label for="superpowers" class="form-label">Сверхспособности</label>
            <select name="superpowers[]" id="superpowers" multiple="multiple" class="form-select">
               <option value="1" <?php if(in_array(1,$ar)) echo 'selected' ?>>летать</option>
              <option value="2" <?php if(in_array(2,$ar)) echo 'selected' ?>>безнаказанный пропуск пар</option>
              <option value="3" <?php if(in_array(3,$ar)) echo 'selected' ?>>чтение мыслей</option>
            </select>
          </div>
    <div class="col-12">
            <label for="biography" class="form-label">Биография</label>
            <textarea id="biography" class="form-control" name="biography" placeholder="Введите биографию">
              </textarea>
          </div>
   <div class="col-12 d-flex">
            <div class="form-check m-auto">
              <label class="form-check-label" for="policyCheckBox">Ознакомлен(а)</label>
              <input class="form-check-input" type="checkbox" id="policyCheckBox"
                     name="policyCheckBox">
            </div>
          </div>
  <div class="col-12 d-flex">          
            <input type="submit" id="submitBtn" class="btn btn-success m-auto" value="Отправить">
          </div>
        </form>
<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body d-flex p-0">
        <h1>Спасибо, результаты сохранены.</h1>
      </div>
    </div>
  </div>
</div>
 
