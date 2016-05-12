<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <?php 
            include("../includes/head.php");
            require_once "../../../config/Database/conexion_select.php";
            require_once '../../controllers/cpanel/SelectController.php';

            //instanciamos los objetos de los controladores
            $ctrSelec = new SelectController();
            $numActivos = mysqli_num_rows($ctrSelec->GetSlidersActive());
            $url = "inicio";
        ?>
    </head>
    <body>
        <!-- Page Container -->
        <!-- In the PHP version you can set the following options from inc/config file -->
        <!-- 'boxed' class for a boxed layout -->
        <div id="page-container">
            
        <?php include("../includes/navbar.php") ?>

                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                
                                  
                                <?php
                                    $slidersActive = $ctrSelec->GetSlidersActive();
                                    if($slidersActive != false){
                                      $j = 0;
                                      $indicator = '<ol class="carousel-indicators">';
                                      $wrapper = '<div class="carousel-inner" role="listbox">';
                                      while ($res = mysqli_fetch_object($slidersActive)){
                                        # code...
                                        if($j == 0){
                                           $indicator = $indicator.'<li data-target="#carousel-example-generic" data-slide-to="'.$j.'" class="active"></li>';
                                           $wrapper = $wrapper . '<div class="item active">
                                                                      <img src="/cms-cordescor/public/img/sliders/'.$res->url.'" alt="">
                                                                      <div class="carousel-caption">
                                                                      </div>
                                                                    </div>';
                                        }else{
                                           $indicator = $indicator .'<li data-target="#carousel-example-generic" data-slide-to="'.$j.'"></li>';
                                            $wrapper = $wrapper .  '<div class="item">
                                                                  <img src="/cms-cordescor/public/img/sliders/'.$res->url.'" alt="">
                                                                    <div class="carousel-caption">
                                                                    </div>
                                                                </div>';
                                        }
                                        $j = $j + 1;
                                      }
                                      echo $indicator."</ol>".$wrapper.'</div>';
                                    }else{
                                      echo "<center>No hay Galeria de Sliders..</center>";
                                    }
                                ?>
                                <!-- Controls -->
                                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                  <span class="fa fa-arrow-left" aria-hidden="true"></span>
                                  <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                  <span class="fa fa-arrow-right" aria-hidden="true"></span>
                                  <span class="sr-only">Next</span>
                                </a>
                              </div>

             <section class="site-content site-section">
                <div class="container">
                    <h2 class="site-heading"><strong>Proyectos</h2>
                    <hr>
                    <div class="row jobs">
                            <?php
                                  $query =$ctrSelec->GetProyectosMin5();

                                  if($query != false){
                                      $num = 1;
                                      while ($res = mysqli_fetch_object($query)) {
                                        # code...
                                        echo ' <div class="col-md-4 job-item visibility" data-toggle="animation-appear" data-animation-class="animation-fadeInQuick" data-element-offset="-100">
                                                <a href="javascript:void(0)">
                                                    <div class="job-item-icon">
                                                        <img src="/cms-cordescor/public/proyectos/imgs/'.$res->cod.'/'.$res->img_icon.'" class="avatar" alt="Avatar" style="width:100%;">
                                                    </div>
                                                    <div class="job-item-info clearfix">
                                                        <h2>'.$res->tittle.'</h2><br>
                                                        <span class="text-muted">'.$res->description_small.'</span>
                                                    </div>
                                                </a>
                                            </div>';
                                     }
                                    }

                            ?>
                        
                    </div>
                </div>
            </section>               
  <div class="info-color darken-1" if="footer" style="background: #fff;">
              <div class="container">
                <div class="row row-items text-center">
                    <div class="col-md-12 col-xs-12">
                      <br><br>
                      <h3>Siguenos En Nuestras Redes Sociales</h3>
                      <hr>
                    </div>
                    <div class="col-sm-4">
                        <a href="javascript:void(0)" class="circle visibility themed-background" data-toggle="animation-appear" data-animation-class="animation-fadeIn360" data-element-offset="-100">
                            <i class="fa fa-facebook"></i>
                        </a>
                        <h4><strong>Facebook</strong></h4>
                     </div>
                     <div class="col-sm-4">
                        <a href="javascript:void(0)" class="circle visibility themed-background" data-toggle="animation-appear" data-animation-class="animation-fadeIn360" data-element-offset="-100">
                           <i class="fa fa-twitter"></i>
                        </a>
                        <h4><strong>Tiwtter</strong></h4>
                      </div>
                      <div class="col-sm-4">
                          <a href="javascript:void(0)" class="circle visibility themed-background-fire" data-toggle="animation-appear" data-animation-class="animation-fadeIn360" data-element-offset="-100">
                             <i class="fa fa-google-plus"></i>
                          </a>
                        <h4><strong>Google Plus</strong></h4>
                      </div>
                </div>
              </div>
            </div>

            <?php include("../includes/footer.php");  ?>
        </div>
        <!-- END Page Container -->

        <!-- Scroll to top link, initialized in js/app.js - scrollToTop() -->
        <a href="#" id="to-top"><i class="fa fa-angle-up"></i></a>

        
    </body>
</html>