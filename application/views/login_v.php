<div id="contain_login" class="login" style="width:35%;margin-left:35%;margin-top:3%;font-size:100%;" >
<h2 style="background-color:green"><i style="margin-right: 0.5em;" class="icon-user"></i>Login</h2>	
<?php 

echo form_open('User_management/submit'); ?>
<div id="login" class="" >

<div class="form-group" style="margin-top: 2.3em;">
<label for="exampleInputEmail1">Email address</label>
<input type="text" class="form-control input-lg" name="username" id="username" placeholder="Enter email" required="required">
</div>
<div class="form-group" style="margin-bottom: 2em;">
<label for="exampleInputPassword1">Password</label>
<input type="password" class="form-control input-lg" name="password" id="password" placeholder="Password" required="required">
</div>
<div style="padding-bottom:10px;">
<input type="submit" class="btn btn-primary btn-lg" name="register" id="register" value="Log in">

<a class="" style="margin-left: 2%;margin-top: 2%;" href="<?php echo base_url().'user_management/forget_pass'?>" id="modalbox">Can't access your account ?</a>
</div>

</div>
<?php 
	echo form_close();
?>
</div>
<style type="text/css">
  #contain_logo h2{
    font-size: 16px;
  }
</style>
