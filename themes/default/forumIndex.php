<div class='panel panel-default'>
  <div class='panel-heading'>
    Topics
  </div>
  <ul class='list-group'>
<?php foreach($topics as $topic) { ?>
    <li class='list-group-item'>
      <div class='row'>
        <div class='col-md-7'>
          <a href='<?php echo $site_dir; ?>?act=ST&id=<?php echo $topic["id"]; ?>'>
            <strong><?php echo $topic["name"]; ?></strong>
          </a>
          by
          <?php echo $topic["author"]->username; ?>
        </div>
        <div class='col-md-5'>
        </div>
      </div>
    </li>
<?php } ?>
  </ul>
</div>