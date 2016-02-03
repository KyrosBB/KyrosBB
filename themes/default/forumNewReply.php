<form action='<?php echo $site_dir; ?>' method='post'>
  <input type='hidden' name='act' value='reply'>
  <input type='hidden' name='id' value='<?php echo $topic_id; ?>'>
  <div class='panel panel-default'>
    <div class='panel-heading'>
      New reply to: <a href='<?php echo $site_dir; ?>?act=ST&id=<?php echo $topic_id; ?>'><?php echo $topic_name; ?></a>
    </div>
    <div class='panel-body'>
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