<?php 
//start session
session_start();
?>

<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="en">
<head>
<title><?= isset($PageTitle) ? $PageTitle : "Default Title"?>: eStore</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Electronic Store Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
	SmartPhone Compatible web template, free web designs for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
	function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<!-- Custom Theme files -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" /> 
<!-- //Custom Theme files -->
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<!-- js -->
<script src="js/jquery.min.js"></script> 
<!-- //js -->  
<!-- web fonts --> 
<link href='//fonts.googleapis.com/css?family=Glegoo:400,700' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!-- //web fonts --> 
<!-- for bootstrap working -->
<script type="text/javascript" src="js/bootstrap-3.1.1.min.js"></script>
<!-- //for bootstrap working -->
<!-- for bootstrap sweetalert -->
<link href="css/sweet-alert.css" rel="stylesheet"> 
<script type="text/javascript" src="js/sweet-alert.min.js"></script>
<!-- //for bootstrap sweetalert -->
<!-- for jquery validation -->
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.additional-methods.min.js"></script>
<!-- //for jquery validation -->
<!-- start-smooth-scrolling -->
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- //end-smooth-scrolling -->
<!-- custom css -->
<style type="text/css">
div.error{
	color:red;
}
div.ts-user-info-icon{
	float: left;
}
div.w3l_logo{
	margin-left:14em;
}
div.w3l_login{
	margin-right:7em;
}
</style>
<!-- //custom css -->
</head> 
<body> 
	<!-- header modal -->
	<div class="modal fade" id="myModal88" tabindex="-1" role="dialog" aria-labelledby="myModal88"
		aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						&times;</button>
					<h4 class="modal-title" id="myModalLabel">Don't Wait, Login now!</h4>
				</div>
				<div class="modal-body modal-body-sub">
					<div class="row">
						<div class="col-md-8 modal_body_left modal_body_left1" style="border-right: 1px dotted #C2C2C2;padding-right:3em;">
							<div class="sap_tabs">	
								<div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
									<ul>
										<li class="resp-tab-item" aria-controls="tab_item-0"><span>Sign in</span></li>
										<li class="resp-tab-item" aria-controls="tab_item-1"><span>Sign up</span></li>
									</ul>		
									<div class="tab-1 resp-tab-content" aria-labelledby="tab_item-0">
										<div class="facts">
											<div class="register">
												<form id="frmSignin">			
													<input name="txtUsername" id="txtUsername" placeholder="Email Address" maxlength="128" type="text" data-rule-required="true">						
													<input name="txtUserPass" id="txtUserPass" placeholder="Password" maxlength="20" type="password" data-rule-required="true">										
													<div class="sign-up">
														<input type="submit" value="Sign in"/>
													</div>
												</form>
											</div>
										</div> 
									</div>	 
									<div class="tab-2 resp-tab-content" aria-labelledby="tab_item-1">
										<div class="facts">
											<div class="register">
												<form id="frmSignup" action="#" method="post">
													<input placeholder="Name" name="txtName" maxlength="256" id="txtName" type="text">
													<input placeholder="Email Address" id="txtEmail" maxlength="128" name="txtEmail" type="email">	
													<input placeholder="Enter Password" name="txtPassword" maxlength="20" id="txtPassword" type="password">	
													<input placeholder="Confirm Password" name="txtCnfPassword" id="txtCnfPassword" type="password">
													<div class="sign-up">
														<input type="submit" value="Create Account"/>
													</div>
												</form>
											</div>
										</div>
									</div> 			        					            	      
								</div>	
							</div>
							<script src="js/easyResponsiveTabs.js" type="text/javascript"></script>
							<script type="text/javascript">
								$(document).ready(function () {
									$('#horizontalTab').easyResponsiveTabs({
										type: 'default', //Types: default, vertical, accordion           
										width: 'auto', //auto or any width like 600px
										fit: true   // 100% fit in a container
									});
									
									//register form validation
									$('#frmSignup').validate({
										errorElement: 'div',
										rules: {
											txtName: {
												required: true,
												minlength: 2,
												maxlength: 256
											},
											txtEmail: {
												required: true,
												email: true,
												maxlength: 128
											},
											txtPassword: {
												required: true,
												minlength: 4,
												maxlength: 20
											},
											txtCnfPassword: {
												equalTo: '#txtPassword'
											}
										},
										messages: {
											txtCnfPassword:{
												equalTo: 'Password and confirm password must match.'
											}
										}
									});
									
									$('#frmSignup').on('submit',function(e){fun_CreateUser(e)});
									
									//signin form validation
									$('#frmSignin').validate({
										errorElement: 'div'
									});
									
									$('#frmSignin').on('submit',function(e){fun_Signin(e)});
								});
								
								function fun_CreateUser(ev){
									ev.preventDefault();
									if($('#frmSignup').valid()===true){
										$.ajax({
											type: "POST",
											url: "api/account_api.php",
											data: JSON.stringify({
												fn: 'CreateUser',
												name: $('#txtName').val(),
												email: $('#txtEmail').val(),
												password: $('#txtPassword').val()
											}),
											contentType: 'application/json; charset=utf-8',
											dataType: 'json',
											success: function (response) {
												if (typeof response.d !== 'undefined' && response.d !== null) {
													response = response.d;
												}
												if(response.status === true){
													sweetAlert('Done!','Account created! Use your credentials for login.','success');
													
													//reset input
													$('#txtName').val('');
													$('#txtEmail').val('');
													$('#txtPassword').val('');
													$('#txtCnfPassword').val('');
													
													//close modal
													$('#myModal88').modal('hide');
												}else{
													if(typeof response.data !== 'undefined' && response.data instanceof Array && response.data.length > 0){
														var msg = '';
														$.each(response.data,function(i,it){
															msg += it + '<br/>';
														});
														sweetAlert({
															title: 'Validation Error!',
															type: 'warning',
															text: msg,
															html: true
														});
													}else{
														sweetAlert('Oops...','Please try again after sometime.','error');
													}
												}
											},
											error: function (response) {
												sweetAlert('Oops...','Please try again after sometime.','error');
											}
										});
									}
									
									return false;
								}
								
								function fun_Signin(ev){
									ev.preventDefault();
									if($('#frmSignin').valid()===true){
										$.ajax({
											type: "POST",
											url: "api/account_api.php",
											data: JSON.stringify({
												fn: 'LoginUser',
												email: $('#txtUsername').val(),
												password: $('#txtUserPass').val()
											}),
											contentType: 'application/json; charset=utf-8',
											dataType: 'json',
											success: function (response) {
												if (typeof response.d !== 'undefined' && response.d !== null) {
													response = response.d;
												}
												if(response.status === true){
													//reload
													window.location.reload();
												}else{
													if(typeof response.data !== 'undefined' && response.data instanceof Array && response.data.length > 0){
														var msg = '';
														$.each(response.data,function(i,it){
															msg += it + '<br/>';
														});
														sweetAlert({
															title: 'Validation Error!',
															type: 'warning',
															text: msg,
															html: true
														});
													}else{
														sweetAlert('Oops...',response.message,'error');
													}
												}
											},
											error: function (response) {
												sweetAlert('Oops...','Please try again after sometime.','error');
											}
										});
									}
									
									return false;
								}
							</script>
							<div id="OR" class="hidden-xs">OR</div>
						</div>
						<div class="col-md-4 modal_body_right modal_body_right1">
							<div class="row text-center sign-with">
								<div class="col-md-12">
									<h3 class="other-nw">Sign in with</h3>
								</div>
								<div class="col-md-12">
									<ul class="social">
										<li class="social_facebook"><a href="#" class="entypo-facebook"></a></li>
										<li class="social_dribbble"><a href="#" class="entypo-dribbble"></a></li>
										<li class="social_twitter"><a href="#" class="entypo-twitter"></a></li>
										<li class="social_behance"><a href="#" class="entypo-behance"></a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> 
	<!-- header modal -->
	<!-- header -->
	<div class="header" id="home1">
		<div class="container">
			<?php if(isset($_SESSION['name'])){ ?>
				<div class="ts-user-info-icon">
					Hi, <a style="font-weight:bolder;"><?=substr($_SESSION['name'],0,strpos($_SESSION['name'],' '))?></a>. &nbsp;&nbsp;<a href="api/account_api.php?fn=Logout">Logout</a>
				</div>
			<?php } else { ?>
				<div class="w3l_login">
					<a href="#" data-toggle="modal" data-target="#myModal88"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></a>
				</div>
			<?php } ?>
			<div class="w3l_logo">
				<h1><a href="index.html">Electronic Store<span>Your stores. Your place.</span></a></h1>
			</div>
			<div class="search">
				<input class="search_box" type="checkbox" id="search_box">
				<label class="icon-search" for="search_box"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></label>
				<div class="search_form">
					<form action="#" method="post">
						<input type="text" name="Search" placeholder="Search...">
						<input type="submit" value="Send">
					</form>
				</div>
			</div>
			<div class="cart cart box_1"> 
				<form action="#" method="post" class="last"> 
					<input type="hidden" name="cmd" value="_cart" />
					<input type="hidden" name="display" value="1" />
					<button class="w3view-cart" type="submit" name="submit" value=""><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></button>
				</form>   
			</div>  
		</div>
	</div>
	<!-- //header -->
	<!-- navigation -->
	<div class="navigation">
		<div class="container">
			<nav class="navbar navbar-default">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header nav_2">
					<button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div> 
				<div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
					<ul class="nav navbar-nav">
						<li><a href="index.html">Home</a></li>	
						<!-- Mega Menu -->
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Products <b class="caret"></b></a>
							<ul class="dropdown-menu multi-column columns-3">
								<div class="row">
									<div class="col-sm-3">
										<ul class="multi-column-dropdown">
											<h6>Mobiles</h6>
											<li><a href="products.html">Mobile Phones</a></li>
											<li><a href="products.html">Mp3 Players <span>New</span></a></li> 
											<li><a href="products.html">Popular Models</a></li>
											<li><a href="products.html">All Tablets<span>New</span></a></li>
										</ul>
									</div>
									<div class="col-sm-3">
										<ul class="multi-column-dropdown">
											<h6>Accessories</h6>
											<li><a href="products1.html">Laptop</a></li>
											<li><a href="products1.html">Desktop</a></li>
											<li><a href="products1.html">Wearables <span>New</span></a></li>
											<li><a href="products1.html"><i>Summer Store</i></a></li>
										</ul>
									</div>
									<div class="col-sm-2">
										<ul class="multi-column-dropdown">
											<h6>Home</h6>
											<li><a href="products2.html">Tv</a></li>
											<li><a href="products2.html">Camera</a></li>
											<li><a href="products2.html">AC</a></li>
											<li><a href="products2.html">Grinders</a></li>
										</ul>
									</div>
									<div class="col-sm-4">
										<div class="w3ls_products_pos">
											<h4>30%<i>Off/-</i></h4>
											<img src="images/1.jpg" alt=" " class="img-responsive" />
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
							</ul>
						</li>
						<li><a href="about.html" class="act">About Us</a></li> 
						<li class="w3pages"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pages <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="icons.html">Web Icons</a></li>
								<li><a href="codes.html">Short Codes</a></li>     
							</ul>
						</li>  
						<li><a href="mail.html">Mail Us</a></li>
					</ul>
				</div>
			</nav>
		</div>
	</div>
	<!-- //navigation -->
	<!-- banner -->
	<div class="banner banner10">
		<div class="container">
			<h2><?= isset($PageTitle) ? $PageTitle : "Default Title"?></h2>
		</div>
	</div>
	<!-- //banner -->   
	<!-- breadcrumbs -->
	<?php if(isset($breadcrumbs)){ ?>
	<div class="breadcrumb_dress">
		<div class="container">
			<ul>
				<?php echo $breadcrumbs; ?>
			</ul>
		</div>
	</div>
	<?php } ?>
	<!-- //breadcrumbs -->