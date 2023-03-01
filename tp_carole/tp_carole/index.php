<?php
session_start();
include("header.php");
include("navigation.php");
?>

<div class="row row-padding banner">
	<div class="banner-top">
		<div class="container">
			<div class="promo-banner">
				<br/>
				<p>Obtenez jusqu'à</p>
				<h2><strong>30%</strong> de <i>Réduction</i></h2>
				<span>Sur chaque achat d'au moin 30&euro;</span>
			</div>
		</div>	
	</div>
</div>

<div class="row fond-blanc">
	<div class="container">		
		<div class="row">
				
			<div class="col-md-8">
				<br/><br/>
				<div class="panel-group" id="accordion">
				    <div class="panel panel-default">
				      <div class="panel-heading">
				        <h4 class="panel-title">
				          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Collapsible Group 1</a>
				        </h4>
				      </div>
				      <div id="collapse1" class="panel-collapse collapse in">
				        <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
				        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
				      </div>
				    </div>
				    <div class="panel panel-default">
				      <div class="panel-heading">
				        <h4 class="panel-title">
				          <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Collapsible Group 2</a>
				        </h4>
				      </div>
				      <div id="collapse2" class="panel-collapse collapse">
				        <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
				        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
				      </div>
				    </div>
				    <div class="panel panel-default">
				      <div class="panel-heading">
				        <h4 class="panel-title">
				          <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Collapsible Group 3</a>
				        </h4>
				      </div>
				      <div id="collapse3" class="panel-collapse collapse">
				        <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
				        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
				      </div>
				    </div>
				</div> 
				<br/><br/><br/><br/>
			</div>
			<div class="col-md-4">
				<div class="connexion-accueil">
					<div class="row">
						<div class="div-100 white-wrapper">
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
									<div class="col-sm-8">
										<br/>
										<button name="user_login" type="submit" class="btn btn-danger">S'identifier</button>
									</div>
								</div>
							</form>
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