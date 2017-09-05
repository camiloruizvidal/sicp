<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="assets/img/favicon.ico">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title><#--titulo--#></title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        <link href="../css/bootstrap/light-bootstrap-dashboard.css" rel="stylesheet"/>
        <link href="../css/bootstrap/bootstrap.min.css" rel="stylesheet" />
        <link href="../css/sources/animate.min.css" rel="stylesheet"/>
        <link href="../css/jquery/jquery-ui.css?v=<?php echo date('YmdHis'); ?>" rel="stylesheet"/>
        <link href="../css/jquery/jquery-ui.theme.css?v=<?php echo date('YmdHis'); ?>" rel="stylesheet"/>
        <link href="../css/sources/demo.css" rel="stylesheet" />
        <link href="../css/sources/pe-icon-7-stroke.css" rel="stylesheet" />
        <link href="../css/sources/loading.css" rel="stylesheet" />
        <link href="../css/sources/switch.css?v=<?php echo date('YmdHis'); ?>" rel="stylesheet">
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
        <link href="http://getbootstrap.com/docs/3.3/examples/sticky-footer-navbar/sticky-footer-navbar.css" rel="stylesheet" />
        <#--css--#>
        <script src="../js/jquery/jquery-1.10.2.js" type="text/javascript"></script>
        <script src="../js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
        <script src="../js/bootstrap/bootstrap-checkbox-radio-switch.js"></script>
        <script src="../js/bootstrap/bootstrap-notify.js"></script>
        <script src="../js/jquery/light-bootstrap-dashboard.js"></script>
        <script src="../js/jquery/jquery-ui.min.js"></script>
        <script src="../js/source/Function.js?v=<?php echo date('YmdHis'); ?>"></script>
        <script src="../js/source/loading.js" type="text/javascript"></script>

        <#--js--#>
    </head>
    <body>
        <script>
            function downloadFile(filePath) {
                var link = document.createElement('a');
                link.href = filePath;
                link.download = filePath.substr(filePath.lastIndexOf('/') + 1);
                link.click();
            }
            function exportar()
            {
                $.ajax({
                    url: '../ajaxficha/exportar_data',
                    success: function (data, textStatus, jqXHR)
                    {
                        var url = '../files/' + data;
                        $('#downaload').attr('href', url);
                        console.log(data);
                        downloadFile(url);
                    }
                });
            }
        </script>        
        <style>
            a {
                color: #FFF;
                text-decoration: none;
            }
            .nav>li>a:focus, .nav>li>a:hover {
                text-decoration: none;
                background-color: #1975D1;
            }
            .navbar-other {
                background-color: #099BDD;
                border-color: #27A9E3;
            }
            body{padding-top: 10px; background-color: #C3C3C3;}
            .panel-other{border: 1px solid #27A9E3;}
            #codigo{
                color: #3c763d;
                background-color: #dff0d8;
                border-color: #d6e9c6;
            }
            .footer {bottom: -75px;}
        </style>

        <!-- Fixed navbar -->
        <?php
        switch ($_SESSION['tipo_perfil'])
        {
            case 'Administrador':
                include_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../view/form/_plantillas/menu_administrador.php';
                break;
            case 'Encuestador':
                include_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../view/form/_plantillas/menu_encuestador.php';
                break;
        }
        ?>
        <div class="container">

            <#--contenido--#>

            <!-- /container -->

        </div>
        <footer class="footer">
            <div class="container">
                <p class="text-muted">Place sticky footer content here.</p>
            </div>
        </footer>
    </body>
</html>
