<body class="default-bg">
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
                <li><a href="<?= $adminUrl ?>home/index.php"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="<?= $adminUrl ?>products/list.php"><i class="fa fa-list-alt"></i> Products</a></li>
                 <li><a href="<?= $adminUrl ?>orders/list.php"><i class="fa fa-shopping-bag"></i> Orders</a></li>
               
          
              
               
              </ul>
             
              <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Admin <b class="caret"></b></a>
                      <ul class="dropdown-menu">
                        <li><a href="<?= $shopUrl ?>logout.php"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
                      </ul>
                </li>
              </ul>
            </div>
          </div>
    </div>
</nav>