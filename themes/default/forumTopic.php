<div class='text-right'>
  <a href='<?php echo $site_dir; ?>/?act=newpost&id=<?php echo $topic_id; ?>' class='btn btn-primary'>New Reply</a>
</div>
<br />
<div class='panel panel-default'>
  <div class='panel-heading'>
    <?php echo $topic_name; ?>
  </div>
  <table class='table'>
    <?php foreach($posts as $post) { ?>
    <tr>
      <td></td>
      <td>
        <?php echo $post["b"]; ?>
      </td>
    </tr>
    <?php } ?>
  </table>
</div>