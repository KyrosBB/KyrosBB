<div class='panel panel-default'>
  <div class='panel-heading'>
    Topics
  </div>
  <ul class='list-group'>
<?php foreach($topics as $topic) { ?>
    <li class='list-group-item hidden-xs'>
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
    <li class='list-group-item visible-xs-block'>
      <div class='row'>
        <div class='col-xs-12'>
          <a href='<?php echo $site_dir; ?>?act=ST&id=<?php echo $topic["id"]; ?>'>
            <strong><?php echo $topic["name"]; ?></strong>
          </a>
        </div>
      </div>
      <div class='row row-fluid'>
        <div class='col-xs-6'>
          <?php echo $topic["author"]->username; ?>
        </div>
        <div class='col-xs-6 text-right'>
          <a href='<?php echo $site_dir; ?>?cat=<?php echo $topic["cat"]; ?>'>
            <div class='label label-default'>
              <?php echo $topic["cat_name"]; ?>
            </div>
          </a>
        </div>
      </div>
    </li>
<?php } ?>
  </ul>
</div>