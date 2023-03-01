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

			<div class="col-md-12">
				<div class="div-100 white-wrapper containeur-connexion">
					
					<div class="col-md-5">
						<h3>Gerer les articles</h3>
						<hr/>	
						<div class="row">
							<form action="db/functions.php" method="post">
							<div class="col-sm-12">
								<label>Nom du produit</label>
								<input type="text" name="prod_name" placeholder="Entrer le nom du produit ici" required>
							</div>
							<div class="col-sm-12">
								<label>Nom du produit</label>
								<input type="number" name="prod_price" placeholder="Entrer le prix du produit ici" required>
							</div>
							<div class="col-sm-12">
								<label>Catégorie du produit</label>
								<select name="prod_cat">
									<?php
									 	// RECUPERER TOUTES LES CATEGORIES
										$sql0 = "SELECT * FROM categories";
										$query0 = $pdo_var->query($sql0);
										echo "<option value=''>-- CHOISISSEZ LA CATEGORIE --</option>";
										while ($row0=$query0->fetch()) {
										?>
											<option value="<?php echo $row0['id']; ?>"><?php echo $row0['cat_name']; ?></option>
										<?php
										}
									?>
								</select>
							</div>
							<div class="col-sm-6">
								<br/>
								<button name="prod_submit" type="submit" class="btn btn-danger">Ajouter le produit</button>
							</div>
							</form>
						</div>
					</div>
					<div class="col-md-1"></div>
					<div class="col-md-6">
						<h3>Liste des articles</h3>
						<hr/>	
						<div class="row">
							<div class="col-sm-12">
								
								<table class="table table-bordered">
								    <thead>
								      <tr>
								        <th class="td-center">No.</th>
								        <th colspan="2">Nom du produit</th>
								        <th>Catégorie</th>
								        <th class="td-center">Prix Unitaire</th>
								        <th class="td-center">#</th>
								      </tr>
								    </thead>
								    <tbody>
								      <?php

										$sql = "SELECT * FROM products ORDER BY id DESC";
										$query = $pdo_var->query($sql);
										$count = $query->rowcount();

										if($count>0){
											$no = 1;
											while ($row=$query->fetch()) {

												$sql1 = "SELECT * FROM categories WHERE id='".$row["cat_id"]."'";
												$query1 = $pdo_var->query($sql1);
												$row1 = $query1->fetch(); 
								      ?>
								      <tr>
								      	<th class="td-center"><?php echo $no; ?></th>
								        <td colspan="2"><?php echo $row["prod_name"]; ?></td>
								        <td><?php echo strtoupper($row1["cat_name"]); ?></td>
								        <td class="td-center"><?php echo $row["prod_price"]; ?> &euro;</td>
								        <td class="td-center">
								        	<ul class="actions-list">
								        		<li><a href="#" class="btn btn-warning">
								        			<i class="fa fa-edit"></i>
								        		</a></li>
								        		<li><a href="db/functions.php?del_prodID=<?php echo $row['id']; ?>" class="btn btn-danger">
								        			<i class="fa fa-trash"></i>
								        		</a></li>
								        	</ul>
								        </td>
								      </tr>
								      <?php
								      		$no++;

											}
										}
										else{
											?>
												<td class="empty-blog" colspan="4">Pas de Produit</td>
											<?php
										}

								      ?>
								    </tbody>
								    <tfoot>
								      <tr>
								        <th class="td-center">No.</th>
								        <th colspan="2">Nom du produit</th>
								        <th>Catégorie</th>
								        <th class="td-center">Prix Unitaire</th>
								        <th class="td-center">#</th>
								      </tr>
								    </tfoot>
								</table>

							</div>
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