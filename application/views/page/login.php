<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <link rel="shortcut icon" href="#"> 
  <title><?php echo $this->config->item('product_name')." | "."login"; ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url('assets/login_new/css/normalize.min.css')?>">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/v4-shims.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/login_new/css/style.css');?>">

</head>

<body style="padding-top:50px;">
  <a style="magin:0 auto;display:block;text-align: center;" href="<?php echo site_url();?>" ><img style="max-width: 200px;" src="<?php echo base_url();?>assets/images/logo-trans.png" alt="<?php echo $this->config->item('product_name');?>" class="img-responsive center-block"></a>
  <div class="logmod">
  <div class="logmod__wrapper">
    <?php 
            if($this->session->flashdata('login_msg')!='') 
            {
                echo "<div class='alert alert-danger text-center'>"; 
                    echo $this->session->flashdata('login_msg');
                echo "</div>"; 
            }   
           
		 echo $this->session->flashdata('login_msg');
          ?>
  

    <span class="logmod__close"><?php echo "close"; ?></span>
    <div class="logmod__container">
      <ul class="logmod__tabs">
        <li data-tabtar="lgm-2"><a href=""><i class="fa fa-sign-in-alt"></i> <?php echo "login"; ?></a></li>
        <li data-tabtar="lgm-1"><a href="<?php echo base_url('home/sign_up');?>"><i class="fa fa-user-circle"></i> <?php echo "sign up"; ?></a></li>
      </ul>
      <div class="logmod__tab-wrapper">
      <div class="logmod__tab lgm-2">
        <div class="logmod__heading">
       
          <br>

        </div> 
        <div class="logmod__form">
          <form accept-charset="utf-8" action="<?php echo site_url('home/sign_in_action');?>" method="post" class="simform">
            <div class="sminputs">
              <div class="input full">
                <label class="string optional" for="user-email"><?php echo "email"; ?> *</label>
                <input class="string optional" required name="username" id="user-email" placeholder="" type="email" autofocus="yes" />
              </div>
            </div>
            <div class="sminputs">
              <div class="input full">
                <label class="string optional" for="user-pw"><?php echo "password"; ?> *</label>
                <input class="string optional" required name="password" id="user-pw" placeholder="" type="password" />
                <span class="hide-password"><i class="fa fa-eye"></i></span>
              </div>
            </div>
            <div class="simform__actions">
              <div class="special-con"><a class="special" role="link" href="#"><?php echo "Forgot your password?"; ?><br><?php echo "Click here"; ?></a></div>
              <button class="sumbit" name="commit" type="submit"><i class="fa fa-sign-in-alt"></i> <?php echo "login"; ?></button>
            </div> 
          </form>
        </div> 
        
        </div>
      </div>
    </div>
  </div>
</div>
<script src="<?php echo base_url('assets/login_new/js/jquery.min.js');?>"></script>
<script  src="<?php echo base_url('assets/login_new/js/index.js');?>"></script>



</body>

</html>
