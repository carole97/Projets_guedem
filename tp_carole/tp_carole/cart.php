<?php
session_start();
include("header.php");
include("navigation.php");
?>

<div class="row banner-inner">
	<div class="banner-inner-top"></div>
	<div class="container">
		<div class="col-sm-12">
			<div class="outter-logo outter-logo-2">
				<h4>Mon panier</h4>
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
					if(isset($_SESSION["cart_item"])) {
						$total_quantity = 0;
					    $item_total = 0;
					?>	
					<div class="table-responsive">
						<table  id="sorted_table" class="table table-bordered">
							<thead class="thead-light">
								<tr>
									<th><strong>Nom du produit</strong></th>
									<th class="td-center"><strong>Code</strong></th>
									<th class="td-center"><strong>Quantité</strong></th>
									<th><strong>Prix</strong></th>
									<th class="td-center"><strong>Action</strong></th>
								</tr>
							</thead>
							<tbody>	
								<?php		
							    foreach ($_SESSION["cart_item"] as $item){
							    	$item_price = $item["quantity"]*$item["product_price"];
								?>
								<tr>
									<td><strong><?php echo $item["product_name"]; ?></strong></td>
									<td class="td-center"><?php echo $item["code"]; ?></td>
									<td class="td-center"><?php echo $item["quantity"]; ?></td>
									<td><?php echo "&euro;".$item_price; ?></td>
									<td class="td-center"><a onClick="cartAction('remove','')" class="btnRemoveAction cart-action">Remove Item</a></td>
								</tr>
								<?php
									$total_quantity += $item["quantity"];
							    	$item_total += ($item["product_price"]*$item["quantity"]);
								}
									$_SESSION["total_amount"] = $item_total;
								?>
								<tr>
									<td colspan="4"></td>
									<td class="td-center"><strong>Total :</strong> <?php echo "$".$item_total; ?></td>
								</tr>
								<tr>
									<td colspan="4"></td>
									<td>
										<a href="checkout.php" class="btn btn-danger btn-check-out">Continuer</a>
									</td>
								</tr>
							</tbody>
						</table> 
					</div> 
					<?php 
						}else{
							?><h4 class="empty-cart">votre panier est vide</h4><?php
						} 
					?>
					
				</div>
			</div>

		</div>	
	</div>
</div>

<?php
include("footer.php");
?>