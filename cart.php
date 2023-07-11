<?php
    session_start();
    if (!isset($_SESSION['SESSION_EMAIL'])) {
        header("Location: login.php");
        die();
    }
    require 'config.php';
    include 'includes/dbconnection.php';

    $query = mysqli_query($con, "SELECT * FROM tblusers WHERE email='{$_SESSION['SESSION_EMAIL']}'");

    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
    }
   
   if(isset($_GET['remove'])){
      $remove_id = $_GET['remove'];
      mysqli_query($con, "DELETE FROM `tblcart` WHERE id = '$remove_id'");
      header('location:cart.php');
   };
   
   if(isset($_GET['delete_all'])){
      mysqli_query($con, "DELETE FROM `tblcart`");
      header('location:cart.php');
   }
?>
<!DOCTYPE html>
<html lang="zxx">
   <head>
      <title>MEGHASAMAYAM | CART</title>
        <!-- font awesome cdn link  -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

      <!-- custom css file link  -->
      <link rel="stylesheet" href="css/style.css">
      <script>
         addEventListener("load", function () {
         	setTimeout(hideURLbar, 0);
         }, false);
         
         function hideURLbar() {
         	window.scrollTo(0, 1);
         }
      </script>
      <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
      <!--//meta tags ends here-->
      <!--booststrap-->
      <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">
      <!--//booststrap end-->
      <!-- font-awesome icons -->
      <link href="css/fontawesome-all.min.css" rel="stylesheet" type="text/css" media="all">
      <!-- //font-awesome icons -->
      <!--Shoping cart-->
      <link rel="stylesheet" href="css/shop.css" type="text/css" />
      <!--//Shoping cart-->
      <link rel="stylesheet" type="text/css" href="css/jquery-ui1.css">
      <link href="css/easy-responsive-tabs.css" rel='stylesheet' type='text/css' />
      <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
      <!--stylesheets-->
      <link href="css/style.css" rel='stylesheet' type='text/css' media="all">
      <!--//stylesheets-->
      <link href="//fonts.googleapis.com/css?family=Sunflower:500,700" rel="stylesheet">
      <link href="//fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
   </head>
   <body>
      <!--headder-->
     <?php include_once('includes/header.php');?>
      <!-- banner -->
      <div class="inner_page-banner one-img">
      </div>
      <!--//banner -->
      <!-- short -->
      <div class="using-border py-3">
         <div class="inner_breadcrumb  ml-4">
            <ul class="short_ls">
               <li>
                  <a href="index.php">Home</a>
                  <span>/ /</span>
               </li>
               <li>CART</li>
            </ul>
         </div>
      </div>
      <div class="container">

<section class="shopping-cart">
   <table>

      <thead>
         <th>Name</th>
         <th>Artist</th>
         <th>Price</th>
         <th>Action</th>
      </thead>

      <tbody>
      <!-- //short-->
      <!--//banner -->
      <!--/shop-->
      <?php
$ret=mysqli_query( $con, "SELECT * FROM `tblcart`");
$grand_total = 0;
if(mysqli_num_rows($ret) > 0){
while ($row=mysqli_fetch_array($ret)) {
?>
<tr>

<td><?php echo $row['Title']; ?></td>
<td><?php echo ($row['Artist']); ?></td>
<td><i class="fa fa-inr"><?php echo ($row['SellingPricing']); ?></td>
<td><a href="cart.php?remove=<?php echo $row['id'];  ?>" onclick="return confirm('remove item from cart?')" class="delete-btn"> <i class="fas fa-trash"></i> remove</a></td>
</tr>
<tr class="table-bottom"> 
<?php
           $sub_total = $row['SellingPricing'];
           $grand_total = $grand_total += $sub_total;
            };
         };
         ?>             
<td>Total Amount = <i class="fa fa-inr"></i><?php echo number_format($grand_total, 2); ?>
<form  action="checkout.php" method="POST">
               <script
               src="https://checkout.stripe.com/checkout.js"
               class="stripe-button"
               data-key="<?php echo $publishableKey?>"
               data-name="MEGHASAMAYAM"
               data-description="Finest Artworks"
               data-amount= "<?php echo $total=$grand_total * 100;?>"
               data-currency="inr"
               data-email="arshitharavind10@gmail.com"
               data-locale="auto">
               </script>
               </form>
</td>
            <td><a href="cart.php?delete_all" onclick="return confirm('are you sure you want to delete all?');" class="option-btn"> <i class="fas fa-trash"></i> delete all </a></td>
         </tr>
      </tbody>
   </table>
   </section>
</hmtl>