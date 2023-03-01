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
							<h3 class="txt-centered">Mini-chat</h3>	
							<hr>
						</div>
						<?php

							if (!isset($_SESSION['user_logged'])) {
							?>
								<div class="col-md-12">
									<div class="div-100 unauthorized-section">
										<i class="fas fa-exclamation-triangle"></i>
										<h3>Accès non autorisé à cette section</h3>
										<p>Les services de l'espace mini-chat sont exclusivement réservés aux UM authentifiés.</p>
										<br/><br/>
										<a href="login.php" class="btn btn-danger"> s'inscrire / se connecter</a>
									</div>
								</div>
							<?php
							}	
							else{
							?>	
								<div class="col-md-1"></div>
								<div class="col-md-4">
									<br/><br/><br/><br/><br/><br/><br/>
									<div class="div-100 div-img">
										<img src="images/login-signup-bg.png" alt="" />
									</div>
								</div>
								<div class="col-md-1"></div>
								<div class="col-md-6">
									<div class="div-100 chat-box">
										
										<div class="chat-box-body">
											<div class="chat-box-body-scroll" id="display-chat"></div>
										</div>
										<div class="chat-box-footer">
											<input type="hidden" id="sender-id" value="<?php echo $_SESSION['user_logged']; ?>">
											<textarea id="chat-text" rows="4" placeholder="Entrer le message..."></textarea>
											<button id="submit-chat" class="btn btn-danger">Envoyer</button>
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

<?php
include("footer.php");
?>