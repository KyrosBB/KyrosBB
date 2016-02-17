<!DOCTYPE html>
<html lang='en'>
  <head>
    <title><?php echo $site_name; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'>
    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <link rel='stylesheet' href='themes/default/extra.css'>
  </head>
  <body>
    <div class='navbar navbar-default navbar-static-top'>
      <div class='container'>
        <div class='navbar-header'>
          <a href='<?php echo $site_dir; ?>' class='navbar-brand'>
            <?php echo $site_name; ?>
          </a>
        </div>
        <ul class='nav navbar-nav navbar-right hidden-xs'>
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
    <div class='user-xs visible-xs-block'>
      <div class='container'>
<?php
  if($user->id !== 0) {
?>
        <div class='pull-left'>
          <?php echo $user->username; ?>
        </div>
        <div class='pull-right'>
          <a href='<?php echo $site_dir; ?>?act=login'>Log Out</a>
        </div>
<?php
  } else {
?>
        <div class='pull-left'>
          <?php echo $user->username; ?>
        </div>
        <div class='pull-right'>
          <a href='<?php echo $site_dir; ?>?act=login'>Log In</a> &middot;
          <a href='<?php echo $site_dir; ?>?act=register'>Register</a>
        </div>s
<?php
  }
?>
        
        
      </div>
    </div>
    <div class='container'>
      <div class='row'>
<?php if($sidebar) { ?>
        <div class='col-md-3 hidden-xs'>
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
        <div class='col-md-9 col-xs-12'>
<?php } else { ?>
        <div class='col-xs-12'>
<?php } ?>
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
          <div class='visible-xs-block text-right xs-buttons'>
            <?php echo $kyros->theme->macros->xs_nt_button(); ?>
          </div>
          <?php echo $content; ?>
        </div>
      </div>
      <div class='row'>
        <div class='col-xs-12'>
          <div class='copyright'>
            Powered by <a href='http://www.avestri.co'>KyrosBB</a> <?php echo $kyros->version; ?>
          </div>
        </div>
      </div>
    </div>
    <script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
  </body>
</html>