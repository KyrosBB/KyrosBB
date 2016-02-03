<form action='<?php echo $site_dir; ?>/' method='post'>
  <input type='hidden' name='act' value='login'>
  <div class='panel panel-default'>
    <div class='panel-heading'>
      Log In
    </div>
    <div class='panel-body'>
      <div class='form-group'>
        <label for='inputUsername'>Username:</label>
        <input type='text' class='form-control' id='inputUsername' name='inputUsername'>
      </div>
      <div class='form-group'>
        <label for='inputUsername'>Password:</label>
        <input type='text' class='form-control' id='inputPassword' name='inputPassword'>
      </div>
    </div>
    <div class='panel-footer text-center'>
      <button type='submit' class='btn btn-primary'>Submit</button>
    </div>
  </div>
</form>