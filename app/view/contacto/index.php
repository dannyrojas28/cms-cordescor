<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <?php 
        $error = "";
        $true = "";
            include("../includes/head.php");
            require_once "../../../config/Database/conexion_select.php";
            require_once "../../../config/Database/conexion_insert.php";
            require_once "../../../config/Database/mail.php";
            require_once '../../controllers/cpanel/SelectController.php';
            require_once '../../controllers/cpanel/InsertController.php';

            //instanciamos los objetos de los controladores
            $ctrSelec      = new SelectController();
            $ctrInser      = new InsertController();
            $url = "contacto";
            $quienes_somos = $ctrSelec->GetNosotros('Quienes Somos');
            if(!empty($_POST['contact-name'])){
                $name = $_POST['contact-name'];
                $mail = $_POST['contact-email'];
                $mess = $_POST['contact-message'];
                
                $email = new Mail($name,$mail);
                $inse = $ctrInser->postContacto($name,$mess,$mail);
                if($email != false && $inse != false){
                    $true  = "Se ha enviado tu informacion correctamente";
                }else{
                    $error = "No se ha podido Enviar la informacion";
                }
            }


        ?>
    </head>
    <body>
        <!-- Page Container -->
        <!-- In the PHP version you can set the following options from inc/config file -->
        <!-- 'boxed' class for a boxed layout -->
        <div id="page-container">
            
        <?php include("../includes/navbar.php") ?>
        
            <!-- Intro -->
            <section class="site-section site-section-light site-section-top themed-background-dark"  style="background: #bdbdbd ">
                <div class="container">
                    <h1 class="text-center animation-slideDown"><i class="fa fa-envelope"></i> <strong>Contacto</strong></h1>
                    <h2 class="h3 text-center animation-slideUp">Estaremos encantados de responder a todas sus preguntas y trabajar juntos !</h2>
                </div>
            </section>
            <!-- END Intro -->

            <!-- Google Map -->
            <section class="site-content">
                <!-- Gmaps.js (initialized in js/pages/contact.js), for more examples you can check out http://hpneo.github.io/gmaps/examples.html -->
                <div id="gmap"></div>
            </section>
            <!-- END Google Map -->

            <!-- Support Links -->
            <section class="site-content site-section">
                <div class="container">
                    <div class="row row-items text-center">
                        <div class="col-sm-3 animation-fadeIn">
                            <a href="javascript:void(0)" class="circle themed-background">
                                <i class="gi gi-life_preserver"></i>
                            </a>
                            <h4>Abrir un <strong>ticket</strong></h4>
                        </div>
                        <div class="col-sm-3 animation-fadeIn">
                            <a href="javascript:void(0)" class="circle themed-background">
                                <i class="gi gi-envelope"></i>
                            </a>
                            <h4><strong>Email</strong></h4>
                        </div>
                        <div class="col-sm-3 animation-fadeIn">
                            <a href="javascript:void(0)" class="circle themed-background">
                                <i class="fa fa-comments"></i>
                            </a>
                            <h4><strong>Chat</strong></h4>
                        </div>
                        <div class="col-sm-3 animation-fadeIn">
                            <a href="javascript:void(0)" class="circle themed-background">
                                <i class="fa fa-twitter"></i>
                            </a>
                            <h4><strong>Twitter</strong></h4>
                        </div>
                    </div>
                    <hr>
                </div>
            </section>
            <!-- END Support Links -->

            <!-- Contact -->
            <section class="site-content site-section">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-md-4 site-block">
                            <div class="site-block">
                                <h3 class="h2 site-heading"><strong>Cordescor</strong></h3>
                                <address>
                                    Av 0 #12-34 Barrio Blanco<br>
                                    Cùcuta<br>
                                    Norte de Santander<br>
                                    Colombia<br>
                                    <i class="fa fa-phone"></i> (037) 583-3434 <br>
                                    <i class="fa fa-envelope-o"></i> <a href="javascript:void(0)">soporte@cordescor.com</a>
                                </address>
                            </div>
                            <div class="site-block">
                                <h3 class="h2 site-heading"><strong>Acerca de </strong> Nosotros</h3>
                                <p class="remove-margin">
                                    <?php  echo $quienes_somos;?>
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-8 site-block">
                            <h3 class="h2 site-heading"><strong>Formulario de Contacto</strong></h3>
                            <?php 
                                if (!empty($error)) {
                                    # code...
                                    echo '<div class="col-md-12 col-sm-12"><div class="alert alert-danger" role="alert">'.$error.'</div></div>';
                                }
                                if (!empty($true)) {
                                    # code...
                                    echo '<div class="col-md-12 col-sm-12"><div class="alert alert-success" role="alert">'.$true.'</div></div>';
                                }
                            ?>
                            <form action="" method="post" id="form-contact">
                                <div class="form-group">
                                    <label for="contact-name">Nombres</label>
                                    <input type="text" id="contact-name" name="contact-name" class="form-control input-lg" placeholder="Su nombre..">
                                </div>
                                <div class="form-group">
                                    <label for="contact-email">Email</label>
                                    <input type="text" id="contact-email" name="contact-email" class="form-control input-lg" placeholder="Su email..">
                                </div>
                                <div class="form-group">
                                    <label for="contact-message">Mensaje</label>
                                    <textarea id="contact-message" name="contact-message" rows="10" class="form-control input-lg" placeholder="Háganos saber cómo podemos ayudar.."></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-lg btn-primary">Enviar Mensaje</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END Contact -->    


            <?php include("../includes/footer.php");  ?>
        </div>
        <!-- END Page Container -->
        <!-- Google Maps API + Gmaps Plugin, must be loaded in the page you would like to use maps (Remove 'http:' if you have SSL) -->
        <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        <script src="../../../public/js/helpers/gmaps.min.js"></script>

        <!-- Load and execute javascript code used only in this page -->
        <script src="../../../public/js/pages/contact.js"></script>
        <script>$(function(){ Contact.init(); });</script>

        
    </body>
</html>