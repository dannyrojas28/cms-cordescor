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
            $quienes_somos = $ctrSelec->GetNosotros('Quienes Somos');
            $mision        = $ctrSelec->GetNosotros('Mision');        
            $vision        = $ctrSelec->GetNosotros('Vision');
            $url = "nosotros";


        ?>
    </head>
    <body>
        <!-- Page Container -->
        <!-- In the PHP version you can set the following options from inc/config file -->
        <!-- 'boxed' class for a boxed layout -->
        <div id="page-container">
            
        <?php include("../includes/navbar.php") ?>
            <!-- Media Container -->
            <div class="media-container">
                <!-- Intro -->
                <section class="site-section site-section-light site-section-top">
                    <div class="container">
                        <h1 class="text-center animation-slideDown"><i class="fa fa-building-o"></i> <strong>Nuestra Empresa</strong></h1>
                        <h2 class="h3 text-center animation-slideUp"><strong>Construido con amor por la gente apasionada !</strong></h2>
                    </div>
                </section>
                <!-- END Intro -->

                <!-- Gmaps.js (initialized in js/pages/about.js), for more examples you can check out http://hpneo.github.io/gmaps/examples.html -->
                <div id="gmap-top" class="media-map"></div>
            </div>
            <!-- END Media Container -->

            <!-- Company Info -->
            <section class="site-content site-section">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="site-block">
                                <h3 class="site-heading"><strong>Quienes Somos ?</strong></h3>
                                <p><?php echo $quienes_somos;?></p>
                            </div>
                            <div class="site-block">
                                <h3 class="site-heading"><strong>Visiòn</strong></h3>
                                <p><?php echo $vision;?></p>
                            </div>
                            <div class="site-block">
                                <h3 class="site-heading"><strong>Misiòn</strong></h3>
                                <p><?php echo $mision;?></p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="site-block">
                                <table class="table table-bordered table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Años</th>
                                            <th class="text-center">Proyectos</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="width: 50%;">2014</td>
                                            <td><strong>300</strong></td>
                                        </tr>
                                        <tr>
                                            <td>2015</td>
                                            <td><strong>450</strong></td>
                                        </tr>
                                        <tr>
                                            <td>2016</td>
                                            <td><strong>2000</strong> &amp; Counting..</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="site-block">
                                <p class="text-center">
                                    <img src="../../../public/img/avatar.png" alt="Avatar" class="img-circle" style="width: 150px;">
                                </p>
                                <blockquote>
                                    <p>Estoy agradecido de que lo hizo tan lejos y continuamos fuerte! Gracias a todos por apoyarnos!</p>
                                    <footer><strong>John Doe</strong>, CEO</footer>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END Company Info -->          


            <?php include("../includes/footer.php");  ?>
        </div>
        <!-- END Page Container -->

        <!-- Google Maps API + Gmaps Plugin, must be loaded in the page you would like to use maps (Remove 'http:' if you have SSL) -->
        <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        <script src="../../../public/js/helpers/gmaps.min.js"></script>

        <!-- Load and execute javascript code used only in this page -->
        <script src="../../../public/js/pages/about.js"></script>
        <script>$(function(){ About.init(); });</script>

        
    </body>
</html>