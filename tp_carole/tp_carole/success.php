<?php
session_start();
include("db/DBout.php");

$num = rand(11111,99999);

$sql = "UPDATE orders SET order_status='success',order_number='".$num."' WHERE id='".$_SESSION["last_inserted"]."'";
$query = $pdo_var->prepare($sql);

if ($query->execute()) {

	unset($_SESSION["last_inserted"]);
	unset($_SESSION["total_amount"]);
	unset($_SESSION["cart_item"]);
	
include("header.php");
?>
<div class="container-fluid">

<div class="row banner-inner">
	<div class="banner-inner-top"></div>
	<div class="container">
		<div class="col-md-12">
			<div class="outter-logo div-img">
				<a href="index.php">
					Travail Pratique
				</a>
			</div>
		</div>
	</div>
</div>

<div class="row row-padding row-white">
	<br/><br/><br/><br/>
	<div class="container">	
		<div class="row">
			
			<div class="col-md-12">
				<div class="order-response-wrapper">
					<i class="fa fa-check"></i>
					<h3>Commande Passée avec succès</h3>
                	<p>Votre commande n'a pas encore été expédiée, mais nous vous enverrons un e-mail lorsqu'elle le sera.</p>
					<span>Félicitations pour votre commande<br/><strong>No. <?php echo $num; ?></strong></span>
					<ul>
						<li>
							<a href="index.php" class="btn btn-danger">continuer dans le magasin</a>
						</li>
					</ul>
				</div>
			</div>			

		</div>	
	</div>
</div>

<?php
include("footer.php");

}
else{
	header("Location:cancel.php");
}

?>