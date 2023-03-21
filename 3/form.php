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
  <input  type="radio" select name="limbs" id="limb1" value="2"> 2
  <input  type="radio" select name="limbs" id="limb2" value="3"> 3
  <input  type="radio" select name="limbs" id="limb3" value="5"> 5
  <input  type="radio" select name="limbs" id="limb4" value="8"> 8
  <select name="biography">
  <input type="submit" value="ok" />
  
  
</form>
