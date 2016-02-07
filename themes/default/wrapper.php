<!DOCTYPE html>
<html lang='en'>
  <head>
    <title><?php echo $site_name; ?></title>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'>
    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
  </head>
  <body>
    <div class='navbar navbar-default navbar-static-top'>
      <div class='container'>
        <div class='navbar-header'>
          <a href='<?php echo $site_dir; ?>' class='navbar-brand'>
            <?php echo $site_name; ?>
          </a>
        </div>
        <ul class='nav navbar-nav navbar-right'>
<?php
  if($user->id !== 0) {
?>
          <li class='dropdown'>
            <a href='#' class='dropdown-toggle' data-toggle='dropdown'>
              <?php echo $user->username; ?> <span class='caret'></span>
            </a>
            <ul class='dropdown-menu'>
              <li>
                <a href='<?php echo $site_dir; ?>?act=login'>Log Out</a>
              </li>
            </ul>
          </li>
<?php
  } else {
?>
          <li class='dropdown'>
            <a href='#' class='dropdown-toggle' data-toggle='dropdown'>
              <?php echo $user->username; ?> <span class='caret'></span>
            </a>
            <ul class='dropdown-menu'>
              <li>
                <a href='<?php echo $site_dir; ?>?act=login'>Log In</a>
              </li>
              <li>
                <a href='<?php echo $site_dir; ?>?act=register'>Register</a>
              </li>
            </ul>
          </li>
<?php
  }
?>
        </ul>
      </div>
    </div>
    <div class='container'>
      <div class='row'>
        <div class='col-md-3'>
          <?php echo $admin_button; ?>
          <?php echo $topic_button; ?>
          <ol class='list-group'>
<?php
  foreach($categories as $cat) {
    if($user->permissions->view_category($cat->id) == "true") {
?>
          <li class='list-group-item'>
            <a href='<?php echo $site_dir; ?>?cat=<?php echo $cat->id; ?>'><?php echo $cat->name; ?></a>
          </li>
<?php
    }
  }
?>
          </ol>
          <?php $hooks->action("sidebar_end"); ?>
        </div>
        <div class='col-md-9'>
          <ol class='breadcrumb'>
            <li>
              <a href='<?php echo $site_dir; ?>'><?php echo $site_name; ?></a>
            </li>
            <?php foreach($breadcrumbs as $crumb) { ?>
            <?php if($crumb[0]) { ?>
            <li class='active'>
              <?php echo $crumb[2]; ?>
            </li>
            <?php } else { ?>
            <li>
              <a href='<?php echo $site_dir . $crumb[1]; ?>'><?php echo $crumb[2]; ?></a>
            </li>
            <?php } ?>
            <?php } ?>
          </ol>
          <?php echo $content; ?>
        </div>
      </div>
      <div class='row'>
        <div class='col-md-12'>
          <div class='text-right'>
            Powered by <a href='http://www.avestri.co'>KyrosBB</a> v0.5.0-dev
          </div>
        </div>
      </div>
    </div>
    <script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
  </body>
</html>