<form action="" method="POST">
  <fieldset>
  <div class="form-row">
  <label for="name">Ваше имя</label><input type="text" id="name" required>
</div>
  <div class="form-row">
<label for="email">Ваш Email</label><input type="email" id="email" required>
</div>
  <select name="year">
	   
    <?php 
    for ($i = 1922; $i <= 2022; $i++) {
      printf('<option value="%d">%d год</option>', $i, $i);
    }
    ?>
  </select>
    <p>Пол<br><br>
                    <label><input type="radio" name="radio-gender" value="man">Мужской</label>
                    <label><input type="radio" name="radio-gender" value="woman">Женский</label>
                </p>
   <p>Количество конечностей<br><br>
                    <label><input type="radio" name="radio-numlimbs" value="1">1</label>
                    <label><input checked type="radio" name="radio-numlimbs" value="2">2</label>
                    <label><input type="radio" name="radio-numlimbs" value="4">4</label>
                    <label> <input type="radio" name="radio-numlimbs" value="8">8</label>
                    <label> <input type="radio" name="radio-numlimbs" value="16">16</label>
                </p>
  <p>
                    <label>Сверхспособности<br><br>
                        <select multiple name="super-powers">
                            <option value="pizza">Летать</option>
                            <option selected value="sleep">Телепатия</option>
                            <option value="concentration">Безнаказанный пропуск пар</option>
                        </select>
                    </label>
                </p>
  <div>
                    <p>
                        <label>Биография<br><br>
                            <textarea placeholder="Расскажите о себе" name="user-biography" id="biography"></textarea>
                        </label>
                    </p>
                </div>
                <p>
                    <label>
                            <input type="checkbox" name="user-agree" value="true">Ознакомлен(а)
                    </label>
                </p>
		    
                <p>
                    <input type="submit" value="Отправить">
                </p>
  </fieldset>
</form>
