<?php
session_start();
$_SESSION = array();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Snippet - Bootsnipp.com</title>
        <link href="../css/bootstrap/bootstrap.min.css" rel="stylesheet" />

        <style>
            body, html {
                height: 100%;
                background-repeat: no-repeat;
                background-color: #099BDD;
            }
            .card-container.card {
                max-width: 350px;
                padding: 40px 40px;
            }
            .btn {
                font-weight: 700;
                height: 36px;
                -moz-user-select: none;
                -webkit-user-select: none;
                user-select: none;
                cursor: default;
            }
            .card {
                background-color: #F7F7F7;
                /* just in case there no content*/
                padding: 20px 25px 30px;
                margin: 0 auto 25px;
                margin-top: 50px;
                /* shadows and rounded borders */
                -moz-border-radius: 2px;
                -webkit-border-radius: 2px;
                border-radius: 2px;
                -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
                -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
                box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            }
            .profile-img-card {
                width: 96px;
                height: 96px;
                margin: 0 auto 10px;
                display: block;
                -moz-border-radius: 50%;
                -webkit-border-radius: 50%;
                border-radius: 50%;
            }
            .profile-name-card {
                font-size: 16px;
                font-weight: bold;
                text-align: center;
                margin: 10px 0 0;
                min-height: 1em;
            }
            .reauth-email {
                display: block;
                color: #404040;
                line-height: 2;
                margin-bottom: 10px;
                font-size: 14px;
                text-align: center;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
                -moz-box-sizing: border-box;
                -webkit-box-sizing: border-box;
                box-sizing: border-box;
            }
            .form-signin #inputEmail,
            .form-signin #inputPassword {
                direction: ltr;
                height: 44px;
                font-size: 16px;
            }
            .form-signin input[type=email],
            .form-signin input[type=password],
            .form-signin input[type=text],
            .form-signin button {
                width: 100%;
                display: block;
                margin-bottom: 10px;
                z-index: 1;
                position: relative;
                -moz-box-sizing: border-box;
                -webkit-box-sizing: border-box;
                box-sizing: border-box;
            }
            .form-signin .form-control:focus {
                border-color: rgb(104, 145, 162);
                outline: 0;
                -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
                box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
            }
            .btn.btn-signin {
                /*background-color: #4d90fe; */
                background-color: rgb(104, 145, 162);
                /* background-color: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));*/
                padding: 0px;
                font-weight: 700;
                font-size: 14px;
                height: 36px;
                -moz-border-radius: 3px;
                -webkit-border-radius: 3px;
                border-radius: 3px;
                border: none;
                -o-transition: all 0.218s;
                -moz-transition: all 0.218s;
                -webkit-transition: all 0.218s;
                transition: all 0.218s;
            }
            .btn.btn-signin:hover,
            .btn.btn-signin:active,
            .btn.btn-signin:focus {
                background-color: rgb(12, 97, 33);
            }
            .forgot-password {
                color: rgb(104, 145, 162);
            }
            .forgot-password:hover,
            .forgot-password:active,
            .forgot-password:focus{
                color: rgb(12, 97, 33);
            }</style>
        <script src="../js/jquery/jquery-1.10.2.js" type="text/javascript"></script>
        <script src="../js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function ()
            {
                $('input').change(function ()
                {
                    $('#error').hide();
                })
                $('#error').hide();
                $('#login').submit(function (e)
                {
                    e.preventDefault();
                    $.ajax({
                        url: '../ajaxlogin/validate',
                        data: $('#login').serialize(),
                        type: 'POST',
                        dataType: 'json',
                        success: function (data)
                        {
                            if (data.validate)
                            {
                                window.location = data.url;
                            }
                            else
                            {
                                $('#error').show();
                            }
                        }
                    });
                });
            });
        </script>
    </head>
    <body>
        <style>
            #bar_sup span{
                font-style: oblique;
            }
            #bar_sup{
                color: #099BDD;
                margin-top: 40px;
                background-color: #FFF;
                padding-top: 23px;
                padding-bottom: 23px;
                text-align: center;
            }

        </style>
        <div class="row">
            <div class="col-md-6">
                <img src="../img/heart.png" width="156px">
            </div>
            <div class="col-md-6">
                <img src="../img/old.png" width="300px">
            </div>
        </div>
        <div id="bar_sup">
            <h1>SICPAS</h1>
            <span>SISTEMA DE INFORMACION Y CARATERIZACION DE LA POBLACION PARA ATENCION EN SALUD</span>
        </div>
        <div class="row">
            <div class="col-md-6">
                <img src="../img/famili.png" >
            </div>  
            <div class="col-md-6">
                <div class="card card-container">
                    <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png">
                    <p id="profile-name" class="profile-name-card"></p>
                    <form class="form-signin" id="login">
                        <span id="reauth-email" class="reauth-email"></span>
                        <input type="text" name="login" class="form-control" placeholder="Login" required="" autofocus="">
                        <input type="password" name="pass" class="form-control" placeholder="Password" required="">
                        <div id="remember" class="checkbox">
                            <label>
                                <input type="checkbox" value="remember-me"> Recordarme
                            </label>
                        </div>
                        <div id="error" class="alert alert-danger" role="alert">No se pudo validar su usuario</div>
                        <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Iniciar</button>
                    </form>
                    <a href="#" class="forgot-password">
                        Recordar contraseña
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>