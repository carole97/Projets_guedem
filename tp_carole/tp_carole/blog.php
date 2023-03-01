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
					
					<div class="col-md-6">
						<h3>Notre Blog / News</h3>	
					</div>
					<div class="col-md-6">
						<a href="blog.php" class="btn btn-default blog-back-btn"><i class="fa fa-arrow-left"></i> Toutes les actualités</a>
					</div>
					<div class="div-100 blog-search-wrapper">
						<form action="blog.php" method="POST">
							<input type="text" name="comment_search" placeholder="Rechercher dans le blog..." required>
							<button name="submit_blog_research" class="btn btn-danger"><i class="fa fa-search"></i></button>
						</form>
					</div>
					<br/><br/><br/>
					<div class="row">
						<br/><br/>

						<?php 

							if (isset($_POST["submit_blog_research"])) {

								$search_title = htmlspecialchars($_POST["comment_search"]);

								$sql = "SELECT * FROM blog WHERE blog_title like '%".$search_title."%'";
								$query = $pdo_var->query($sql);
								$count = $query->rowcount();
							}
							else{
								$sql = "SELECT * FROM blog";
								$query = $pdo_var->query($sql);
								$count = $query->rowcount();
							}

							if ($count>0) {
								while ($row=$query->fetch()) {
						?>
									<div class="col-sm-4">
										<div class="blog-containeur">
											<h4><?php echo $row['blog_title']; ?></h4>
											<hr>
											<p class="contenu-blog"><?php echo $row['blog_content']; ?></p>
											<a href="blogdetails.php?blogId=<?php echo $row['id']; ?>" class="btn btn-danger">Voir plus</a>
										</div>
									</div>
						<?php
								}

							}
							else{
								echo '<div class="col-sm-12">
									<h4 class="empty-blog">Pas de publication</h4>
								</div>';
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