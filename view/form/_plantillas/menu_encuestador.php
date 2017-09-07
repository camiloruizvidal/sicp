<nav class="navbar navbar-other navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">SICP</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a  class="active" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Registros <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="../ficha/registrar.php"><i class="fa fa-users" aria-hidden="true"></i> Registrar ficha familiar</a></li>
                        <li><a href="../persona/ingresar.php"><i class="fa fa-user-plus" aria-hidden="true"></i> Registrar persona</a></li>
                    </ul>
                </li>


                <li class="dropdown">
                    <a  class="active" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Informes <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="../informes/filtrar.php"><i class="fa fa-user" aria-hidden="true"></i> Personas</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a  class="active" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Opciones <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="javascript:exportar();"><p>Exportar</p></a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a  class="active" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Opciones <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="../login/codigos.php"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i> codigos <span class="sr-only">(current)</span></a>
                            <a href="../login/pass.php"><i class="fa fa-user" aria-hidden="true"></i> Usuario <span class="sr-only">(current)</span></a>
                            <a href="../login/ini.php"><i class="fa fa-power-off" aria-hidden="true"></i> Cerrar sesion <span class="sr-only">(current)</span></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
