<form action="" method="POST">
  <input name="fio" />
  <select name="year">
    <?php 
    for ($i = 1922; $i <= 2022; $i++) {
      printf('<option value="%d">%d год</option>', $i, $i);
    }
    ?>
  </select>
  
  <input type="radio"  select name="gender" id="sex1" value="1"> Female
  <input type="radio"  select name="gender" id="sex1" value="0"> Male
  <input type="submit" value="ok" />
</form>
