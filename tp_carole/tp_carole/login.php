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
					<h3>Se connecter</h3>
					<hr>
					<form method="POST" action="db/functions.php">
						<div class="row">
							<div class="col-sm-12">
								<label>Identifiant</label>
								<input type="text" name="user_login_id" placeholder="Entrer votre identifiant ..." required>
							</div>
							<div class="col-sm-12">
								<label>Mot de passe</label>
								<input type="password" name="user_login_pass" placeholder="Entrer votre mot de passe ..." required>
								<br/>
								<span>Etes-vous administrateur ? <a href="adminlogin.php">connectez-vous ici</a></span>
							</div>
							<div class="col-sm-6">
								<br/>
								<button name="user_login" type="submit" class="btn btn-danger">S'identifier</button>
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
					<h3>S'inscrire</h3>
					<hr>
					<form action="db/functions.php" method="POST">
						<div class="row">
							<div class="col-sm-6">
								<label>Prénom</label>
								<input type="text" name="u_first_name" placeholder="Entrer votre identifiant ..." required>
							</div>
							<div class="col-sm-6">
								<label>Nom</label>
								<input type="text" name="u_last_name" placeholder="Entrer votre identifiant ..." required>
							</div>
							<div class="col-sm-9">
								<label>Adresse</label>
								<input type="text" name="u_adress" placeholder="Entrer votre adresse ..." required>
							</div>
							<div class="col-sm-3">
								<label>Code postal</label>
								<input type="text" name="u_postal" placeholder="Zip code" required>
							</div>
							<div class="col-sm-5">
								<label>Date de naissance</label>
								<input type="date" name="u_date_birth" placeholder="date de naissance" required>
							</div>
							<div class="col-sm-7">
								<label>Adresse email</label>
								<input type="email" name="u_email" placeholder="Entrer votre email ..." required>
							</div>
							<div class="col-sm-12">
								<label>Votre pseudo</label>
								<input type="text" name="u_pseudo" placeholder="Entrer votre identifiant ..." required>
							</div>
							<div class="col-sm-12">
								<label>Mot de passe</label>
								<input type="password" name="u_pass" placeholder="Entrer votre mot de passe ..." required>
							</div>
							<div class="col-sm-6">
								<button type="submit" name="user_subscribe" class="btn btn-danger">S'identifier</button>
							</div>
						</div>
					</form>

				</div>
			</div>

		</div>	
	</div>
</div>

<?php
include("footer.php");
?>