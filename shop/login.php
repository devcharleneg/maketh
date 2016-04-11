<?php 
$rootDir = $_SERVER['DOCUMENT_ROOT'] . '/maketh/';
include($rootDir . 'templates/header.php');
include($templatesDir . 'nav.php');
?>


<?php 
    $auth = "";
    $username = "";
    if(isset($_POST['login']))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $q = mysqli_query($mysqli,"SELECT * FROM user WHERE BINARY username ='{$username}' AND BINARY password = '{$password}'");
        if(mysqli_num_rows($q) > 0)
        {
            $user = mysqli_fetch_assoc($q);
            if($user['access_type'] == 'admin')
            { 
                $_SESSION['loggedin'] = 'admin';
            }
            if($user['access_type'] == 'customer')
            {
                $_SESSION['loggedin'] = 'customer';
                $_SESSION['username'] = $username;
            }
            echo "<script>window.location = '/maketh/shop/';</script>";
        }
        else
        {
            $auth = 'incorrect';
        }
    }
?>


<body class="login-bg">
<div class="container" style="margin-top:50px;">
    <div class="col-sm-4 col-sm-offset-4">
      <div class="panel panel-default">
      <div class="panel-heading"><h3 class="panel-title">Maketh Apparel Online Shop</h3>
    
      </div>
      
      <div class="panel-body" style="background: white">
            <form action="login.php" role="form" method="POST">
              
            <div style="margin-bottom: 12px" class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input id="login-username" type="text" class="form-control" name="username" value="<?= $username ?>" required placeholder="Username">                                        
            </div>
                                          
            <div style="margin-bottom: 12px" class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input id="login-password" type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
                                              
            <div class="alert alert-danger" id="authError">
                <a class="close" data-dismiss="alert" href="#">×</a>Incorrect Username or Password!
            </div>
            <button type="submit" class="btn btn-primary btn-lg btn-block" name="login">Login</button>
            <p>Not yet registered? Register an account <a href="register.php">here</a></p>
      
          </form>

    </div>
                                        
              
    <br>
      </div>
    </div>
    </div>
</div>
<script>
  $(document).ready(function(){
      $('#authError').hide();
      var naglogin = "<?= $auth ?>";
      if(naglogin == 'incorrect')
      {
          $('#authError').show();
      }
      else
      {
          $('#authError').hide();
      }
  });
</script>


<?php include($templatesDir . 'footer.php'); ?>