<?php
  include_once(dirname(__FILE__) ."/login.controller.php");

  $controller = new LoginController();
  $vd = $controller->Execute();
?>
<?php print '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <link rel="stylesheet" href="style.css?v=<?php print DOMA_VERSION; ?>" type="text/css" />
  <link rel="stylesheet" href="main.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
  <title><?php print (__("PAGE_TITLE") ." :: ". __("LOGIN"))?></title>
  <link rel="icon" type="image/png" href="gfx/favicon.png" />
  <script type="text/javascript" src="js/jquery/jquery-1.7.1.min.js"></script>
  <script src="js/common.js?v=<?php print DOMA_VERSION; ?>" type="text/javascript"></script>
</head>

<body id="loginBody">
<?php include_once("google_analytics.php") ?>
<?php Helper::CreateTopbar() ?>
<div id="wrapper">

<div id="content">
<form class="wide" method="post" action="<?php print $_SERVER["PHP_SELF"]?>?<?php print Helper::CreateQuerystring(getCurrentUser())?>">

<?php if(isset($_GET["action"]) && $_GET["action"] == "newPasswordSent") print '<p>'. sprintf(__("NEW_PASSWORD_SENT"), getCurrentUser()->Email) .'</p>'; ?>

<?php if(count($vd["Errors"]) > 0) { ?>
<ul class="error">
<?php
  foreach($vd["Errors"] as $e)
  {
    print "<li>$e</li>";
  }
?>
</ul>
<?php } ?>

      <section id="login">
                <div class="container">

                  <h3><?php print __("LOGIN")?></h3>
                  <form method="post" action="<?php print $_SERVER["PHP_SELF"]?>?<?php print Helper::CreateQuerystring(getCurrentUser())?>">

                  <?php if(isset($_GET["action"]) && $_GET["action"] == "newPasswordSent") print '<p>'. sprintf(__("NEW_PASSWORD_SENT"), getCurrentUser()->Email) .'</p>'; ?>

                  <?php if(count($vd["Errors"]) > 0) { ?>
                    <ul class="error">
                    <?php
                      foreach($vd["Errors"] as $e)
                    {
                      print "<li>$e</li>";
                    }
                    ?>
                    </ul>
                  <?php } ?>

                    <div class="row uniform">
                      <div class="6u 12u(xsmall)"><input type="text" name="username" id="username" placeholder="<?php print __("USERNAME")?>" /></div>
                      <div class="6u 12u(xsmall)"><input type="password" name="password" id="password" placeholder="<?php print __("PASSWORD")?>" /></div>
                    </div>
                    
                    <div class="row uniform">
                      <div class="12u">
                        <ul class="actions">
                          <li><input type="submit" class="special" name="login" value="<?php print __("LOGIN")?>" /></li>
                          <li><?php if(getCurrentUser()->Email) { ?> <input type="submit" class="special" name="forgotPassword" value="<?php print __("FORGOT_PASSWORD")?>" /> <?php } ?></li>
                          <li><input type="submit" class="special" name="cancel" value="<?php print __("CANCEL")?>" /></li>
                        </ul>
                      </div>
                    </div>
                  </form>
                </div>
              </section>
</div>
</div>
<!-- Scripts -->
      <script src="assets/js/jquery.min.js"></script>
      <script src="assets/js/jquery.scrollzer.min.js"></script>
      <script src="assets/js/jquery.scrolly.min.js"></script>
      <script src="assets/js/skel.min.js"></script>
      <script src="assets/js/util.js"></script>
      <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
      <script src="assets/js/main.js"></script>
</body>
</html>
