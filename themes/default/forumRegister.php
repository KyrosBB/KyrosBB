<?php
  if($message) {
?>
<div class='alert alert-danger text-center'>
  <?php echo $message; ?>
</div>
<?php
  }
?>
<form action='<?php echo $site_dir; ?>' method='post'>
  <input type='hidden' name='act' value='register'>
  <div class='panel panel-default'>
    <div class='panel-heading'>
      Registration
    </div>
    <div class='panel-body'>
      <div class='form-group'>
        <label for='inputUsername'>Username:</label>
        <input type='text' class='form-control' id='inputUsername' name='inputUsername'>
      </div>
      <div class='form-group'>
        <label for='inputEmail'>Email:</label>
        <input type='email' class='form-control' id='inputEmail' name='inputEmail'>
      </div>
      <div class='form-group'>
        <label for='inputPassword'>Password:</label>
        <input type='password' class='form-control' id='inputPassword' name='inputPassword'>
      </div>
      <div class='form-group'>
        <label for='inputPassword2'>Confirm Password:</label>
        <input type='password' class='form-control' id='inputPassword2' name='inputPassword2'>
      </div>
    </div>
    <div class='panel-footer text-center'>
      <button type='submit' class='btn btn-primary'>Submit</button>
    </div>
  </div>
</form>