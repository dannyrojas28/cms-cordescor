<?php

    if(empty($_GET['proyecto'])){
        header('location:../proyectos/');
    }
?>

<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
    <?php
        
        $url = "proyectos";
        include("../includes/head.php");
        require_once "../../../config/Database/conexion_select.php";
        require_once '../../controllers/cpanel/SelectController.php';

        //instanciamos los objetos de los controladores
        $ctrSelec      = new SelectController();
        $proyecto = $_GET['proyecto'];
        $query = $ctrSelec->GetProyectosSelect($proyecto);
        if($query != false){
            while ($res = mysqli_fetch_object($query)) {
                # code...
                $tittle  = $res->tittle;
                $cod     = $res->cod;
                $desc_sm = $res->description_small;
                $desc_lg = $res->description_large;
                $img_ico = $res->img_icon;
                $date_up = $res->date_upload;
                
            }
        }else{
            header('location:../proyectos/');
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
                      <!-- Intro -->
            <section class="site-section site-section-light site-section-top themed-background-dark" style="background: #bdbdbd ">
                <div class="container">
                    <h1 class="animation-slideDown" style="color:#fff"><strong><?php echo $tittle; ?></strong></h1>
                </div>
            </section>
            <!-- END Intro -->

            <!-- Content -->
            <section class="site-content site-section">
                <div class="container">
                    <!-- Project Navigation -->
                    <div class="site-block clearfix">
                        <!--<div class="btn-group pull-right">
                            <a href="javascript:void(0)" class="btn btn-primary"><i class="fa fa-chevron-left"></i> Atras</a>
                            <a href="javascript:void(0)" class="btn btn-primary">Siguiente <i class="fa fa-chevron-right"></i></a>
                        </div>-->
                        <a href="../proyectos/" class="btn btn-primary pull-left"><i class="fa fa-th-large"></i> Todos los Proyectos</a>
                    </div>
                    <!-- END Project Navigation -->

                    <!-- Project Info -->
                    <div class="row">
                        <!-- Project Slider -->
                        <div class="col-sm-5 site-block">
                            <div id="project-carousel" class="carousel slide" data-ride="carousel" data-interval="3000">
                                <!-- Wrapper for slides -->
                                <div class="carousel-inner text-center">
                                    <div class="active item">
                                        <img src="/cms-cordescor/public/proyectos/imgs/<?php echo $cod; ?>/<?php echo $img_ico; ?>" alt="Image 1">
                                    </div>
                                </div>
                                <!-- END Wrapper for slides -->

                                
                                <!-- END Controls -->
                            </div>

                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td style="width: 50%;"><strong>Proyecto</strong></td>
                                        <td class="text-right"><?php echo $tittle; ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Fecha Subida</strong></td>
                                        <td class="text-right"><?php echo $date_up; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- END Project Slider -->

                        <!-- Project Details -->
                        <div class="col-sm-7 site-block">
                            <h3 class="site-heading"><strong></strong> Descripcion</h3>
                            <p><?php echo $desc_sm; ?></p>
                            <p><?php echo $desc_lg; ?></p>
                        </div>
                        <div class="col-sm-12 site-block">
                            <?php
                                $query2 = $ctrSelec->GetGalerias($cod);
                                $i = 0;
                                if($query2 != false){
                                    while ($resT = mysqli_fetch_object($query2)) {
                                        $i = $i + 1;
                                        echo '<div class="col-sm-4">
                                                    <p>
                                                        <a href="/cms-cordescor/public/proyectos/imgs/'.$cod.'/'.$resT->imagen.'" data-toggle="lightbox-image">
                                                            <img src="/cms-cordescor/public/proyectos/imgs/'.$cod.'/'.$resT->imagen.'" alt="image" class="img-responsive">
                                                        </a>
                                                    </p>
                                                </div>';
                                        }
                                }
                            ?>
                        </div>
                        <!-- END Project Details -->
                    </div>
                    <!-- END Project Info -->
                    <hr>
                </div>
            </section>
            <!-- END Content -->

             <?php include("../includes/footer.php");  ?>
        </div>
        <!-- END Page Container -->

        
    </body>
</html>