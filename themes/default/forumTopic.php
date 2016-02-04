<div class='text-right'>
  <a href='<?php echo $site_dir; ?>?act=reply&id=<?php echo $topic_id; ?>' class='btn btn-primary'>New Reply</a>
</div>
<br />
<div class='panel panel-default'>
  <div class='panel-heading'>
    <?php echo $topic_name; ?>
  </div>
  <table class='table'>
    <?php foreach($posts as $post) { ?>
    <tr>
      <td class='col-md-2 text-center'>
<?php
  if($post["author"]->avatar_type == 1) {
    echo $post["author"]->get_gravatar(75,array("class"=>"img-thumbnail"));
  }
?>
        <br />
        <?php echo $post["author"]->username; ?>
      </td>
      <td class='col-md-10'>
        <?php echo $post["b"]; ?>
      </td>
    </tr>
    <?php } ?>
  </table>
</div>