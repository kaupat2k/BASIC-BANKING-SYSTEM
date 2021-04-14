<?php
include 'config.php';

if (isset($_POST['submit'])) {
  $from = $_GET['id'];
  $toUser = $_POST['to'];
  $amnt = $_POST['amount'];

  $sql = "SELECT * from users where id=$from";
  $query = mysqli_query($conn, $sql);
  $sql1 = mysqli_fetch_array($query);

  $sql = "SELECT * from users where id=$toUser";
  $query = mysqli_query($conn, $sql);
  $sql2 = mysqli_fetch_array($query);


  if ($amnt > $sql1['credits']) {

    echo "<script type='text/javascript'>
     alert('Insufficient Balance');
     
    </script>";
  } 
  else if ($amnt == 0) {
    echo "<script type='text/javascript'>
    alert('Enter Amount Greater than Zero');
    </script>";
  } else {

    $newCredit = $sql1['credits'] - $amnt;
    $sql = "UPDATE users set credits=$newCredit where id=$from";
    mysqli_query($conn, $sql);

    $newCredit = $sql2['credits'] + $amnt;
    $sql = "UPDATE users set credits=$newCredit where id=$toUser";
    mysqli_query($conn, $sql);

    $sender = $sql1['name'];
    $receiver = $sql2['name'];
    $sql = "INSERT INTO transaction(`sender`, `receiver`, `credits`) VALUES ('$sender','$receiver','$amnt')";
    $tns = mysqli_query($conn, $sql);
    if ($tns) {
      echo "<script type='text/javascript'>
                    alert('Transaction Successfull!');
                    window.location='transactionDetails.php';
                </script>";
    }
    $newCredit = 0;
    $amnt = 0;
  }
}
?>

<!DOCTYPE html>
<html>
<title>TRANSACTION DETAILS</title>
<link rel="icon" href="images/ic.png" type="image/icon type">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="generator" content="">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto:200,300,400,500,600,700" rel="stylesheet">
</head>



  <?php
  require 'config.php';
  $query = "SELECT * FROM users";
  $result = mysqli_query($conn, $query);
  ?>
  <body>

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
				<li class="propClone"><a href="customer.php">Customer details</a></li>
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
					<div class="subtext-image" data-scrollreveal="enter bottom over 1.7s after 0.0s">
						 TRANSACTION HISTORY
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</header>

  <section class="item content">
<div class="container toparea">
	<div class="underlined-title">
		<div class="editContent">
			<h1 class="text-center latestitems">Transaction History</h1>
		</div>
		<div class="wow-hr type_short">
			<span class="wow-hr-h">
			<i class="fa fa-star"></i>
			<i class="fa fa-star"></i>
			<i class="fa fa-star"></i>
			</span>
		</div>
	</div>
	<div class="container">

    <?php
    include 'config.php';
    $sid = $_GET['id'];
    $sql = "SELECT * FROM  users where id=$sid";
    $query = mysqli_query($conn, $sql);
    if (!$query) {
      echo "Error " . $sql . "<br/>" . mysqli_error($conn);
    }
    $rows = mysqli_fetch_array($query);
    ?>
    <form method="post" name="tcredit" class="tabletext"><br />
      <label style="text-align: left;"> FROM: </label><br />
      <div>
        <table class="table table-dark table-hover table-striped table-bordered">
          <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Amount Transferred</th>
          </tr>
          <tr class="table-light">
            <td><?php echo $rows['id'] ?></td>
            <td><?php echo $rows['name'] ?></td>
            <td><?php echo $rows['email'] ?></td>
            <td><?php echo $rows['credits'] ?></td>
          </tr>
        </table>
      </div>
      <br />
      <label>TO:</label>
      <select class=" form-control" name="to" style="margin-bottom:5%;" required>
        <option value="" disabled selected> </option>
        <?php
        include 'config.php';
        $sid = $_GET['id'];
        $sql = "SELECT * FROM users where id!=$sid";
        $query = mysqli_query($conn, $sql);
        if (!$query) {
          echo "Error " . $sql . "<br/>" . mysqli_error($conn);
        }
        while ($rows = mysqli_fetch_array($query)) {
        ?>
          <option class="table text-center table-striped " value="<?php echo $rows['id']; ?>">

            <?php echo $rows['name']; ?>
            <!--(Credits:
                    <?php echo $rows['credits']; ?> )-->

          </option>
        <?php
        }
        ?>
      </select>
      <label>AMOUNT:</label>
      <input type="number" id="amm" class="form-control" name="amount" min="0" required /> <br />
      <div class="text-center btn3">
        <button class="button2" name="reset" type="reset" id="myBtn" style="margin:8px;">Reset</button>
        <button class="button2" name="submit" type="submit" id="myBtn" style="margin:8px;">Proceed</button>

      </div>
    </form>
  </div>

  <script>
    var d = new Date();
    document.getElementById("demo").innerHTML = d;
  </script>
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

</body>
</html>