<?php
session_start();
include("db/DBout.php");

if (isset($_GET["orderId"])) {
	
	$orderID = htmlspecialchars($_GET["orderId"]);

	if (!isset($_SESSION['user_logged'])) {
		header("Location:index.php");
	}

	include("header.php");
	include("navigation.php");
?>

<div class="row banner-inner">
	<div class="banner-inner-top"></div>
	<div class="container">
		<div class="col-sm-12">
			<div class="outter-logo outter-logo-2">
				<h4>Mes commandes</h4>
			</div>
		</div>
	</div>
</div>

<div class="row row-padding row-padding-inner white-wrapper">
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

					<?php

						// RECUPERER LE NUMERO DE LA COMMANDE
						$sql00 = "SELECT * FROM orders WHERE id='".$orderID."'";
						$query00 = $pdo_var->query($sql00);
						$row00=$query00->fetch();


						// RECUPERER LES COMMANDE PAR UM
						$sql = "SELECT * FROM orders_details WHERE order_id='".$orderID."'";
						$query = $pdo_var->query($sql);
						$count = $query->rowcount();

						if ($count>0) {
					?>	
					<div class="table-responsive">
						<h4>DETAILS DE LA COMMANDE No. <?php echo $row00["order_number"]; ?></h4>
						<table  id="sorted_table" class="table table-bordered">
							<thead class="thead-light">
								<tr>
									<th class="td-center"><strong>No.</strong></th>
									<th><strong>Nom produit</strong></th>
									<th class="td-center"><strong>Prix unitaire</strong></th>
									<th class="td-center"><strong>Qté</strong></th>
									<th class="td-center"><strong>Sous total</strong></th>
								</tr>
							</thead>
							<tbody>	
								<?php 
									
									$i=1;
									$grand_total = 0;

									while ($row=$query->fetch()) {

										$sql1 = "SELECT * FROM products WHERE id='".$row['prod_id']."'";
										$query1 = $pdo_var->query($sql1);
										$row1=$query1->fetch();

										// CALCUL DU GRAND TOTAL
										$grand_total += $row["sub_total"];
								?>
									<tr>
										<td class="td-center"><?php echo $i; ?></td>
										<td><?php echo $row1["prod_name"]; ?></td>
										<td class="td-center"><?php echo $row1["prod_price"]; ?>&euro;</td>
										<td class="td-center"><?php echo $row["prod_qty"]; ?></td>
										<td class="td-center"><?php echo $row["sub_total"]; ?>&euro;</td>
									</tr>
								<?php
										$i++;	
									}
								?>
								<tr>
									<td colspan="4" class="td-center">
										<strong>Grand Total</strong>
									</td>	
									<td class="td-center">
										<strong><?php echo $grand_total; ?>&euro;</strong>
									</td>	
								</tr>
							</tbody>
						</table> 
					</div> 
					<?php 
						}else{
							?><h4 class="empty-cart">Aucune commande</h4><?php
						} 
					?>
					
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
else{
	header("Location:orders.php");
}

?>