<?php
include_once dirname(__FILE__) . '/../../../base.php';
include Config::$Controller . 'anico_form.php';
include Config::$Controller . 'informes.php';
include Config::$Controller . '/login.php';
include Config::$Controller . 'datos.php';
$Validar = new login();
$Validar->UsuarioCorrecto(array('Encuestador', 'Administrador'));

$form->ruta       = '../_plantillas';
$form->plantilla  = '_ficha.php';
$form->parametros = array(
    'titulo' => 'Geo referenciacion',
    'css'    => '../../css/jquery/jquery.dataTables.min.css',
    'js'     =>
    array(
        '../../js/jquery/jquery.dataTables.min.js',
        ));
$form->create(__FILE__);
?>
<#--content_ini--#>
<script src="../../js/jquery/html2canvas.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1Jc53ZYuZgWMNoYHTBbXVQQdc8V0F6Eo"></script>
<script src="../../js/source/maps_filter.js"></script>
<img id="map_img" src="#"/>
<div class="panel panel-primary">
    <div class="panel-heading">Geo referenciacion</div>
    <form id="search">
        <div class="panel-body">
            <div class="container-alt">
                <div class="row">
                    <div class="col-md-3 col-xs-6">
                        <span>Edad inicio</span>
                        <input name="edadini" id="edadini" type="number" class="form form-control"/>
                    </div>
                    <div class="col-md-3 col-xs-6">
                        <span>Edad fin</span>
                        <input name="edadfon" id="edadfon" type="text" class="form form-control"/>
                    </div>
                    <div class="col-md-3 col-xs-6">
                        <span>Genero</span>
                        <select name="genero" id="genero" class="form form-control">
                            <option value="-1">Todos</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                        </select>
                    </div>
                    <div class="col-md-3 col-xs-6" id="genero_hiden">
                        <span><br/>
                            <input name="embarazo" id="embarazo" type="checkbox" value="si"> Mujer en embarazo
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-xs-6">
                        <label>Departamento</label>
                        <select name="id_departamento" id="id_departamento" class="form form-control">
                            <?php echo datos::departamento(); ?>
                        </select>
                    </div>
                    <div class="col-md-3 col-xs-6">
                        <label>Municipio</label>
                        <select name="id_municipio" id="id_municipio" class="form form-control">
                            <?php echo datos::Postmunicipios(); ?>
                        </select>
                    </div>
                    <div class="col-md-3 col-xs-6">
                        <label>Corregimiento</label>
                        <select name="id_corregimiento" id="id_corregimientos" class="form form-control">
                            <?php echo datos::Postcorregimientos(); ?>
                        </select>
                    </div>
                    <div class="col-md-3 col-xs-6">
                        <label>Veredas</label>
                        <select name="id_vereda" id="id_veredas" class="form form-control">
                            <?php echo datos::Postveredas(); ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <button type="submit" id="save">Buscar</button>
        </div>
    </form>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">Geo referenciacion</div>
    <div class="panel-body">
        <div class="container-alt">
            <div class="col-md-6">
                <div id="map"></div>
                <div id="img-out"></div>
            </div>
            <div class="col-md-6">
                <div id="data_table">
                </div>
            </div>
        </div>
    </div>
    <div class="panel-footer">
        <button onclick="save();">Guardar mapa</button>
        <button id="generate">Generar mapa</button>
    </div>
</div>
<style>
    .title{

    }
    .data_maps li a{
        color:#000;
    }
</style>

<#--content_fin--#>