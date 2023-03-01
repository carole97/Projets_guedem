<?php
session_start();
if (isset($_GET["blogId"])) {

$Blogid = htmlspecialchars($_GET["blogId"]);
	
include("db/DBout.php");
include("header.php");
include("navigation.php");

$sql = "SELECT * FROM blog WHERE id='$Blogid'";
$query = $pdo_var->query($sql);
$count = $query->rowcount();
$row = $query->fetch();

// FETCH BLOG'S COMMENTS 
$sql1 = "SELECT * FROM comments WHERE blog_id='$Blogid' ORDER BY id desc";
$query1 = $pdo_var->query($sql1);
$count1 = $query1->rowcount();


if (!$count>0) {
	// au cas ou l'ID ne correspond pas a un blog existant
	header("Location:blog.php");
}

?>

<div class="row banner-inner"></div>

<div class="row row-padding row-white fond-blanc">
	<div class="container">	
		<div class="row">

			<div class="col-md-12">
				<div class="div-100 white-wrapper containeur-connexion">
					<h3>Notre Blog / News</h3>
					<hr>
					<div class="row">
						<br/><br/>
						
						<div class="col-sm-8">
							<div class="blog-containeur-details">

								<a href="blog.php" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Voir tout</a>
								<h2><?php echo $row["blog_title"]; ?></h2>
								<hr>
								<p><?php echo $row["blog_content"]; ?></p>
								
								<?php

									if (isset($_SESSION['user_logged'])) {
										?>
										<div class="row">
											<div class="col-sm-1">
												<div class="div-100 comments-pic">
													<img src="images/avatar.jpeg" alt="no image">
												</div>
											</div>
											<div class="col-sm-11">
												<div class="div-100 comment-box">
													<form action="db/functions.php" method="POST">
														<textarea name="comment_text" rows="3" placeholder="Ajouter un commentaire..."></textarea>
														<input type="hidden" name="comment_blog" value="<?php echo $Blogid; ?>">
														<div class="comment-button">
															<button name="submit_comment" type="submit" class="btn btn-success">Publier</button>
														</div>
													</form>
												</div>
											</div>
										</div>
										<?php
									}
									else{
										?>
										<div class="row">
											<div class="col-sm-1">
												<div class="div-100 comments-pic">
													<img src="images/avatar.jpeg" alt="no image">
												</div>
											</div>
											<div class="col-sm-11">
												<div class="div-100 comment-box">
													<textarea name="comment_text" rows="3" placeholder="Ajouter un commentaire..."></textarea>
													<div class="comment-button">
														<a class="btn btn-success" href="login.php">Connectez-vous pour publier</a>
													</div>
												</div>
											</div>
										</div>
										<?php
									}

								?>
								<?php 
									// AFFICHER LES COMMENTAIRES DU BLOG
									if ($count1>0) {
										while ($row1=$query1->fetch()) {
											$sql2="SELECT * FROM users WHERE id='".$row1['user_id']."'";
											$query2=$pdo_var->query($sql2);
											$row2=$query2->fetch();
										?>
											<div class="row">
												<div class="col-sm-1"></div>
												<div class="col-sm-11">
													<div class="div-100 commented-box">
														<h4><?php echo ucfirst($row2["u_fname"])." ".ucfirst($row2["u_lname"]); ?></h4>
														<p><?php echo $row1["content"]; ?></p>
													</div>
												</div>
											</div>
										<?php
										}
									}
									else{
										
										?>
											<div class="row">
												<div class="col-sm-1"></div>
												<div class="col-sm-11">
													<div class="div-100 commented-box">
														<h4 class="empty-blog">Pas de commentaires</h4>
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
	</div>
</div>

<?php
include("footer.php");
}
else{
	echo"<h3>The blog chosen does not exist</h3>";
}

?>