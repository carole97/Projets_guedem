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
            <a href="dashboard.php"><i class="far fa-file-alt"></i> Blog/News</a>
          </li>
          <li>
            <a href="usermngt.php"><i class="fa fa-user"></i> Utilisateurs</a>
          </li>
          <li>
            <a href="articles.php"><i class="fas fa-shopping-basket"></i> Gestion articles</a>
          </li>

        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Compte admin <i class="fa fa-caret-down"></i></a>
              <ul class="dropdown-menu dropdown-bottom-border">
                <li><a href="db/logout.php">Se déconnecter</a></li>
              </ul>
          </li>          
        </ul>
      </div><!-- /.navbar-collapse -->
    </div>

  </div><!-- /.container-fluid -->
</nav>

<div class="container-fluid">