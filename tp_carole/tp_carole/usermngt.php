<?php
session_start();
include("db/DBout.php");

if (!isset($_SESSION["admin_session"])) {
	header("Location:index.php");
}

include("header.php");
include("admnav.php");
?>

<div class="row banner-inner"></div>

<div class="row row-padding row-white fond-blanc">
	<div class="container">	
		<div class="row">
			<?php

				$sql = "SELECT * FROM users";
				$query = $pdo_var->query($sql);
				$count = $query->rowcount();
				$no = 1;
			?>
			<div class="col-md-6">
				<h3>Listes des utilisateurs</h3>
				<hr/>	
				<div class="row">
					
					<table class="table table-bordered">
					    <thead>
					      <tr>
					        <th class="td-center">No.</th>
					        <th>Nom</th>
					        <th>Pseudo</th>
					        <th class="td-center">Action</th>
					      </tr>
					    </thead>
					    <tbody>
					    	<?php
					    		while ($row=$query->fetch()) {	

					    			if ($row["u_status"]==1) {
					    				$menu = "<li><a href='db/functions.php?block_uID=".$row['id']."'><i class='fa fa-user-times'></i>  Bloquer Utilisateur</a></li>";
					    			}else{
					    				$menu = "<li><a href='db/functions.php?unblock_uID=".$row['id']."'><i class='fa fa-ban'></i>  Débloquer Utilisateur</a></li>";
					    			}
					    	?>
					    		<tr>
					    			<td class="td-center"><?php echo $no; ?></td>
					    			<td><?php echo ucfirst($row["u_fname"])." ".ucfirst($row["u_lname"]); ?></td>
					    			<td><?php echo $row["u_pseudo"]; ?></td>
					    			<td class="td-center td-list">	    				
							          <li class="dropdown">
							            <a href="#" class="dropdown-toggle btn btn-default" data-toggle="dropdown"> Actions <i class="fa fa-caret-down"></i></a>
							              <ul class="dropdown-menu dropdown-bottom-border">
							                <li><a href="usermngt.php?prID=<?php echo $row['id']; ?>"><i class="fa fa-info-circle"></i> Voir Profil</a></li>
							                <li><a href="usermngt.php?conID=<?php echo $row['id']; ?>"><i class="fa fa-info-circle"></i> Voir Connexions</a></li>
							                <li><a href="usermngt.php?achID=<?php echo $row['id']; ?>"><i class="fa fa-info-circle"></i> Voir Achats</a></li>
							                <li><a href="usermngt.php?comID=<?php echo $row['id']; ?>"><i class="fa fa-info-circle"></i> Voir Commentiares</a></li>
							                <?php echo $menu; ?>
							              </ul>
							          </li> 
					    			</td>
					    		</tr>
					    	<?php
					    			$no++;
					    		}
					    	?>
					    </tbody>
					    <tfoot>
					      <tr>
					        <th class="td-center">No.</th>
					        <th>Nom</th>
					        <th>Pseudo</th>
					        <th class="td-center">Action</th>
					      </tr>
					    </tfoot>
					</table>

				</div>
			</div>
			<div class="col-md-1"></div>
			<div class="col-md-5">
				<div class="row">
					<div class="col-md-12">
						<?php
							if (isset($_GET["prID"])) {

								$sql = "SELECT *,DATE_FORMAT(u_date_of_birth,'%d-%m-%Y') AS dob FROM users WHERE id='".htmlspecialchars($_GET["prID"])."'";
								$query = $pdo_var->query($sql);
								$row = $query->fetch();	
							?>

							<div class="row white-wrapper">
								<h4>Détail du profil utilisateur</h4>
								<hr/>	
								<div class="col-sm-6">
									<label>Prenom</label>
									<input type="text" value="<?php echo ucfirst($row['u_fname']); ?>" readonly>
								</div>
								<div class="col-sm-6">
									<label>Nom</label>
									<input type="text" value="<?php echo ucfirst($row['u_lname']); ?>" readonly>
								</div>
								<div class="col-sm-8">
									<label>Adresse</label>
									<input type="text" value="<?php echo $row['u_adress']; ?>" readonly>
								</div>
								<div class="col-sm-4">
									<label>Code postal</label>
									<input type="text" value="<?php echo $row['u_postal_code']; ?>" readonly>
								</div>
								<div class="col-sm-5">
									<label>Date de naissance</label>
									<input type="text" value="<?php echo $row['dob']; ?>" readonly>
								</div>
								<div class="col-sm-7">
									<label>Pseudo</label>
									<input type="text" value="<?php echo $row['u_pseudo']; ?>" readonly>
								</div>
								<div class="col-sm-12">
									<label>Email</label>
									<input type="email" value="<?php echo $row['u_email']." ".$row['u_lname']; ?>" readonly>
								</div>
							</div>	
							<?php
							}
							else if (isset($_GET["conID"])) {

								$mydate = Date("Y-m-d");

								$mydate1 = Date('Y-m-d 00:00:00', strtotime('-7 days'));
								$mydate2 = Date("Y-m-d 23:59:59");
								
								// RECUPERER LES NO DE CONNEXIONS D'UN UM (AUJOURD'HUI)
								$sql = "SELECT count(id) AS c_no FROM connexion_attempts WHERE u_id='".htmlspecialchars($_GET["conID"])."' AND con_date LIKE '$mydate%'";
								$query = $pdo_var->query($sql);
								$row=$query->fetch();

								// RECUPERER LES NO DE CONNEXIONS D'UN UM (7 DERNIERS JOURS)
								$sql1 = "SELECT count(id) AS c_no_7 FROM connexion_attempts WHERE u_id='".htmlspecialchars($_GET["conID"])."' AND con_date BETWEEN '".$mydate1."' AND '".$mydate2."'";
								$query1 = $pdo_var->query($sql1);
								$row1 = $query1->fetch();

								if ($count>0) {
									$i=1;
							?>
								<div class="row white-wrapper">
									<h4>Tentatives de connexion</h4>
									<hr/>
							<div class="table-responsive">
								<table  id="sorted_table" class="table table-bordered">
									<thead class="thead-light">
										<tr>
											<th class="td-center"><strong>Aujourd'hui</strong></th>
											<th class="td-center"><strong>Les 7 derniers jours</strong></th>
										</tr>
									</thead>
									<tbody>	
									<tr>
										<td class="td-center"><?php echo $row["c_no"]; ?></td>
										<td class="td-center"><?php echo $row1["c_no_7"]; ?></td>
									</tr>
									</tbody>
								</table> 
							</div> 
							<?php
								}
								else{
									?><h4 class="empty-cart">Aucune Tentative de connexion</h4><?php
								}
							}
							else if (isset($_GET["achID"])) {

								// RECUPERER LES COMMANDE D'un UM
								$sql = "SELECT id,user_id,order_price,order_status,order_number,order_date,DATE_FORMAT(order_date,'%d/%m/%Y') AS oDate FROM orders WHERE user_id='".htmlspecialchars($_GET["achID"])."' ORDER BY order_date ASC";
								$query = $pdo_var->query($sql);
								$count = $query->rowcount();

								if ($count>0) {
									$i=1;
							?>
								<div class="row white-wrapper">
									<h4>Détail des achats</h4>
									<hr/>
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
											<a href="ordersadmin.php?admOrderID=<?php echo $row['id']; ?>">Détails</a>
										</td>
									</tr>

								</div>
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
								}
								else{
									?><h4 class="empty-cart">Aucune commande</h4><?php
								}
							}
							else if (isset($_GET["comID"])) {
								
								// RECUPERER LES COMMENTAIRES D'UN UM
								$sql = "SELECT *,DATE_FORMAT(comment_date,'%d/%m/%Y - %H:%i:%s') AS cDate FROM comments WHERE user_id='".htmlspecialchars($_GET["comID"])."' ORDER BY comment_date DESC LIMIT 5";
								$query = $pdo_var->query($sql);
								$count = $query->rowcount();

								if ($count>0) {
									$i=1;
							?>
								<div class="row white-wrapper">
									<h4>Les 5 derniers Commentaires édités par l'UM</h4>
									<hr/>
									<div class="table-responsive">
										<table  id="sorted_table" class="table table-bordered">
											<thead class="thead-light">
												<tr>
													<th class="td-center"><strong>No.</strong></th>
													<th><strong>Contenu</strong></th>
													<th class="td-center"><strong>Publié le</strong></th>
												</tr>
											</thead>
											<tbody>		
								<?php

									while ($row=$query->fetch()) {
								?>
									<tr>
										<td class="td-center"><?php echo $i; ?></td>
										<td><?php echo $row["content"]; ?></td>
										<td class="td-center"><?php echo $row["cDate"]; ?></td>
									</tr>

								</div>
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
								}
								else{
									?><h4 class="empty-cart">Aucun commentaire</h4><?php
								}
							}
							else{
								echo "<h4 class='empty-cart'>Pas de resultat</h4>";
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