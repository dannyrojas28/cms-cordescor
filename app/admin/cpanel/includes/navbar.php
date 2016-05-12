


<div class="col-md-3 left_col">
        <div class="left_col scroll-view">

          <div class="navbar nav_title" style="border: 0;">
            <a href="../" class="site_title"><i class="fa fa-leaf"></i> <span>Panel Admin</span></a>
          </div>
          <div class="clearfix"></div>

          <!-- menu prile quick info -->
          <div class="profile">
            <div class="profile_pic">
              <img src="images/user.png" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Bienvenido,</span>
              <h2><?php echo $_SESSION['FIRSTNAME']." ".$_SESSION['LASTNAME']; ?></h2>
            </div>
          </div>
          <!-- /menu prile quick info -->

          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

            <div class="menu_section">
              <h3>General</h3>
              <ul class="nav side-menu">
                <li><a href="index.php"><i class="fa fa-home"></i> Inicio </a>
          
                </li>
                <li><a><i class="fa fa-users"></i> Usuarios Admin<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="listar.php">Listar</a>
                    </li>
                    <li><a href="nuevosusers.php">Nuevo Usuario</a>
                    </li>
                  </ul>
                </li>
                
                <li><a><i class="fa fa-desktop"></i> Info Web <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="logo.php">Cargar/Editar Logo</a>
                    </li>
                    <li><a href="sliders.php">Cargar/Editar Sliders</a>
                    </li>
                    <li><a href="quienes_somos.php">Cargar/Editar Quienes Somos</a>
                    </li>
                    <li><a href="mision.php">Cargar/Editar Mision</a>
                    </li>
                    <li><a href="vision.php">Cargar/Editar Vision</a>
                    </li>
                    
                  </ul>
                </li>
                <li><a><i class="fa fa-folder-open-o"></i> Proyectos <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="listarproyecto.php">Listar</a>
                    </li>
                    <li><a href="nuevoproyecto.php">Nuevo Proyecto</a>
                    </li>
                  </ul>
                </li>
                <li><a><i class="fa fa-file-pdf-o"></i> Informes <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="listarinforme.php">Listar</a>
                    </li>
                    <li><a href="nuevoinforme.php">Nuevo Informe</a>
                    </li>
                  </ul>
                </li>
              </ul>
            </div><!--
            <div class="menu_section">
              <h3>Live On</h3>
              <ul class="nav side-menu">
                <li><a><i class="fa fa-bug"></i> Additional Pages <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="e_commerce.html">E-commerce</a>
                    </li>
                    <li><a href="projects.html">Projects</a>
                    </li>
                    <li><a href="project_detail.html">Project Detail</a>
                    </li>
                    <li><a href="contacts.html">Contacts</a>
                    </li>
                    <li><a href="profile.html">Profile</a>
                    </li>
                  </ul>
                </li>
                <li><a><i class="fa fa-windows"></i> Extras <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="page_404.html">404 Error</a>
                    </li>
                    <li><a href="page_500.html">500 Error</a>
                    </li>
                    <li><a href="plain_page.html">Plain Page</a>
                    </li>
                    <li><a href="login.html">Login Page</a>
                    </li>
                    <li><a href="pricing_tables.html">Pricing Tables</a>
                    </li>
                  </ul>
                </li>
                <li><a><i class="fa fa-sitemap"></i> Multilevel Menu <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                      <li><a href="#level1_1">Level One</a>
                      <li><a>Level One<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                          <li class="sub_menu"><a href="level2.html">Level Two</a>
                          </li>
                          <li><a href="#level2_1">Level Two</a>
                          </li>
                          <li><a href="#level2_2">Level Two</a>
                          </li>
                        </ul>
                      </li>
                      <li><a href="#level1_2">Level One</a>
                      </li>
                  </ul>
                </li>
                <li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a>
                </li>

              </ul>
            </div>

                -->
          </div>
          <!-- /sidebar menu -->

          <!-- /menu footer buttons 
          <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
              <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
              <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
              <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout">
              <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
          </div>
           /menu footer buttons -->
        </div>
      </div>


       <!-- top navigation -->
      <div class="top_nav">

        <div class="nav_menu">
          <nav class="" role="navigation">
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
              <li class="">
                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <img src="images/user.png" alt=""><?php echo $_SESSION['FIRSTNAME']." ".$_SESSION['LASTNAME']; ?>
                  <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu pull-right">
                  <li><a href="perfil.php">  Perfil</a>
                  </li>
                  <li><a href="destroy/"><i class="fa fa-sign-out pull-right"></i> Salir</a>
                  </li>
                </ul>
              </li>

              

            </ul>
          </nav>
        </div>

      </div>
      <!-- /top navigation -->