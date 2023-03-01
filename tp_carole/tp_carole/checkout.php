<?php
session_start();
include("db/DBout.php");

if (isset($_SESSION["total_amount"])) {

	if (!isset($_SESSION['user_logged'])) {
		header("Location:login.php");
	}

	$sql = "INSERT INTO orders(user_id,order_price) VALUES('".$_SESSION['user_logged']."','".$_SESSION["total_amount"]."')";
	$query = $pdo_var->exec($sql);

	$_SESSION["last_inserted"] = $pdo_var->lastInsertId();

	foreach ($_SESSION["cart_item"] as $item){
		$item_price = $item["quantity"]*$item["product_price"];

		$sql1 = "INSERT INTO orders_details(order_id,prod_id,prod_qty,sub_total) VALUES('".$_SESSION["last_inserted"]."','".$item["product_id"]."','".$item["quantity"]."','".$item_price."')";
		$query1 = $pdo_var->exec($sql1);

	}

include("header.php");
include("navigation.php");
?>

<div class="row banner-inner">
	<div class="banner-inner-top"></div>
	<div class="container">
		<div class="col-sm-12">
			<div class="outter-logo outter-logo-2"></div>
		</div>
	</div>
</div>

<div class="row row-padding row-padding-inner row-white">
	<div class="container">	
		<div class="row">

			<div class="col-sm-4">
				<div class="side-img-wrapper div-100 div-img">
					<div class="side-img-wrapper-top">
						<img src="images/icons/shopping-cart.svg" alt="no image">	
					</div>
					<img src="images/login-signup-bg.png" alt="no image">
				</div>
			</div>
			<div class="col-sm-8">
				<div class="inner-page-wrapper div-100">

					<h3>CHECKOUT</h3>	
					<br/><br/>
					
					<div class="product"> 
					    <div class="btn">
					    	<a href="success.php" class="btn btn-danger">Payer <?php echo $_SESSION["total_amount"]; ?></a>
					    </div>
					</div>

				</div>
			</div>

			<div class="col-md-12">
				<div class="line-features">
					<hr>
				</div>
			</div>

			<div class="col-md-4">
				<div class="div-100 features features-no-effect">
					<div class="col-xs-3">
						<div class="features-inner div-img">
							<img src="images/icons/delivery-man.svg" alt="no image">
						</div>
					</div>
					<div class="col-xs-9">
						<div class="features-inner">
							<h4>Livraison Rapide</h4>
							<p>chaque commande est livrée dans le délai imparti.</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="div-100 features">
					<div class="col-xs-3">
						<div class="features-inner div-img">
							<img src="images/icons/secure-payment.svg" alt="no image">
						</div>
					</div>
					<div class="col-xs-9">
						<div class="features-inner">
							<h4>Paiement Sécurisé</h4>
							<p>payer avec votre carte bancaire en toute sécurité.</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="div-100 features">
					<div class="col-xs-3">
						<div class="features-inner div-img">
							<img src="images/icons/live-chat.svg" alt="no image">
						</div>
					</div>
					<div class="col-xs-9">
						<div class="features-inner">
							<h4>Service client 24/7</h4>
							<p>avec une équipe dynamique, nous opérons 24h/24 et 7j/7.</p>
						</div>
					</div>
				</div>
			</div>

		</div>	
	</div>
</div>

<?php
include("footer.php");

}

?>