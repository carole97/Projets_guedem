<nav class="navbar navbar-default nav-bar">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <div class="container">
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          
          <li>
            <a href="index.php"><i class="fas fa-home"></i> Accueil</a>
          </li>
          <li>
            <a href="chat.php"><i class="far fa-comment-dots"></i> Mini-chat</a>
          </li>
          <li>
            <a href="blog.php"><i class="far fa-file-alt"></i> Blog-News</a>
          </li>
          <li>
            <a href="achat.php"><i class="fas fa-shopping-basket"></i> Achat de materiels</a>
          </li>

        </ul>
        <ul class="nav navbar-nav navbar-right">

          <li class="cart-wrapper">
            <a href="cart.php"><i class="fas fa-shopping-basket"></i> Cart <span class="badge">
              <?php 
                if(isset($_SESSION["cart_item"])) {
                    
                  $item_total = $_SESSION["cart_item"];
                  echo count($item_total);

                }else{
                  echo 0;
                }
              ?>
            </span></a>
          </li>

          <?php 

            if (!isset($_SESSION['user_logged'])) {
                echo '
                  <li class="<?php echo $menu3 ?>">
                    <a href="login.php"><i class="far fa-user"></i> s\'inscrire / se connecter</a>
                  </li> 
                ';
            }
            else{
              echo '
                <li class="dropdown <?php echo $menu4 ?>">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Modifier profil / Se déconnecter <i class="fa fa-caret-down"></i></a>
                    <ul class="dropdown-menu dropdown-bottom-border">
                      <li><a href="profile.php">Modifier mon profile</a></li>
                      <li><a href="orders.php">Mes commandes</a></li>
                      <li><a href="db/logout.php">Se déconnecter</a></li>
                    </ul>
                </li>
              ';
            }

          ?>
          
        </ul>
      </div><!-- /.navbar-collapse -->
    </div>

  </div><!-- /.container-fluid -->
</nav>

<div class="container-fluid">