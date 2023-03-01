<?php
session_start();
include("db/DBout.php");

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

						// RECUPERER LES COMMANDE PAR UM
						$sql = "SELECT id,user_id,order_price,order_status,order_number,order_date,DATE_FORMAT(order_date,'%d/%m/%Y') AS oDate FROM orders WHERE user_id='".$_SESSION['user_logged']."' ORDER BY order_date ASC";
						$query = $pdo_var->query($sql);
						$count = $query->rowcount();

						if ($count>0) {
					?>	
					<div class="table-responsive">
						<table  id="sorted_table" class="table table-bordered">
							<thead class="thead-light">
								<tr>
									<th class="td-center"><strong>No.</strong></th>
									<th><strong>Prix Total</strong></th>
									<th><strong>No. commande</strong></th>
									<th class="td-center"><strong>Date</strong></th>
									<th class="td-center"><strong>Statut</strong></th>
									<th class="td-center"><strong>action</strong></th>
								</tr>
							</thead>
							<tbody>	
								<?php 
									$i=1;
									while ($row=$query->fetch()) {
										
										if ($row["order_status"]=="success") {
											$statut = "Succès";
										}
										else if ($row["order_status"]=="declined") {
											$statut = "échoué";	
										}
										else{
											$statut = "En attente";
										}
								?>
									<tr>
										<td class="td-center"><?php echo $i; ?></td>
										<td><?php echo $row["order_price"]; ?>&euro;</td>
										<td><?php echo $row["order_number"]; ?></td>
										<td class="td-center"><?php echo $row["oDate"]; ?></td>
										<td class="td-center"><?php echo $statut; ?></td>
										<td class="td-center">
											<a href="ordersdetails.php?orderId=<?php echo $row['id']; ?>">Voir détails</a>
										</td>
									</tr>
								<?php
										$i++;	
									}
								?>
								<tr>
									
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
?>