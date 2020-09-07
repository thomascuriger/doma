<?php
  include_once(dirname(__FILE__) ."/users.controller.php");

  $controller = new UsersController();
  $vd = $controller->Execute();
?>
<!DOCTYPE HTML>
<html>
  <head>
      <title><?php print _SITE_TITLE; ?></title>
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
  <link rel="stylesheet" href="style.css?v=<?php print DOMA_VERSION; ?>" type="text/css" />
  <link rel="icon" type="image/png" href="gfx/favicon.png" />
  <link rel="alternate" type="application/rss+xml" title="RSS" href="rss.php" />
  <script src="js/common.js?v=<?php print DOMA_VERSION; ?>" type="text/javascript"></script>
  <?php if($vd["OverviewMapData"] != null) { ?>
   <script type="text/javascript">
      <!--
      $(function() { 
        var overviewMapData = <?php print json_encode($vd["OverviewMapData"]); ?>;        
        $("#overviewMap").overviewMap({ data: overviewMapData });
      });
      -->
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpemFmfr3qHdGs1X47APZYSIJxtWGYQQs&;language=<?php print Session::GetLanguageCode(); ?>" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery/jquery-1.7.1.min.js"></script>
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
    <link rel="stylesheet" href="font-awesome.min.css" />
    <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
  </head>
  <body id="usersBody">
<?php include_once("google_analytics.php") ?>
	<div id="wrapper">
    <!-- Header -->
      <?php Helper::CreateUserListTopbar(); ?>

    <!-- Wrapper -->
        <!-- Main -->
          <div id="main">
          	<!--
          	<article class="post">
          	<img src="styleandstuff/header.jpg" width="100%" />
								  <div id="overviewMapContainer">
    								<a id="hideOverviewMap" href="#">Hide overview map</a>
    								<a id="showOverviewMap" href="#">Show overview map</a>
  								  </div>
							</article> -->

            <!-- USER -->
                
          <?php

  $count = 0;
  $controller = new UsersController();
  $vd = $controller->Execute();
  foreach($vd["Users"] as $u)
  { 
  $count++;
  $url = ($u->Visible ? "index.php?". Helper::CreateQuerystring($u) : "");
  $nameLink = Helper::EncapsulateLink(hsc($u->FirstName ." ". $u->LastName), $url);
  $nameButton = Helper::EncapsulateButton(hsc($u->FirstName ." ". $u->LastName), $url);
  if(count($vd["Users"]) == 0)
  {
    print '<p>'. __("NO_USERS_CREATED");
    if(Helper::IsLoggedInAdmin()) print ' <a href="edit_user.php?mode=admin">'. __("CREATE_THE_FIRST_USER") .'</a>';
    print '</p>';
  }
  
  if(!Helper::IsLoggedInAdmin() && PUBLIC_USER_CREATION_CODE) print '<p>'. __("PUBLIC_CREATE_USER_INFO") .'</p>';
  if(count($vd["Users"]) > 0)
  {
       
          if(isset($vd["LastMapForEachUser"][$u->ID]))
    {
      $lastMap = $vd["LastMapForEachUser"][$u->ID];
      if($lastMap) 
      {
        $lastMapLink = '<a href="show_map.php?'. Helper::CreateQuerystring($u, $lastMap->ID) .'" class="thumbnailHoverLink">' . hsc($lastMap->Name).
                       '</a>';
        $lastMapRelevant = '<a href="show_map.php?'. Helper::CreateQuerystring($u, $lastMap->ID) .'" class="thumbnailHoverLink">';
        $lastMapDate = date(__("DATE_FORMAT"), Helper::StringToTime($lastMap->Date, true));
        $lastMapUpdated = date(__("DATETIME_FORMAT"), Helper::StringToTime($lastMap->LastChangedTime, true));
        $thumbnailImage = '<img src="'. Helper::GetThumbnailImage($lastMap) .'" alt="'. hsc($lastMap->Name)  .'" width="100%" />';
        $imglink = Helper::GetThumbnailImage($lastMap);
      }
    } ?> 
          
          <?php Helper::CreateMenuResponse($u); ?>
              <article class="post">
                <header>
                  <div class="title" style="z-index:5;">
                    <div style="position:absolute;padding-right:17em;z-index:-1;top:0;bottom:0;left:0;right:0;background:url(<?php print Helper::GetThumbnailImage($lastMap) ?>) center center;opacity:.4;width:100%;height:100%;background-clip:content-box;background-size:cover;"></div>
                   	<h2><?php print $lastMapLink ?></h2>
                  </div>
                  <div class="meta">
                    <time class="published"><?php print $lastMapDate?></time>
                  </div>
                </header>
                <footer>
	     						<ul class="actions">
			       				<li><?php print $nameButton ?></li>
                    <?php if(Helper::IsLoggedInAdmin()) { ?>
      <td><?php print ($u->Visible ? __("YES") : __("NO"))?></td>
      <td><a href="edit_user.php?mode=admin&amp;<?php print Helper::CreateQuerystring($u)?>"><?php print __("EDIT")?></a></td>
      <td><?php print $loginAsUserLink?></td>
      
      <?php } ?>
						    	</ul>
						      <ul class="stats">
					     			<li><b><a><?php print $u->NoOfMaps?> <?php print __("NO_OF_MAPS")?></a></b></li>
						    		<li><b><a><?php print __("UPDATED")?> <?php print $lastMapUpdated?></a></b></li>
						    	</ul>
					     	</footer>
              </article>
          
          <?php

           } ?>

          <?php } ?>
          </div>
 <section id="sidebar">
<?php
    if(count($vd["LastMaps"]) > 0)
    {
      ?>
							<h2><?php print __("LAST_MAPS")?></h2>
							<section>
								<div class="mini-posts">


								<!-- start latest maps -->
									<?php
								      $count = 0;
								      foreach($vd["LastMaps"] as $map)
								      {
								        $count++;
								        $url = "index.php?". Helper::CreateQuerystring($map->GetUser());
								        $nameLink = Helper::EncapsulateLink(hsc($map->GetUser()->FirstName ." ". $map->GetUser()->LastName), $url);    
								        $mapLink = '<a href="show_map.php?'. Helper::CreateQuerystring($map->GetUser(), $map->ID) .'" class="thumbnailHoverLink">'. 
								                   hsc($map->Name).
								                   '</a>';
                        $thumbnailLink = '"show_map.php?'. Helper::CreateQuerystring($map->GetUser(), $map->ID) .'"';
								        
								        $date = date(__("DATE_FORMAT"), Helper::StringToTime($map->Date, true));
								        $updated = date(__("DATETIME_FORMAT"), Helper::StringToTime($map->LastChangedTime, true));

								        $thumbnailImage = '<img src="'. Helper::GetThumbnailImage($map) .'" alt="'. hsc($map->Name)  .'" width="100%" />';
								        
								        ?>
								        <article class="mini-post">
											<header>
												<h3><?php print $mapLink?></h3>
												<time class="published"><?php print $date?></time>
												<?php print $nameLink?>
											</header>
											<a href=<?php print $thumbnailLink ?> class="image"><?php print $thumbnailImage?></a>
										</article>
								        <?php          
								      }
								    }
								    ?>

								</div>
							</section>

     
     </section> 
           
      </div>


    <!-- Scripts -->
      		<script src="assets/js/jquery.min.js"></script> 
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

  </body>
</html>

