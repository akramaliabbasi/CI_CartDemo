<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <link rel="shortcut icon" href="#"> 
  <title><?php echo $this->config->item('product_name')." | ".$page_title; ?></title>
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
  

    <span class="logmod__close"><?php echo "close"; ?></span>
    <div class="logmod__container">
      <ul class="logmod__tabs">
        <li data-tabtar="lgm-2"><a href=""><i class="fa fa-user-circle"></i> <?php echo "sign up"; ?></a></li>
        <li data-tabtar="lgm-1"><a href="<?php echo base_url('home/login');?>"><i class="fa fa-sign-in-alt"></i> <?php echo "login"; ?></a></li>
      </ul>
      <div class="logmod__tab-wrapper">
      <div class="logmod__tab lgm-2">
        <div class="logmod__heading">
		  <?php 
            if($this->session->flashdata('login_msg')!='') 
            {
                echo "<div class='alert alert-danger text-center'>"; 
                    echo $this->session->flashdata('login_msg');
                echo "</div>"; 
            }   
            if($this->session->flashdata('reset_success')!='') 
            {
                echo "<div class='alert alert-success text-center'>"; 
                    echo $this->session->flashdata('reset_success');
                echo "</div>"; 
            } 
            if($this->session->userdata('reg_success') != ''){
              echo '<div class="alert alert-success text-center">'.$this->session->userdata("reg_success").'</div>';
              $this->session->unset_userdata('reg_success');
            }  
            if($this->session->userdata('jzvoo_success') != ''){
              echo '<div class="alert alert-success text-center">'.$this->lang->line("your account has been created successfully. please login.").'</div>';
              $this->session->unset_userdata('jzvoo_success');
            }     
            if(form_error('username') != '' || form_error('password')!="" ) 
            {
              $form_error="";
              if(form_error('username') != '') $form_error.=form_error('username');
              if(form_error('password') != '') $form_error.=form_error('password');
              echo "<div class='alert alert-danger text-center'>".$form_error."</div>";
             
            }     
          ?>
        </div> 
        <div class="logmod__form">
          <form accept-charset="utf-8" action="<?php echo site_url('home/sign_up_action');?>" method="post" class="simform">
            <div class="sminputs">
              <div class="input full">
                <label class="string optional" for="user-name"><?php echo "name"; ?> *</label>
                <input class="string optional" required name="name" id="user-name" placeholder="" type="text" autofocus="yes" value="<?php echo set_value('name');?>" />
              </div>
            </div>

            <div class="sminputs">
              <div class="input full">
                <label class="string optional" for="mobile-no"><?php echo "mobile"; ?></label>
                <input class="string optional" required name="mobile" id="mobile" placeholder="" type="text" autofocus="yes" value="<?php echo set_value('mobile');?>" />
              </div>
            </div>
        
            <div class="sminputs">
              <div class="input full">
                <label class="string optional" for="user-email"><?php echo "email"; ?> *</label>
                <input class="string optional" required name="email" id="user-email" placeholder="" type="email" value="<?php echo set_value('email');?>"/>
              </div>
            </div>
            <div class="sminputs">
              <div class="input string optional">
                <label class="string optional" for="user-pw"><?php echo "password"; ?> *</label>
                <input class="string optional" required id="user-pw" name="password" placeholder="" type="password" value="<?php echo set_value('password');?>"/>
              </div>
              <div class="input string optional">
                <label class="string optional" for="user-pw-repeat"><?php echo "confirm password";?> *</label>
                <input class="string optional" required id="user-pw-repeat" name="confirm_password" placeholder="" type="password" value="<?php echo set_value('confirm_password');?>"/>
              </div>
            </div>
           
            <div class="simform__actions">
              <button class="sumbit" id="sign_up_button" style="width:100%" name="commit" type="submit"><i class="fa fa-user-circle"></i> <?php echo "sign up"; ?></button>
            </div> 
          </form>
        </div> 
        <div class="logmod__alter">
        <br>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="<?php echo base_url('assets/login_new/js/jquery.min.js');?>"></script>
<script  src="<?php echo base_url('assets/login_new/js/index.js');?>"></script>


</body>

</html>
