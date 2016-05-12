<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <?php 
            include("../includes/head.php");
            require_once "../../../config/Database/conexion_select.php";
            require_once '../../controllers/cpanel/SelectController.php';

            //instanciamos los objetos de los controladores
            $ctrSelec      = new SelectController();
            $url = "galeria";


        ?>
    </head>
    <body>
        <!-- Page Container -->
        <!-- In the PHP version you can set the following options from inc/config file -->
        <!-- 'boxed' class for a boxed layout -->
        <div id="page-container">
            
        <?php include("../includes/navbar.php") ?>
             <!-- Intro -->
            <section class="site-section site-section-light site-section-top themed-background-dark" style="background: #bdbdbd ">
                <div class="container">
                    <h1 class="text-center animation-slideDown" style="color:#fff"><strong>Galeria de Proyectos</strong></h1>
                </div>
            </section>
            <!-- END Intro -->

            <!-- Content -->
            <section class="site-content site-section">
                <div class="container">
                    <!-- Portfolio Filter Links -->
                    <!-- Custom Portfolio functionality is initialized in js/pages/portfolio.js -->
                    <!-- Add the category value you want each link in .portfolio-filter to filter out in its data-category attribute. Add the value 'all' to show all items
                    <div class="site-block text-center">
                        <div class="btn-group portfolio-filter">
                            <a href="javascript:void(0)" class="btn btn-primary active" data-category="all">All</a>
                            <a href="javascript:void(0)" class="btn btn-primary" data-category="design">Design</a>
                            <a href="javascript:void(0)" class="btn btn-primary" data-category="development">Development</a>
                            <a href="javascript:void(0)" class="btn btn-primary" data-category="logo">Logo</a>
                        </div>
                    </div> -->
                    <!-- END Portfolio Filter Links -->

                    <!-- Portfolio Items -->
                    <!-- Add the category value for each item in its data-category attribute (for the filter functionality) -->
                   <div class="row portfolio">
                        
                            <?php
                                  $query =$ctrSelec->GetProyectosActive();

                                  if($query != false){
                                      $num = 1;
                                      while ($res = mysqli_fetch_object($query)) {
                                        # code...
                                        echo '<div class="col-sm-3 portfolio-item animation-fadeInQuick" data-category="design">
                                                <a href="../proyecto/'.$res->tittle.'">
                                                    <img src="/cms-cordescor/public/proyectos/imgs/'.$res->cod.'/'.$res->img_icon.'" style="width:100%;">
                                                    <span class="portfolio-item-info"><strong>'.$res->tittle.'</strong></span>
                                                </a>
                                            </div>';
                                     }
                                    }else{
                                        echo '<center><h3>No hay Proyectos</h5></center>';
                                    }

                            ?>
                        
                    </div>
                    <!-- END Portfolio Items -->
                </div>
            </section>
            <!-- END Content -->        


            <?php include("../includes/footer.php");  ?>
        </div>
        <!-- END Page Container -->
         <script src="../../../public/js/pages/portfolio.js"></script>
        
        <script>$(function(){ Portfolio.init(); });</script>

        
    </body>
</html>