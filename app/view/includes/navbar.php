<!-- Site Header -->
            <header>
                <div class="container">
                    <!-- Site Logo -->
                    <a href="/cms-cordescor/app/view/inicio/" class="site-logo">
                      <img src="../../../public/img/logo-app.png" style="width: 110px;height: 55px">
                    </a>
                    <!-- Site Logo -->

                    <!-- Site Navigation -->
                    <nav>
                        <!-- Menu Toggle -->
                        <!-- Toggles menu on small screens -->
                        <a href="javascript:void(0)" class="btn btn-default site-menu-toggle visible-xs visible-sm">
                            <i class="fa fa-bars"></i>
                        </a>
                        <!-- END Menu Toggle -->

                        <!-- Main Menu -->
                        <ul class="site-nav">
                            <!-- Toggles menu on small screens -->
                            <li class="visible-xs visible-sm">
                                <a href="javascript:void(0)" class="site-menu-toggle text-center">
                                    <i class="fa fa-times"></i>
                                </a>
                            </li>
                            <!-- END Menu Toggle -->
                            <li <?php if($url == "inicio") echo 'class="active"'; ?> >
                                <a href="/cms-cordescor/app/view/inicio/">Inicio</a>
                               <!-- <ul>
                                    <li>
                                        <a href="index.html" class="active">Full Width</a>
                                    </li>
                                    <li>
                                        <a href="index_alt.html">Full Width (Dark)</a>
                                    </li>
                                    <li>
                                        <a href="index_parallax.html">Full Width Parallax</a>
                                    </li>
                                    <li>
                                        <a href="index_boxed.html">Boxed</a>
                                    </li>
                                    <li>
                                        <a href="index_boxed_alt.html">Boxed (Dark)</a>
                                    </li>
                                    <li>
                                        <a href="index_boxed_parallax.html">Boxed Parallax</a>
                                    </li>
                                </ul>-->
                            </li>
                            <li <?php if($url == "nosotros") echo 'class="active"'; ?>>
                                <a href="/cms-cordescor/app/view/nosotros/">Nosotros</a>
                               <!-- <ul>
                                    <li>
                                        <a href="blog.html">Blog</a>
                                    </li>
                                    <li>
                                        <a href="blog_post.html">Blog Post</a>
                                    </li>
                                    <li>
                                        <a href="portfolio_4.html">Portfolio 4 Columns</a>
                                    </li>
                                    <li>
                                        <a href="portfolio_3.html">Portfolio 3 Columns</a>
                                    </li>
                                    <li>
                                        <a href="portfolio_2.html">Portfolio 2 Columns</a>
                                    </li>
                                    <li>
                                        <a href="portfolio_single.html">Portfolio Single</a>
                                    </li>
                                    <li>
                                        <a href="team.html">Team</a>
                                    </li>
                                    <li>
                                        <a href="helpdesk.html">Helpdesk</a>
                                    </li>
                                    <li>
                                        <a href="jobs.html">Jobs</a>
                                    </li>
                                    <li>
                                        <a href="how_it_works.html">How it works</a>
                                    </li>
                                </ul>-->
                            </li>
                            <li <?php if($url == "proyectos") echo 'class="active"'; ?>>
                                <a href="/cms-cordescor/app/view/proyectos/">Proyectos</a>
                            </li>
                            <li <?php if($url == "galeria") echo 'class="active"'; ?>>
                                <a href="/cms-cordescor/app/view/galerias/">Galeria</a>
                            </li>
                            <li <?php if($url == "informes") echo 'class="active"'; ?>>
                                <a href="/cms-cordescor/app/view/informes/">Informes</a>
                            </li>
                            <li <?php if($url == "contacto") echo 'class="active"'; ?>>
                                <a href="/cms-cordescor/app/view/contacto/">Contacto</a>
                            </li>
                        </ul>
                        <!-- END Main Menu -->
                    </nav>
                    <!-- END Site Navigation -->
                </div>
            </header>
            <!-- END Site Header -->