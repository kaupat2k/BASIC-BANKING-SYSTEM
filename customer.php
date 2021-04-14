<!DOCTYPE html>
<html>
<head>
<title>CUSTOMER DETAILS</title>
<link rel="icon" href="images/ic.png" type="image/icon type">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="generator" content="">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto:200,300,400,500,600,700" rel="stylesheet">
</head>
<body>
<?php
  require 'config.php';
  $query = "SELECT * FROM users";
  $result = mysqli_query($conn, $query);
  ?>

<!-- HEADER =============================-->
<header class="item header margin-top-0">
<div class="wrapper">
	<nav role="navigation" class="navbar navbar-white navbar-embossed navbar-lg navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button data-target="#navbar-collapse-02" data-toggle="collapse" class="navbar-toggle" type="button">
			<i class="fa fa-bars"></i>
			<span class="sr-only">Toggle navigation</span>
			</button>
			<a href="index.html" class="navbar-brand brand"> BANK OF UNITY </a>
		</div>
		<div id="navbar-collapse-02" class="collapse navbar-collapse">
			<ul class="nav navbar-nav navbar-right">
				<li class="propClone"><a href="index.html">Home</a></li>
				<li class="propClone"><a href="shop.php">Customer details</a></li>
				<li class="propClone"><a href="transactionDetails.php">Transaction History</a></li>
				<li class="propClone"><a href="checkout.php">About</a></li>
				
			</ul>
		</div>
	</div>
	</nav>
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<div class="text-pageheader">
					<div class="subtext-image" data-scrollreveal="enter bottom over 1.7s after 0.1s">
						 CUSTOMER DETAILS
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</header>

<!-- CONTENT =============================-->
<section class="item content">
<div class="container toparea">
	<div class="underlined-title">
		<div class="editContent">
			<h1 class="text-center latestitems"><p style="text-align:center;"><img src="images/view-details.png" alt="alternatetext" ></p></h1>
		</div>
		<div class="wow-hr type_short">
			<span class="wow-hr-h">
			<i class="fa fa-star"></i>
			<i class="fa fa-star"></i>
			<i class="fa fa-star"></i>
			</span>
		</div>
	</div>
	
		<!-- /.productbox -->
	</div>
</div>
</div>
</section>
<div class="container">
   
    <br>
    <div class="row">
      <div class="col">
        <div>
          <table class="table table-dark table-hover table-striped table-bordered">
            <thead>
              <tr>
                <th scope="col">Customer Id</th>
                <th scope="col">Name</th>
                <th scope="col">Email Id</th>
                <th scope="col">Account Balance</th>
                <th scope="col">Operation</th>
              </tr>
            </thead>
            <tbody>
              <?php
              while ($rows = mysqli_fetch_array($result)) {
              ?>
                <tr class="table-light">
                  <td><?php echo $rows['id'] ?></td>
                  <td><?php echo $rows['name'] ?></td>
                  <td><?php echo $rows['email'] ?></td>
                  <td><?php echo $rows['credits'] ?></td>
                  <td><a href="selectedUserdetail.php?id= <?php echo $rows['id']; ?>"> <button type="button" class="button2">Transfer</button></a></td>
                </tr>
              <?php
              }
              ?>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  </div>




<!-- FOOTER =============================-->
<div class="footer text-center">
	<div class="container">
		<div class="row">
			<p class="footernote">
				 Connect with BANK OF UNITY
			</p>
			<ul class="social-iconsfooter">
				<li><a href="#"><i class="fa fa-phone"></i></a></li>
				
				
				
				
			</ul>
			<p>
				 &copy; 2021 Kaustubh Patil<br/>
				
			</p>
		</div>
	</div>
</div>
>

<!-- Load JS here for greater good =============================-->
<script src="js/jquery-.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/anim.js"></script>
<script>
//----HOVER CAPTION---//	  
jQuery(document).ready(function ($) {
	$('.fadeshop').hover(
		function(){
			$(this).find('.captionshop').fadeIn(150);
		},
		function(){
			$(this).find('.captionshop').fadeOut(150);
		}
	);
});
</script>
</body>
</html>