<?php 
$rootDir = $_SERVER['DOCUMENT_ROOT'] . '/maketh/';
include($rootDir . 'templates/header.php');
include($templatesDir . 'nav.php');



     $months = array(
        'Jan',
        'Feb',
        'Mar',
        'Apr',
        'May',
        'Jun',
        'Jul',
        'Aug',
        'Sep',
        'Oct',
        'Nov',
        'Dec'
      );
     $monthno = 1;


?>



<body class="login-bg">
<div class="container" style="margin-top:50px;">
    <div class="row">
          <div class="col-sm-6 col-sm-offset-3">
                    <form method="POST" role="form" class="well" name="registerForm" id="registerForm">
                      <legend>Customer Registration</legend>
                            <div class="row">
                                <div class="col-sm-4">
                                         <div class="form-group">
                                              <label for="">First Name</label>
                                              <input type="text" class="form-control" name='fname' placeholder='First name' value='' required>
                                          </div><!-- first name -->
                                </div><!-- col first name -->
                                <div class="col-sm-4">
                                          <div class="form-group">
                                              <label for="">Middle Name</label>
                                              <input type="text" class="form-control" name='mname' placeholder='Middle name' value='' required>
                                          </div><!-- product name -->
                                </div><!-- col lastname -->
                                <div class="col-sm-4">
                                          <div class="form-group">
                                              <label for="">Last Name</label>
                                              <input type="text" class="form-control" name='lname' placeholder='Lastname' value='' required>
                                          </div><!-- product name -->
                                </div><!-- col lastname -->
                            </div>

                            <div class="row">
                              <div class="col-sm-9">
                                    <label for="username" class="control-label">Birthday</label>
                                    <div class="row">
                                      <div class="col-xs-4">
                                            <select  id="month" class="form-control" required>
                                                  <?php foreach ($months as $month):?>
                                                  <?php if($monthno < 10): ?>
                                                            <option value="<?= '0'. $monthno;?>"><?= $month ?></option>
                                                        <?php else: ?>
                                                          <option value="<?= $monthno;?>"><?= $month ?></option>
                                                        <?php endif ?>
                                                         
                                                  <?php $monthno = $monthno + 1 ?>
                                                  <?php endforeach;?>
                                            </select>         
                                      </div><!-- month -->

                                      <div class="col-xs-4">
                                            <select id="day"  class="form-control" required>
                                                  <?php for($i = 1; $i < 32; $i++):?>
                                                    <?php if($i < 10): ?>
                                                      <option value="<?= '0'. $i;?>"><?= $i ?></option>
                                                    <?php else: ?>
                                                    <option value="<?= $i;?>"><?= $i ?></option>
                                                    <?php endif ?>
                                                    
                                                <?php endfor;?>
                                            </select>
                                      </div><!-- day -->

                                    <div class="col-xs-4">
                                            <select  id="year" class="form-control" required>
                                            <?php for($yr = 2001; $yr > 1989; $yr--):?>
                                                  <option value="<?= $yr;?>"><?= $yr ?></option>
                                            <?php endfor;?>
                                            </select>
                                    </div><!-- year -->

                                    
                                 </div><!-- row -->
                                <div class="alert alert-danger" id="ageError">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            You must be atleast 15 years old to register.
                                </div>
                              </div><!-- col birthday -->
                  


                              <div class="col-sm-3">
                                    <label for="username" class="control-label">Gender</label>
                                    <br>
                                     <select class="form-control" name="gender" ng-model="gender" style="margin-bottom: 10px" required>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                    </select>
                              </div><!-- col gender -->
                              
                           </div><!-- row -->
 

                            
                            <div class="form-group">
                                              <label for="">Address</label>
                                              <input type="text" class="form-control" name='address' placeholder='Enter your address' value='' id="address" required>
                            </div><!-- product name -->

                            <div class="row">
                                <div class="col-sm-6">
                                       <div class="form-group">
                                          <label for="">Contact No</label>
                                          <input type="text" class="form-control" name='contact_no' placeholder='Contact No' value='' maxlength="20" required>
                                      </div><!-- product name -->
                                </div>
                                <div class="col-sm-6">
                                      <div class="form-group">
                                          <label for="">Email</label>
                                          <input type="email" class="form-control" name='email' placeholder='Enter your email address' value='' required id="email">
                                          <div class="alert alert-danger" id="emailError">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <span id="emailMsg"></span>
                                          </div>
                                      </div><!-- product name -->
                                </div>
                            </div>
                            
                            

                            <div class="row">
                                  <div class="col-sm-9">
                                        <div class="form-group">
                                              <label for="">Username</label>
                                              <input type="text" class="form-control" name='username' placeholder='Enter your username' value='' id="username" required>
                                              <div class="alert alert-danger" id="usernameError">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <span id="usernameMsg"></span>
                                              </div>
                                        </div><!-- product name -->
                                  </div>
                            </div>
  
                            <div class="row">
                                <div class="col-sm-6">
                                       <div class="form-group">
                                          <label for="">Password</label>
                                          <input type="password" class="form-control" name='password' placeholder='Enter your password' value='' id="password" required>
                                      </div><!-- product name -->
                                </div>
                                <div class="col-sm-6">
                                      <div class="form-group">
                                          <label for="">Confirm Password</label>
                                          <input type="password" class="form-control" name='confirm_password' placeholder='Confirm your password' value='' id="confirm_password" required>
                                          <div class="alert alert-danger" id="passwordMatchError">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                Passwords don't match
                                          </div>
                                      </div><!-- product name -->
                                </div>
                                
                            </div>
                            
                            <div class="row">

                                <div class="col-sm-4">
                                  <h5>Captcha</h5>
                                      <div style="background: #868686;color: white;height:39px;margin-top: -11px">
                                          <h3><b><span id="no1"></span> + <span id="no2"></span> = </b></h3>
                                      </div>
                                </div>

                                <div class="col-sm-3">
                                    <h5>Answer</h5>
                                    <input type="number" id="answer" class="form-control" value="" step="" required="required" title="">
                                </div>

                                <div class="col-sm-5">
                                    <div class="alert alert-danger" id="captchaError">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                          Incorrect answer to captcha. Please try again.
                                    </div>
                                </div>

                            </div>
                            <br>

                            <input type="submit" class="btn btn-md btn-success btn-block" value="Register Account" name="register" id="register"></input>
    
                            

                      </form>
          </div>
    </div>
</div>


<script src="<?= $shopUrl ?>maketh.js"></script>
<?php include($templatesDir . 'footer.php'); ?>

