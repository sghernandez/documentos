<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= isset($title) ? $title : 'Site' ?></title>

    <!-- CSS de Bootstrap -->
    <link href="<?php echo asset('assets/css/bootstrap.min.css') ?>" rel="stylesheet" media="screen">
    
    <!-- CSS Bootstrap datatables -->
    <link href="<?php echo asset('assets/css/dataTables.bootstrap.css') ?>" rel="stylesheet">
            
    <!-- CSS personalizado -->
    <link href="<?php echo asset('assets/css/style.css') ?>" rel="stylesheet" media="screen">    

    <!-- librerías opcionales que activan el soporte de HTML5 para IE8 -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
            <div class="navbar-brand">
               <?php echo SITENAME ?>
            </div>
        </div>
        
          <?php if(isLoggedIn()) : ?>          
          <ul class="nav navbar-nav navbar-right">
                      <li class="dropdown" style="background-color: #31B9D5; margin-top: 2px">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $_SESSION['name'] ?></a>
                          <ul class="dropdown-menu" role="menu">                                                          
                              <li><a href="<?php echo url('login/logout') ?>">Cerrar Sesión</a></li>
                          </ul>
                      </li>
                  </ul>
        <?php endif ;?>          
      </div>
    </nav>

    <div id="content" class="container">
    <?php 
         if(isset($view)){
            require "../app/view/$view.php"; 
         }         
    ?>
    </div>
      
    <!-- Modal -->
    <div id="modal_form" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title text-center"></h4>
          </div>
            <div class="modal-body" id="contenido_modal">
           
          </div>

        </div>

      </div>
    </div>      
    
    <script>
	  var baseurl,  php_baseurl = '<?php echo APP_URL ?>'; 	  
      var dtable_serverSide;
    </script> 
    
    
	<!-- Inicializacion de reCaptcha de google 
        <script src='https://www.google.com/recaptcha/api.js?hl=es'></script>  -->   
      
    <!-- Librería jQuery requerida por los plugins de JavaScript -->
    <script src="<?php echo asset('assets/js/plugins/jquery-2.2.4/jquery-2.2.4.min.js') ?>"></script>  
    
    <!-- Datatables -->
    <script src="<?php echo asset('assets/js/plugins/DataTables-1.10.15/jquery.dataTables.min.js') ?>"></script> 
    <script src="<?php echo asset('assets/js/plugins/DataTables-1.10.15/dataTables.bootstrap.min.js') ?>"></script>     
        
    <!-- JQuery Validation -->
    <script src="<?php echo asset('assets/js/plugins/jqueryValidation-1.17.0/jquery.validate.min.js') ?>"></script>      

    <!-- Bootstrap -->
    <script src="<?php echo asset('assets/js/bootstrap.min.js') ?>"></script>
    
    <!-- Funciones personalizadas -->
    <script src="<?php echo asset('assets/js/functions.js') ?>"></script>
  </body>
</html>