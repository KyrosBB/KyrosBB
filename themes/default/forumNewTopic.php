<form act='<?php echo $site_dir; ?>/' method='post'>
  <input type='hidden' name='act' value='newtopic'>
  <div class='panel panel-default'>
    <div class='panel-heading'>
      Posting new topic
    </div>
    <div class='panel-body'>
      <div class='form-group'>
        <label for='inputTitle'>Topic Title:</label>
        <input type='text' class='form-control' id='inputTitle' name='inputTitle'>
      </div>
      <div class='form-group'>
        <label for='inputContent'>Post Content:</label>
        <textarea class='form-control' id='inputContent' name='inputContent'></textarea>
      </div>
    </div>
    <div class='panel-footer text-center'>
      <button type='submit' class='btn btn-primary'>Submit</button>
    </div>
  </div>
</form>