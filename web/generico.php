<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo "titlegoeshere"; ?></title>
        <?php
        //TODO: stylesheet and javascripts loader trololol
        ?>
        
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <link href="css/jquery/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <link href="css/jqModal.css" rel="stylesheet" type="text/css"/>
        
        <script src="js/jquery.js" type='text/javascript'></script>
        <script src="js/jquery-ui.js" type='text/javascript'></script>
        <script src='js/jqModal.js' type='text/javascript'></script>
        
    </head>

    <body>
        <div class="banner">
            <!-- Image logo banner -->
            <img src="img/banner.gif"/>
        </div>
        <div class="container1">
            <div class="container2">
                <div class="menu">
                    <ul>
                        <li>Nuestros Servicios</li>
                        <li>¿Quiénes somos?</li>
                        <li>Contáctenos</li>
                    </ul>
                </div>
                <div class="content">
                    <?php include "viewRequests.php"; ?>
                    <hr />
                    <?php include "addCoverage.php"; ?>
                    <hr />
                    <?php include "addTaker.php"; ?>
                    <!--
                    <h2>Lorem Ipsum is simply dummy text</h2>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                    -->
                </div>
            </div>
        </div>
        <div class="footer">
            <h1>Universidad CAECE, Arquitectura Web, Trabajo Final</h1>
            <p>Nohales Damián</p>
            <p>Penovi Mariano</p>
            <p>Lippolis Emiliano</p>
        </div>
    </body>

</html>