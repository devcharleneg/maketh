<?php 
$db->join('product p','p.item_code = c.item_code');
$db->where('username',$_SESSION['username']);
$cart_items = $db->get('cart c',null,'*');
$no_of_items_in_cart = count($cart_items);
?>
<body>
<nav class="navbar navbar-default">
  <div class="container">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?= base_url() ?>/index.php">
              <img src="<?= base_url(); ?>assets/img/logo.png" class="img-responsive" style="margin-top: -10px"  width='100px' height='100px' alt="Maketh">
          </a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
          <ul class="nav navbar-nav">
                  <li><a href="<?= $shopUrl ?>"><i class="fa fa-home"></i> Home</a></li>
                  <li class="dropdown">
                    <a href="/maketh/shop/customer/list.php?sex=Men" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-mars"></i> Men <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      <li><a href="/maketh/shop/customer/list.php?sex=Men">MEN</a></li>
                      <li><a href="/maketh/shop/customer/list.php?cat=Top&sex=Men">TOP</a></li>
                        <li><a href="/maketh/shop/customer/list.php?subcat=T-Shirts&sex=Men"><span style="margin-left: 15%"></span>T-Shirts</a></li>
                        <li><a href="/maketh/shop/customer/list.php?subcat=Polo&sex=Men"><span style="margin-left: 15%"></span>Polo</a></li>
                        <li><a href="/maketh/shop/customer/list.php?subcat=Longsleeves&sex=Men"><span style="margin-left: 15%"></span>Longsleeves</a></li>
                      <li role="separator" class="divider"></li>
                       <li><a href="/maketh/shop/customer/list.php?cat=Bottom&sex=Men">BOTTOM</a></li>
                        <li><a href="/maketh/shop/customer/list.php?subcat=Short&sex=Men"><span style="margin-left: 15%"></span>Short</a></li>
                        <li><a href="/maketh/shop/customer/list.php?subcat=Pants&sex=Men"><span style="margin-left: 15%"></span>Pants</a></li>
                      <li role="separator" class="divider"></li>
                       <li><a href="/maketh/shop/customer/list.php?cat=Bag&sex=Men">BAG</a></li>
                        <li><a href="/maketh/shop/customer/list.php?subcat=Backpack&sex=Men"><span style="margin-left: 15%"></span>Backpack</a></li>
                        <li><a href="/maketh/shop/customer/list.php?subcat=Sling Bag&sex=Men"><span style="margin-left: 15%"></span>Sling Bag</a></li>
                        <li><a href="/maketh/shop/customer/list.php?subcat=Shoulder Bag&sex=Men"><span style="margin-left: 15%"></span>Shoulder Bag</a></li>
                        <li><a href="/maketh/shop/customer/list.php?subcat=Wallet&sex=Men"><span style="margin-left: 15%"></span>Wallet</a></li>
                    </ul>
                  </li><!-- navbar men categories -->

                  <li class="dropdown">
                    <a href="/maketh/shop/customer/list.php?sex=Women" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-venus"></i> Women <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="/maketh/shop/customer/list.php?sex=Women">WOMEN</a></li>
                        <li><a href="/maketh/shop/customer/list.php?cat=Top&sex=Women">TOP</a></li>
                        <li><a href="/maketh/shop/customer/list.php?subcat=T-Shirts&sex=Women"><span style="margin-left: 15%"></span>T-Shirts</a></li>
                        <li><a href="/maketh/shop/customer/list.php?subcat=Polo&sex=Women"><span style="margin-left: 15%"></span>Polo</a></li>
                        <li><a href="/maketh/shop/customer/list.php?subcat=Longsleeves&sex=Women"><span style="margin-left: 15%"></span>Longsleeves</a></li>
                      <li role="separator" class="divider"></li>
                       <li><a href="/maketh/shop/customer/list.php?cat=Bottom&sex=Women">BOTTOM</a></li>
                        <li><a href="/maketh/shop/customer/list.php?subcat=Short&sex=Women"><span style="margin-left: 15%"></span>Short</a></li>
                        <li><a href="/maketh/shop/customer/list.php?subcat=Pants&sex=Women"><span style="margin-left: 15%"></span>Pants</a></li>
                      <li role="separator" class="divider"></li>
                       <li><a href="/maketh/shop/customer/list.php?cat=Bag&sex=Women">BAG</a></li>
                        <li><a href="/maketh/shop/customer/list.php?subcat=Backpack&sex=Women"><span style="margin-left: 15%"></span>Backpack</a></li>
                        <li><a href="/maketh/shop/customer/list.php?subcat=Sling Bag&sex=Women"><span style="margin-left: 15%"></span>Sling Bag</a></li>
                        <li><a href="/maketh/shop/customer/list.php?subcat=Shoulder Bag&sex=Women"><span style="margin-left: 15%"></span>Shoulder Bag</a></li>
                        <li><a href="/maketh/shop/customer/list.php?subcat=Wallet&sex=Women"><span style="margin-left: 15%"></span>Wallet</a></li>
                    </ul>
                  </li><!-- navbar men categories -->

                  <li>
                        <form action="/maketh/shop/customer/list.php" class="navbar-form navbar-left form-inline" role="form">
                            <div class="form-group">
                              <input type="text" class="form-control" name="q" id="navbar-search" placeholder="Search Products or Brands" value="<?php if(isset($_GET['q'])) echo $_GET['q'] ?>">
                              <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                  </li>
                  <!-- navbar search form -->
          </ul><!-- navbar nav left -->
         
          <ul class="nav navbar-nav navbar-right">
              <li><a href="<?= $customerUrl ?>cart.php"><span class="badge"><?= $no_of_items_in_cart ?> </span> <i class="fa fa-shopping-cart"></i> Cart</a></li>
              <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?= $_SESSION['username'] ?> <b class="caret"></b></a>
                      <ul class="dropdown-menu">
                        <li><a href="<?= $shopUrl ?>logout.php"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
                      </ul>
                </li>
          </ul><!-- navbar nav right -->

        </div><!-- collapse navbar -->
      </div><!-- container fluid -->
  </div><!-- container -->
</nav>

