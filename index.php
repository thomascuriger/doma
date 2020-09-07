<?php
  include_once(dirname(__FILE__) ."/include/main.php");
  include_once(dirname(__FILE__) ."/index.controller.php");
  include_once(dirname(__FILE__) ."/include/json.php");
  
  $controller = new IndexController();
  $vd = $controller->Execute();
?>
<?php print '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title><?php print __("PAGE_TITLE")?></title>
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="gfx/favicon.png" />
  <link rel="stylesheet" href="style.css?v=<?php print DOMA_VERSION; ?>" type="text/css" />
  <link rel="stylesheet" href="main.css" />
  <link rel="stylesheet" href="assets/css/font-awesome.min.css" />
  <link rel="alternate" type="application/rss+xml" title="RSS" href="rss.php?<?php print Helper::CreateQuerystring(getCurrentUser())?>" />
  <script type="text/javascript" src="js/jquery/jquery-1.7.1.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpemFmfr3qHdGs1X47APZYSIJxtWGYQQs&;language=<?php print Session::GetLanguageCode(); ?>" type="text/javascript"></script>
  <script src="js/overview_map.js?v=<?php print DOMA_VERSION; ?>" type="text/javascript"></script>
  
  <?php if($vd["DisplayMode"] == "overviewMap") { ?>
    <script type="text/javascript">
      <!--
      $(function() { 
        var overviewMapData = <?php print json_encode($vd["OverviewMapData"]); ?>;        
        $("#overviewMap").overviewMap({ data: overviewMapData });
      });
      -->
    </script>
  <?php } ?>
  <script src="js/index.js?v=<?php print DOMA_VERSION; ?>" type="text/javascript"></script>
  <script src="js/common.js?v=<?php print DOMA_VERSION; ?>" type="text/javascript"></script>
  </head>

<body id="indexBody">
<form method="get" action="<?php print $_SERVER["PHP_SELF"]?>?<?php print Helper::CreateQuerystring(getCurrentUser())?>">
<?php include_once("google_analytics.php") ?>
<?php Helper::CreateTopbar() ?>
<div id="wrapper">

    <div id="main">
    <article class="post">
      <?php
        if($vd["DisplayMode"] == "list") include("index_list.php");  
        if($vd["DisplayMode"] == "overviewMap") include("index_overview_map.php");  
      ?>
      <?php if(count($vd["Maps"]) == 0 && count($vd["YearsWithText"]) > 1) { ?>
            <p class="clear">
            <?php print __("NO_MATCHING_MAPS"); ?>
            </p>
          <?php } ?>
      <div class="clear"></div>
      </article>
      </div>
      <!--sidebar-->
      <section id="sidebar">
        
          <input type="hidden" name="user" value="<?php print getCurrentUser()->Username;?>"/>
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
          <div class="column">
            <div id="rssIcon"><a href="rss.php?<?php print Helper::CreateQuerystring(getCurrentUser())?>"><img src="gfx/rss.png" alt="<?php print __("RSS_FEED")?>" title="<?php print __("RSS_FEED")?>" /></a></div>
            <div id="intro">
              <h3><?php print __("CAPTION")?></h3>
              <p style="color:white;"><?php print nl2br(__("INTRO"))?></p>
              <div class="mini-post">
              <header>
                <div id="selectCategoryAndYear">
                  <?php 
                    if(count($vd["YearsWithText"]) < 2)
                    {
                      print __("NO_MAPS");
                    }
                    else
                    {
                    ?>
                    <div class="12u$">
                      <label class="choices" for="categoryID"><?php print __("SELECT_CATEGORY")?>:</label>
                      <select name="categoryID" id="categoryID">
                      <?php
                        foreach($vd["CategoriesWithText"] as $category)
                        {
                          print '<option value="'. $category->ID .'"'. ($vd["SearchCriteria"]["selectedCategoryID"] == $category->ID? ' selected="selected"' : '') .'>'. $category->Name .'</option>';
                        }
                      ?>
                      </select>
                    </div>
                    <div class="12u$">
                      <label class="choices" for="year"><?php print __("SELECT_YEAR")?>:</label>
                      <select name="year" id="year">
                      <?php
                        foreach($vd["YearsWithText"] as $year)
                        {
                          print '<option value="'. $year["value"] .'"'. ($vd["SearchCriteria"]["selectedYear"] == $year["value"] ? ' selected="selected"' : '') .'>'. $year["text"] .'</option>';
                        }
                      ?>
                      </select>
                    </div>
                    <div class="12u$">
                      <label class="choices" for="filter"><?php print __("SELECT_FILTER"); ?>:</label>
                      <input type="text" name="filter" id="filter" placeholder="type in & press enter"value="<?php print hsc($vd["SearchCriteria"]["filter"]); ?>"/>
                    </div>
                    <div class="12u$">
                      <?php if($vd["GeocodedMapsExist"]) { ?>
                        <label class="choices" for="displayMode"><?php print __("SELECT_DISPLAY_MODE"); ?>:</label>
                        <select name="displayMode" id="displayMode">
                          <option value="list"<?php if($vd["DisplayMode"] == "list") print ' selected="selected"'; ?>><?php print __("DISPLAY_MODE_LIST")?></option>
                          <option value="overviewMap"<?php if($vd["DisplayMode"] == "overviewMap") print ' selected="selected"'; ?>><?php print __("DISPLAY_MODE_OVERVIEW_MAP")?></option>
                        </select>
                      <?php } ?>
                    </div>
                  <?php } ?>
                </div>
              </header>
              </div>
            </div>
          </div>
          
          </form>
      </section>

</div>


<?php Helper::GoogleAnalytics() ?>

<!-- Scripts -->
          <!--  <script src="assets/js/jquery.min.js"></script> -->
      <script src="assets/js/skel.min.js"></script>
      <script src="assets/js/util.js"></script>
      <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
      <script src="assets/js/main.js"></script>
</body>
</html>