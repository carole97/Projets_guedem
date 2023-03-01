<?php
session_start();
include("db/DBout.php");

if (!isset($_SESSION['user_logged'])) {
	header("Location:index.php");
}

include("header.php");
include("navigation.php");

$sql = "SELECT u_adress,u_postal_code,u_email,u_password FROM users WHERE id='".$_SESSION['user_logged']."'";
$query = $pdo_var->query($sql);
$row = $query->fetch();

?>

<div class="row banner-inner"></div>

<div class="row row-padding row-white fond-blanc">
	<br/>
	<div class="container">	
		<div class="row">

			<div class="col-md-6">
				<div class="div-100 white-wrapper containeur-connexion">
					<h3>Modifier le profile utilisateur</h3>
					<hr>
					<form method="POST" action="db/functions.php">
						<div class="row">
							<div class="col-sm-9">
								<label>Adresse</label>
								<input type="text" name="update_user_address" placeholder="Entrer la nouvelle adresse ..." required value="<?php echo $row['u_adress']; ?>">
							</div>
							<div class="col-sm-3">
								<label>Code postal</label>
								<input type="text" name="update_user_postal" placeholder="Postale" required value="<?php echo $row['u_postal_code']; ?>">
							</div>
							<div class="col-sm-12">
								<label>Email</label>
								<input type="email" name="update_user_email" placeholder="Entrer le nouvel email ..." required value="<?php echo $row['u_email']; ?>">
							</div>
							<div class="col-sm-12">
								<label>Mot de passe</label>
								<input type="password" name="update_user_password" placeholder="Entrer le nouveau mot de passe ..." value="">
							</div>
							<div class="col-sm-6">
								<button name="submit_profile_update" type="submit" class="btn btn-danger">Mettre à jours</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="col-md-1">
				<div class="separateur-vert"></div>
			</div>
			<div class="col-md-5">
				<div class="div-100 white-wrapper containeur-connexion">
					
				</div>
			</div>

		</div>	
	</div>
</div>

<?php
include("footer.php");
?>