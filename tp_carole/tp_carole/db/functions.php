<?php
session_start(); // COMMENCER UNE SESSION
include("DBout.php");


// SOUSCRIPTION D'UN UTILISATEUR
if (isset($_POST['user_subscribe'])) {
	
	$first_name = htmlspecialchars($_POST["u_first_name"]);
	$last_name = htmlspecialchars($_POST["u_last_name"]);
	$adress = htmlspecialchars($_POST["u_adress"]);
	$postal = htmlspecialchars($_POST["u_postal"]);
	$date_birth = htmlspecialchars($_POST["u_date_birth"]);
	$email = htmlspecialchars($_POST["u_email"]);
	$pseudo = htmlspecialchars($_POST["u_pseudo"]);
	$pass = md5($_POST["u_pass"]);

	$sql = "INSERT INTO users(u_fname,u_lname,u_adress,u_postal_code,u_date_of_birth,u_email,u_pseudo,u_password) VALUES('$first_name','$last_name','$adress','$postal','$date_birth','$email','$pseudo','$pass')";
	$query = $pdo_var->exec($sql);

	if ($query) {
		header("Location:../login.php?subsc=success");
	}
	else{
		header("Location:../login.php?subsc=failure");	
	}

} // END FX


// IDENTIFICATION UTILISATEUR
if (isset($_POST["user_login"])) {

	$user_name = htmlspecialchars($_POST["user_login_id"]);
	$user_password = md5($_POST["user_login_pass"]);

	$sql = "SELECT * FROM users WHERE u_pseudo='$user_name' AND u_password='$user_password'";
	$query = $pdo_var->query($sql);
	$count = $query->rowcount();

	if ($count>0) { // si le login est correcte

		$row = $query->fetch(); 

		if ($row['u_status']==1) { // si le compte utilisateur n'est pas desactivé
			
			$_SESSION['user_logged'] = $row["id"];

			// ajouter la tentative dans la table
			$sql = "INSERT INTO connexion_attempts(u_id,con_status) VALUES('".$row["id"]."','1')";
			$query = $pdo_var->exec($sql);

			header("Location:../index.php");

		}
		else{
			// ajouter la tentative dans la table
			$sql = "INSERT INTO connexion_attempts(u_id) VALUES('".$row["id"]."')";
			$query = $pdo_var->exec($sql);
			header("Location:../deactivated.php");			
		}
		
	}
	else{
		// ajouter la tentative dans la table
		$sql = "INSERT INTO connexion_attempts(u_id) VALUES('0')";
		$query = $pdo_var->exec($sql);
		header("Location:../login.php?auth=failed");
	}

} // END FX


// IDENTIFICATION ADMINISTRATEUR
if (isset($_POST["admin_login"])) {
	
	$admin_name = htmlspecialchars($_POST["admin_login_id"]);
	$admin_password = md5($_POST["admin_login_pass"]);

	$sql = "SELECT * FROM admin WHERE a_pseudo='$admin_name' AND a_password='$admin_password'";
	$query = $pdo_var->query($sql);
	$count = $query->rowcount();

	if ($count>0) {
		$row = $query->fetch(); 
		$_SESSION['user_logged'] = 0;
		$_SESSION['admin_session'] = $row["id"];
		header("Location:../dashboard.php");
	}
	else{
		header("Location:../adminlogin.php?auth=failed");
	}

} // END FX


// METTRE A JOUR LE PROFILE UTILISATEUR
if (isset($_POST["submit_profile_update"])) {
	
	$address = htmlspecialchars($_POST["update_user_address"]);
	$postal = htmlspecialchars($_POST["update_user_postal"]);
	$email = htmlspecialchars($_POST["update_user_email"]);
	$passwd = htmlspecialchars($_POST["update_user_password"]);

	if ($passwd!="") {
		$hashed_pass = md5($passwd);
		$sql = "UPDATE users SET u_adress='".$address."',u_postal_code='".$postal."',u_email='".$email."',u_password='".$hashed_pass."' WHERE id='".$_SESSION['user_logged']."'";
	}
	else{
		$sql = "UPDATE users SET u_adress='".$address."',u_postal_code='".$postal."',u_email='".$email."' WHERE id='".$_SESSION['user_logged']."'";
	}

	$query = $pdo_var->prepare($sql);

	if ($query->execute()) {
		header("Location:../profile.php");
	}

} // END FX


// PUBLIER UN COMMENTAIRE
if (isset($_POST["submit_comment"])) {
	
	$comment_text = htmlspecialchars($_POST["comment_text"]);
	$comment_blog_id = htmlspecialchars($_POST["comment_blog"]);

	$sql = "INSERT INTO comments(content,blog_id,user_id) VALUES('$comment_text','$comment_blog_id','".$_SESSION['user_logged']."')";
	$query = $pdo_var->exec($sql);

	if ($query) {
		header("Location:../blogdetails.php?blogId=".$comment_blog_id);
	}

} // END FX


// 
if (isset($_POST["submit_chat"])) {
	
	$chat_user_id = htmlspecialchars($_POST["sender_id"]);
	$chat_user_message = htmlspecialchars($_POST["sender_message"]);

	$sql = "INSERT INTO chat(user_id,chat_message) VALUES('".$chat_user_id."','".$chat_user_message."')";
	$query = $pdo_var->exec($sql);

	if ($query) {
		$out = 1;
		echo json_encode($out);
	}
	else{
		$out = 0;
		echo json_encode($out);
	}
}


// RECUPERER LE CHAT A PARTIR DE LA BASE DE DONNEES
if (isset($_POST["fetch_chat"])) {
	
	$sql = "SELECT * FROM (SELECT *,DATE_FORMAT(chat_time,'%d/%m/%Y %H:%i:%s') AS chd FROM chat ORDER BY id DESC LIMIT 10) as forder ORDER BY forder.id ASC";
	$query = $pdo_var->query($sql);
	$count = $query->rowcount();

	if ($count>0) {
		while ($row=$query->fetch()) {

			$sql1 = "SELECT * FROM users WHERE id='".$row["user_id"]."' ORDER BY id DESC LIMIT 10";
			$query1 = $pdo_var->query($sql1);
			$row1 = $query1->fetch();

			if ($row["user_id"]==0) {
				$pseudo = "administrateur";
			}
			else{
				$pseudo = $row1["u_pseudo"];
			}

			if ($row["user_id"]==$_SESSION['user_logged']) {
				echo '
					<div class="chat-box-content-left chat-box-content-right">
						<span>@'.$pseudo.' <i>'.$row["chd"].'</i></span>
						<hr class="hr_style" />
						'.$row["chat_message"].'
					</div>
				';
			}
			else{
				echo '
					<div class="chat-box-content-left">
						<span>@'.$pseudo.' <i>'.$row["chd"].'</i></span>
						<hr class="hr_style" />
						'.$row["chat_message"].'
					</div>
				';
			}

		}
	}
	else{
		echo "<h4 class='no-chat-message'>Pas de chat actif</h4>";
	}

} // END FX


// AJOUTER UN PRODUIT AU PANIER
if (isset($_POST["addToCart"])) {
	
	$prodId = htmlspecialchars($_POST["form_id"]);
	$prodQty = htmlspecialchars($_POST["quantity"]);

	if (!empty($prodQty)) {
		
		$sql = "SELECT * FROM products WHERE id='".$prodId."'";
		$query = $pdo_var->query($sql);
		$row = $query->fetch(PDO::FETCH_ASSOC);

		$itemArray = array($row["id"]=>array('product_name'=>$row["prod_name"], 'code'=>$row["prod_code"], 'quantity'=>$prodQty, 'product_price'=>$row["prod_price"],'product_id'=>$row["id"]));

		// , 'product_image'=>$row["product_image"]

		if(!empty($_SESSION["cart_item"])) {
			if(in_array($row["id"],array_keys($_SESSION["cart_item"]))) {
				foreach($_SESSION["cart_item"] as $k => $v) {
					if($row["id"] == $k) {
						if(empty($_SESSION["cart_item"][$k]["quantity"])) {
							$_SESSION["cart_item"][$k]["quantity"] = 0;
						}
						else{
							$_SESSION["cart_item"][$k]["quantity"] += $prodQty;	
						}
					}
				}
			} else {
				$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
			}
		} else {
			$_SESSION["cart_item"] = $itemArray;
		}

		header("Location:../achat.php");

	}

} // END FX


// AJOUTER UN BLOG
if (isset($_POST["publish_blog"])) {
	
	$title = htmlspecialchars($_POST["blog_title"]);
	$content = htmlspecialchars($_POST["blog_content"]);

	$sql = "INSERT INTO blog(blog_title,blog_content) VALUES('".$title."','".$content."')";
	$query = $pdo_var->exec($sql);

	if ($query) {
		header("Location:../dashboard.php");
	}


} // END FX


// EDITER UN BLOG
if (isset($_POST["update_blog"])) {
	
	$updated_blog_id = htmlspecialchars($_POST['update_blog_id']);
	$updated_title = htmlspecialchars($_POST['update_blog_title']);
	$updated_content = htmlspecialchars($_POST['update_blog_content']);

	$sql = "UPDATE blog SET blog_title='".$updated_title."',blog_content='".$updated_content."' WHERE id='".$updated_blog_id."'";

	$query = $pdo_var->prepare($sql);

	if ($query->execute()) {
		header("Location:../dashblog.php");
	}

} // END FX


// SUPPRIMER UN BLOG
if (isset($_GET['blogID'])) {
	
	$BlogID = htmlspecialchars($_GET['blogID']);

	$sql = "DELETE FROM blog WHERE id='".$BlogID."'";
	$query = $pdo_var->prepare($sql);

	if ($query->execute()) {
		header("Location:../dashboard.php");
	}

} // END FX


// SUPPRIMER UN COMMENTAIRE
if (isset($_GET["comID"])) {
	
	$com_id = htmlspecialchars($_GET["comID"]);
	$blog_id = htmlspecialchars($_GET["bloID"]);

	$sql = "DELETE FROM comments WHERE id='".$com_id."'";
	$query = $pdo_var->prepare($sql);

	if ($query->execute()) {
		header("Location:../dashblog.php?blog_id=".$blog_id);
	}

} // END FX


// BLOQUER UN UM INDESIRABLE
if (isset($_GET["block_uID"])) {
	
	$blocked_id = htmlspecialchars($_GET["block_uID"]);

	$sql = "UPDATE users SET u_status='0' WHERE id='".$blocked_id."'";
	$query = $pdo_var->prepare($sql);

	if ($query->execute()) {
		header("Location:../usermngt.php");
	}

} // END FX


// DEBLOQUER UN UM BLOQUE
if (isset($_GET["unblock_uID"])) {
	
	$unblocked_id = htmlspecialchars($_GET["unblock_uID"]);

	$sql = "UPDATE users SET u_status='1' WHERE id='".$unblocked_id."'";
	$query = $pdo_var->prepare($sql);

	if ($query->execute()) {
		header("Location:../usermngt.php");
	}

} // END FX


// AJOUTER UN PRODUIT
if (isset($_POST["prod_submit"])) {

	$code = bin2hex(random_bytes(5));
	$name = htmlspecialchars($_POST["prod_name"]);
	$price = htmlspecialchars($_POST["prod_price"]);
	$cat = htmlspecialchars($_POST["prod_cat"]);

	$sql = "INSERT INTO products(prod_code,prod_name,prod_price,cat_id) VALUES('".$code."','".$name."','".$price."','".$cat."')";
	$query = $pdo_var->exec($sql);

	if ($query) {
		header("Location:../articles.php");
	}
	
} // END FX 


// SUPPRIMER UN PRODUIT
if (isset($_GET["del_prodID"])) {
	
	$del_id = htmlspecialchars($_GET["del_prodID"]);

	$sql = "DELETE FROM products WHERE id='".$del_id."'";
	$query = $pdo_var->prepare($sql);

	if ($query->execute()) {
		header("Location:../articles.php");
	}
}



?>