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
					
					<div class="row">
						<div class="col-md-12">
							<h3 class="txt-centered">Error de connexion</h3>	
							<hr>
						</div>
						<div class="col-md-12">
							<div class="div-100 unauthorized-section">
								<i class="fas fa-exclamation-triangle"></i>
								<h3>Tentative dangereuse</h3>
								<p>Votre accès a ce compte a été bloqué, veuillez contacter l'administrateur.</p>
								<br/><br/>
								<a href="login.php" class="btn btn-danger"> s'inscrire / se connecter</a>
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