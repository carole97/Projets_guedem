<?php
session_start();
include("header.php");
include("navigation.php");
?>

<div class="row banner-inner"></div>

<div class="row row-padding row-white fond-blanc">
	<br/>
	<div class="container">	
		<div class="row">

			<div class="col-md-5">
				<div class="div-100 white-wrapper containeur-connexion">
					<h3>Connexion administrateur</h3>
					<hr>
					<form method="POST" action="db/functions.php">
						<div class="row">
							<div class="col-sm-12">
								<label>Identifiant</label>
								<input type="text" name="admin_login_id" placeholder="Entrer votre identifiant ..." required>
							</div>
							<div class="col-sm-12">
								<label>Mot de passe</label>
								<input type="password" name="admin_login_pass" placeholder="Entrer votre mot de passe ..." required>
								<br/>
								<span>Etes-vous Utilisateur ? <a href="login.php"> s'inscrire / se connecter</a></span>
							</div>
							<div class="col-sm-6">
								<br/>
								<button name="admin_login" type="submit" class="btn btn-danger">S'identifier</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="col-md-1">
				<div class="separateur-vert"></div>
			</div>
			<div class="col-md-6">
				<div class="div-100 white-wrapper containeur-connexion">

				</div>
			</div>

		</div>	
	</div>
</div>

<?php
include("footer.php");
?>