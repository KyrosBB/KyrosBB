<!DOCTYPE html>
<html lang='en'>
  <head>
    <title><?php echo $site_name; ?></title>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'>
  </head>
  <body>
    <div class='navbar navbar-default navbar-static-top'>
      <div class='container'>
        <div class='navbar-heading'>
          <a href='<?php echo $site_dir; ?>' class='navbar-brand'>
            <?php echo $site_name; ?>
          </a>
        </div>
      </div>
    </div>
    <div class='container'>
      <div class='row'>
        <div class='col-md-3'>
          <a class='btn btn-primary btn-block' href='<?php echo $site_dir; ?>?act=newtopic'>
            New Topic
          </a>
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
            Powered by <a href='http://www.avestri.co'>KyrosBB</a> v0.1.0
          </div>
        </div>
      </div>
    </div>
  </body>
</html>