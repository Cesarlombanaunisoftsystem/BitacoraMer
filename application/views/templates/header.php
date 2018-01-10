<header class="main-header">
  <a href="<?= base_url('Home')?>" class="logo">
    <span class="logo-mini">bt</span>
    <span class="logo-lg"><b></b></span>
  </a>
  <nav class="navbar navbar-static-top">
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </a>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?= base_url('dist/img/silueta.png')?>" class="user-image get-user-image" alt="Imagen">
            <span class="hidden-xs get-user-name">user</span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
                <img src="<?= base_url('dist/img/silueta.png')?>" class="img-circle get-user-image" alt="Imagen">
              <p>
                <b class="get-user-name">user</b>
                <small class="get-user-enterprise">Admin</small>
              </p>
            </li>
            <li class="user-footer">
              <div class="pull-left">
                <a href="<?= base_url('Users/profile')?>" class="btn btn-default btn-flat">Perfil</a>
              </div>
              <div class="pull-right">
                <a href="<?= base_url('Login/logout_ci')?>" class="btn btn-default btn-flat">Salir</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
