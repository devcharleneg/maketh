<?php 
$username = "";
$admin_imgs = $db->get('homepage_image');
?>
<body class="login-bg">
<div class="container" style="margin-top:50px;">
    <?php include($templatesDir . 'left_nav.php'); ?>

    <div class="col-sm-9">
          <div class="row">
                 <div id="carousel-id" class="carousel slide" data-ride="carousel">
                   <ol class="carousel-indicators">
                          
                     <li data-target="#carousel-id" data-slide-to="0" class="active"></li>
                     <?php for ($c = 1; $c < count($admin_imgs); $c++): ?>
                        <li data-target="#carousel-id" data-slide-to="<?= $c ?>"></li>
                     <?php endfor ?>
                     
       
                   </ol>
                   <div class="carousel-inner" style="width: 900px;height:500px">
                    
                     <?php for($l = 0; $l < count($admin_imgs); $l++): ?>
                            <?php if ($l == 0): ?>
                                <div class="item active">
                            <?php else: ?>
                                   <div class="item">
                            <?php endif ?>
                             
                                   <img src="<?= base_url() . 'shop/uploads/' . $admin_imgs[$l]['homepage_image'] ?>" width="850" height="400" >

                                   <div class="container">
                                     <div class="carousel-caption">
                                     <!--   <h1>Example headline.</h1>
                                       <p>Note: If you're viewing this page via a <code>file://</code> URL, the "next" and "previous" Glyphicon buttons on the left and right might not load/display properly due to web browser security rules.</p>
                                       <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p> -->
                                     </div>
                                   </div>
                              </div>
                           
                            
                     <?php endfor ?>
                  
                    
                   </div>
                   <a class="left carousel-control" href="#carousel-id" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
                   <a class="right carousel-control" href="#carousel-id" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
                 </div>
          </div>
    </div> <!-- column products -->
</div><!-- main container -->

