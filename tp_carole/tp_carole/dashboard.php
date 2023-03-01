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
						<h3>Publier un blog</h3>
						<hr/>	
						<div class="row">
							<form action="db/functions.php" method="POST">
								<div class="col-sm-12">
									<label>Titre du blog</label>
									<textarea name="blog_title" placeholder="Entrer le titre du blog" rows="5" required></textarea>
								</div>
								<div class="col-sm-12">
									<label>Contenu du blog</label>
									<textarea name="blog_content" placeholder="Entrer le contenu du blog" rows="5" required></textarea>
								</div>
								<div class="col-sm-4">
									<br/>
									<button name="publish_blog" type="submit" class="btn btn-danger">Publier le blog</button>
								</div>
							</form>
						</div>
					</div>
					<div class="col-md-2"></div>
					<div class="col-md-5">
						<h3>Liste des blogs</h3>
						<hr/>	
						<div class="row">
							<div class="col-sm-12">
								
								<table class="table table-bordered">
								    <thead>
								      <tr>
								        <th class="td-center">No.</th>
								        <th colspan="2">Titre du blog</th>
								        <th class="td-center">Action</th>
								      </tr>
								    </thead>
								    <tbody>
								      <?php

										$sql = "SELECT * FROM blog";
										$query = $pdo_var->query($sql);
										$count = $query->rowcount();

										if($count>0){
											$no = 1;
											while ($row=$query->fetch()) {
								      ?>
								      <tr>
								      	<th class="td-center"><?php echo $no; ?></th>
								        <td colspan="2"><?php echo $row["blog_title"]; ?></td>
								        <td class="td-center">
								        	<ul class="actions-list">
								        		<li><a href="dashblog.php?blog_id=<?php echo $row['id']; ?>" class="btn btn-warning">
								        			<i class="fa fa-edit"></i>
								        		</a></li>
								        		<li><a href="db/functions.php?blogID=<?php echo $row['id']; ?>" class="btn btn-danger">
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
												<td class="empty-blog" colspan="4">Pas de publication</td>
											<?php
										}

								      ?>
								    </tbody>
								    <tfoot>
								      <tr>
								        <th class="td-center">No.</th>
								        <th colspan="2">Titre du blog</th>
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