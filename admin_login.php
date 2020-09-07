<?php
  include_once(dirname(__FILE__) ."/admin_login.controller.php");
  
  $controller = new AdminLoginController();
  $vd = $controller->Execute();
?>
<?php print '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
      <title><?php print _SITE_TITLE; ?></title>
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
  <link rel="stylesheet" href="style.css?v=<?php print DOMA_VERSION; ?>" type="text/css" />
  <link rel="stylesheet" href="main.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="gfx/favicon.png" />
  <link rel="alternate" type="application/rss+xml" title="RSS" href="rss.php" />
  <script type="text/javascript" src="js/jquery/jquery-1.7.1.min.js"></script>
  <script src="js/common.js?v=<?php print DOMA_VERSION; ?>" type="text/javascript"></script>
  <?php if($vd["OverviewMapData"] != null) { ?>
    <script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;language=<?php print Session::GetLanguageCode(); ?>" type="text/javascript"></script>
    <script src="js/overview_map.js?v=<?php print DOMA_VERSION; ?>" type="text/javascript"></script>
    <script type="text/javascript">
      <!--
        var overviewMapData = <?php print json_encode($vd["OverviewMapData"]); ?>;        
      -->
    </script>
  <?php } ?>  
  <script type="text/javascript" src="js/users.js?v=<?php print DOMA_VERSION; ?>"></script>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" href="main.css" />
    <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
  </head>

<body id="adminLoginBody">
<?php Helper::CreateTopbar(); ?>
<div id="wrapper">
<div id="content">
<form class="wide" method="post" action="<?php print $_SERVER["PHP_SELF"]?>">

<h1><?php print __("ADMIN_LOGIN")?></h1>

<p><?php print __("ADMIN_LOGIN_INFO")?></p>

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
                  <div class="container">
                    <div class="column">
                      <div class="six columns"><input type="text" name="username" id="username" placeholder="<?php print __("USERNAME")?>" /></div>
                      <div class="six columns"><input type="password" name="password" id="password" placeholder="<?php print __("PASSWORD")?>" /></div>
                    </div>
                    
                    <div class="column">
                      <div class="twelve columns">
                        <ul class="actions">
                          <li><input type="submit" class="special" name="login" value="<?php print __("LOGIN")?>" /></li>
                          <li><input type="submit" class="special" name="cancel" value="<?php print __("CANCEL")?>" /></li>
                        </ul>
                      </div>
                    </div>
                  </div>


</form>
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