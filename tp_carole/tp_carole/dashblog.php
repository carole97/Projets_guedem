<?php
session_start();
include("db/DBout.php");

if (!isset($_SESSION["admin_session"])) {
	header("Location:index.php");
}

if (!isset($_GET["blog_id"]) OR $_GET["blog_id"]==NULL) {
	header("Location:dashboard.php");	
}
else{
	$bID = htmlspecialchars($_GET["blog_id"]);
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

					<?php

						$sql = "SELECT * FROM blog WHERE id='".$bID."'";
						$query = $pdo_var->query($sql);
						$row = $query->fetch();
					?>
					
					<div class="col-md-5">
						<h3>Editer un Blog</h3>
						<hr/>	
						<div class="row">
							<form action="db/functions.php" method="POST">
								<div class="col-sm-12">
									<label>Titre du blog</label>
									<input type="hidden" name="update_blog_id" value="<?php echo $bID; ?>">
									<textarea name="update_blog_title" rows="5" required><?php echo $row['blog_title']; ?></textarea>
								</div>
								<div class="col-sm-12">
									<label>Contenu du blog</label>
									<textarea name="update_blog_content" rows="5" required><?php echo $row['blog_content']; ?></textarea>
								</div>
								<div class="col-sm-6">
									<br/>
									<button name="update_blog" type="submit" class="btn btn-danger">Mettre à jours le blog</button>
								</div>
							</form>
						</div>
					</div>
					<div class="col-md-1"></div>
					<div class="col-md-6">
						<h3>Liste des Commentaires</h3>
						<hr/>	
						<div class="row">
							<div class="col-sm-12">
								
								<table class="table table-bordered">
								    <thead>
								      <tr>
								        <th class="td-center">No.</th>
								        <th colspan="2">Commentaire</th>
								        <th class="td-center">Publié par</th>
								        <th class="td-center">Action</th>
								      </tr>
								    </thead>
								    <tbody>
								      <?php

										$sql1 = "SELECT * FROM comments WHERE blog_id='".$bID."'";
										$query1 = $pdo_var->query($sql1);
										$count1 = $query1->rowcount();

										if($count1>0){
											$no = 1;
											while ($row1=$query1->fetch()) {

												$sql2 = "SELECT id,u_pseudo FROM users WHERE id='".$row1['user_id']."'";
												$query2 = $pdo_var->query($sql2);
												$row2 = $query2->fetch();

								      ?>
								      <tr>
								      	<th class="td-center"><?php echo $no; ?></th>
								        <td colspan="2"><?php echo $row1["content"]; ?></td>
								        <td class="td-center"><?php echo $row2["u_pseudo"]; ?></td>
								        <td class="td-center">
								        	<ul class="actions-list">
								        		<li><a href="db/functions.php?comID=<?php echo $row1['id']; ?>&bloID=<?php echo $bID; ?>" class="btn btn-danger">
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
												<td class="empty-blog" colspan="5">Pas de commentaire</td>
											<?php
										}

								      ?>
								    </tbody>
								    <tfoot>
								      <tr>
								        <th class="td-center">No.</th>
								        <th colspan="2">Commentaire</th>
								        <th class="td-center">Publié par</th>
								        <th class="td-center">Action</th>
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