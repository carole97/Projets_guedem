<?php
session_start();
include("db/DBout.php");
include("header.php");
include("navigation.php");
?>

<div class="row banner-inner"></div>

<div class="row row-padding row-white fond-blanc">
	<div class="container">	
		<div class="row">

			<div class="col-md-12">
				<div class="div-100 white-wrapper containeur-connexion">
					
					<h3>Achat de materiels</h3>
					<hr>
					<div class="col-md-12">

						<?php

							// RECUPERER LES CATEGORIES DES PRODUITS
							$sql = "SELECT id,cat_name FROM categories";
							$query = $pdo_var->query($sql);
							$count = $query->rowcount();

							if ($count>0) {
								while ($row=$query->fetch()) {	

									// RECUPERER LES PRODUITS CLASSES PAR CATEGORIE
									$sql1 = "SELECT * FROM products WHERE cat_id='".$row["id"]."'";
									$query1 = $pdo_var->query($sql1);
									$count1 = $query1->rowcount();
						?>
									<div class="row">
										<br/><br/>
										<div class="col-md-12">
											<div class="div-100 category-title">
												<h4><?php echo $row["cat_name"]; ?></h4>
											</div>
										</div>
										<?php 
											if ($count1>0) {
										?>
								        <div id="owl-demo" class="owl owlcarou">
											<?php
												while ($row1=$query1->fetch()) {

													$code = $row1["prod_code"];

													echo "
										            <div class='item div-img'>
														<form id='frmCart' method='POST' action='db/functions.php'>
															<div class='div-100 div-img restau-wrapper'>
																<img src='images/no-image.png' alt='no image'>
																<div class='restau-content'>
																	<h4>".$row1['prod_name']."</h4>	
																	<ul class='classification-list'>
																		<li>Catégorie</li>
																		<li>".$row['cat_name']."</li>
																	</ul>
																	<br/>
																	<ul class='timing-price-list'>
																		<li>
																			<h4><p>prix :</p> </i>".$row1['prod_price']."&euro;</h4>
																		</li>
																		<li>
																			<i>0$</i>
																		</li>
																		<li>
																			<div class='offer'>
																				<span>- 30 %</span>
																			</div>
																		</li>
																		<li></li>
																	</ul>
																	<div class='offer'>
																		<input type='hidden' name='form_id' value='".$row1['id']."'>
																		<input type='number' name='quantity' value='1' size='2'/>
																		<button type='submit' name='addToCart'><i class='fas fa-shopping-basket'></i></button>
																	</div>
																</div>
															</div>
														</form>
													</div>
													";
												}
											?>
								        </div>
								    	<?php 
								    		} 
								    		else{
								    	?>
							    				<div class="col-md-12">
							    					<h4 class="empty-blog">Pas de produits disponible</h4>
							    				</div>
								    	<?php
								    		}
								    	?>
									</div>
						<?php	
								}
							}
							else{
						?>
								<div class="row">
									<br/><br/>
									<div class="col-md-12">
										<div class="div-100 category-title">
											<h4>Pas de produits</h4>
										</div>
									</div>
								</div>
						<?php
							}
						?>
					</div>

				</div>
			</div>

		</div>	
	</div>
</div>

<?php
include("footer.php");
?>