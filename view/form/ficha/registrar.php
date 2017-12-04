<?php
include_once dirname(__FILE__) . '/../../../base.php';
include Config::$Controller . 'anico_form.php';
include Config::$Controller . 'ficha.php';
include Config::$Controller . 'datos.php';
include_once Config::$Controller . '/login.php';
$Validar = new login();
$Validar->UsuarioCorrecto(array('Encuestador'));

$form->ruta       = '../_plantillas';
$form->plantilla  = '_ficha.php';
$form->parametros = array('titulo' => 'Ficha familiar');
$form->create(__FILE__);
?>
<#--content_ini--#>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1Jc53ZYuZgWMNoYHTBbXVQQdc8V0F6Eo"></script>
<style>
    #nueva_persona{
        display: none;
        background-color: red;
        padding: 5px;
        border-radius: 46px;
        cursor: pointer;
        margin-right: 10px;
    }
    #nueva_persona i{
        padding-left: 4px;
    }
</style>
<script>
    function mostrarUbicacion(position)
    {
        var latitud = position.coords.latitude;
        var longitud = position.coords.longitude;
        var exactitud = position.coords.accuracy;
        $('#latitud').val(latitud);
        $('#longitud').val(longitud);
        $('#exactitud').val(exactitud);
        function refrescarUbicacion()
        {
            navigator.geolocation.watchPosition(mostrarUbicacion);
        }
    }
    function generate_maps(locations, ini_long, ini_lati, zoom)
    {
        var map = new google.maps.Map(document.getElementById('map'),
                {
                    zoom: zoom,
                    center: new google.maps.LatLng(ini_long, ini_lati),
                    mapTypeId: google.maps.MapTypeId.HYBRID
                });
        var infowindow = new google.maps.InfoWindow();
        var marker, i;
        for (i = 0; i < locations.length; i++)
        {
            marker = new google.maps.Marker(
                    {
                        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                        map: map
                    });
            google.maps.event.addListener(marker, 'click', (function (marker, i)
            {
                return function ()
                {
                    infowindow.setContent(locations[i][0]);
                    infowindow.open(map, marker);
                }
            })(marker, i));
        }
    }
    function cargar_mapa()
    {
        var latitud = $('#latitud').val();
        var longitud = $('#longitud').val();
        var map = new google.maps.Map(document.getElementById('mapholder'), {
            zoom: 100,
            center: new google.maps.LatLng(latitud, longitud),
            mapTypeId: google.maps.MapTypeId.HYBRID
        });
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(latitud, longitud),
            map: map
        });
        var infowindow = new google.maps.InfoWindow();
        $('#ModalMapa').modal('show');
    }
    function corregimiento(id_municipio)
    {
        $.ajax({
            url: '../../../controller/anico_ajax.php?control=datos&function=corregimientos',
            type: 'POST',
            data: {id: id_municipio},
            async: false,
            success: function (data, textStatus, jqXHR)
            {
                $('#id_corregimientos').html(data);
            }
        });
    }
    function veredas(id_municipio)
    {
        $.ajax({
            url: '../../../controller/anico_ajax.php?control=datos&function=veredas',
            type: 'POST',
            data: {id: id_municipio},
            async: false,
            success: function (data, textStatus, jqXHR)
            {
                $('#id_veredas').html(data);
            }
        });
    }
    function municipios(id_departamento)
    {
        $.ajax({
            url: '../../../controller/anico_ajax.php?control=datos&function=municipios',
            type: 'POST',
            data: {id: id_departamento},
            async: false,
            success: function (data, textStatus, jqXHR)
            {
                $('#id_municipio').html(data);
            }
        });
    }
    $(function ()
    {
        $('#id_municipio').change(function ()
        {
            veredas($(this).val());
            corregimiento($(this).val());
        });
        $('#id_departamento').change(function ()
        {
            municipios($(this).val());
        });
        $('#nueva_persona').click(function ()
        {
            $('#form_new_persona').submit();
        });
        $('#form_ficha_familiar').submit(function (e)
        {
            var bool_bloquear = false;
            loadingstart();
            e.preventDefault();
            if ($('#id_municipio').prop('disabled') == true)
            {
                bool_bloquear = true;
                $('#id_departamento').removeAttr("disabled");
                $('#id_municipio').removeAttr("disabled");
                $('#id_corregimientos').removeAttr('disabled');
                $('#id_veredas').removeAttr('disabled');
            }

            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                dataType: 'json',
                data: $('#form_ficha_familiar').serialize(),
                success: function (data)
                {
                    if (data.success)
                    {
                        $('#nueva_persona').show();
                        //$('#button_save').attr('disabled', true);
                        $('#form_new_persona_codigo').val();
                        $.notify({message: 'Se ha guardado con éxito'}, {type: 'success'});
                        location.href = '#nueva_persona';
                    }
                    else
                    {
                        $.notify({message: 'Ha ocurrido un error. '}, {type: 'danger'});
                    }
                    if (bool_bloquear)
                    {
                        $('#id_departamento').attr('disabled', true);
                        $('#id_municipio').attr('disabled', true);
                        $('#id_corregimientos').attr('disabled', true);
                        $('#id_veredas').attr('disabled', true);
                    }
                }
            });
            loadingstop();
        });
    });
    function start(departamento, municipio, vereda, id_corregimiento)
    {
        $('#id_departamento').val(departamento);
        municipios(departamento);
        $('#id_municipio').val(municipio);
        veredas(municipio);
        $('#id_veredas').val(vereda);
        corregimiento(municipio);
        $('#id_corregimientos').val(id_corregimiento);
        $('#id_departamento').attr('disabled', true);
        $('#id_municipio').attr('disabled', true);
        $('#id_corregimientos').attr('disabled', true);
        $('#id_veredas').attr('disabled', true);
    }
    $(window).load(function () {
        //start(10, 398, 220, 18);
        if (navigator.geolocation)
        {
            navigator.geolocation.getCurrentPosition(mostrarUbicacion);
        }
        else
        {
            alert("¡Error! Este navegador no soporta la Geolocalización.");
        }
    });
</script>

<div>
    <form id="form_new_persona" target="_blank" method="post" action="../persona/ingresar.php">
        <input type="hidden" name="form_new_persona_codigo" id="id_tarjeta_familiar" value="<?php echo ficha::codigotarjetaFamiliar(); ?>"/>
    </form>
    <form id="form_ficha_familiar" method="post" action="../../../controller/anico_ajax.php?control=ficha&function=savetarjetafamiliar">
        <div class="panel panel-other">
            <div class="panel-heading">
                <span id="nueva_persona">
                    <i class="fa fa-user-plus" aria-hidden="true"></i>
                </span>Datos de tarjeta familiar
            </div>
            <div class="panel-body">
                <div class="container-fluid">
                </div>
                <div class="col-md-6">
                    <label>Tarjeta Familiar</label>
                    <input required="true" name="codigo" id="codigo" value="<?php echo ficha::codigotarjetaFamiliar(); ?>" readonly="true" class="form form-control"/>
                </div>
                <div class="col-md-2">
                    <label>Ficha de sisben</label>
                    <input type="" name="sisben_ficha"  id="sisben_ficha" class="form form-control"/>
                </div>
                <div class="col-md-2">
                    <label>Nivel</label>
                    <input type="" name="sisben_nivel" id="sisben_nivel" class="form form-control"/>
                </div>
                <div class="col-md-2">
                    <label>Puntaje</label>
                    <input type="" name="sisben_puntaje" id="sisben_puntaje" class="form form-control"/>
                </div>
                <div class="col-md-2">
                    <label>Paciente con portabilidad
                        <input type="checkbox" value="si" id="portabilidad" name="portabilidad">
                        <input type="hidden" value="no" id="portabilidad" name="portabilidad">
                    </label>
                </div>

                <div class="col-md-2">
                    <label>Paciente con cambio de domicilio
                        <input type="checkbox" value="si" id="cambio_domicilio" name="cambio_domicilio">
                        <input type="hidden" value="no" id="cambio_domicilio" name="cambio_domicilio">
                    </label>
                </div>
                <div class="col-md-4">
                    <label>Zona</label>
                    <select name="id_zona" id="id_zona" class="form form-control">
                        <?php echo datos::zona(); ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Departamento</label>
                    <select name="id_departamento" id="id_departamento" class="form form-control">
                        <?php echo datos::departamento(); ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Municipio</label>
                    <select name="id_municipio" id="id_municipio" class="form form-control">
                        <?php echo datos::Postmunicipios(); ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Corregimiento</label>
                    <select name="id_corregimiento" id="id_corregimientos" class="form form-control">
                        <?php echo datos::Postcorregimientos(); ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Veredas</label>
                    <select name="id_vereda" id="id_veredas" class="form form-control">
                        <?php echo datos::Postveredas(); ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Telefono</label>
                    <input type="" name="telefono" id="telefono" class="form form-control"/>
                </div>
                <div class="col-md-4">
                    <label>Direccion y ubicacion de la vivienda</label>
                    <input type="" name="direccion" id="direccion" class="form form-control" required="true" />
                </div>
                <div class="col-md-4">
                    <label>Fecha de la proxima visita</label>
                    <input name="proxima_visita" id="proxima_visita" class="form form-control fechaadelante" required="true" />
                </div>
                <div class="col-md-4">
                    <label>Longitud</label>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button style="padding-bottom: 3px;" class="btn btn-warning" type="button" onclick="cargar_mapa()"><i class="glyphicon glyphicon-globe"></i></button>
                        </span>
                        <input type="" name="longitud" id="longitud" class="form form-control" />
                    </div>
                </div>
                <div class="col-md-4">
                    <label>Latitud</label>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button style="padding-bottom: 3px;" class="btn btn-warning" type="button" onclick="cargar_mapa()"><i class="glyphicon glyphicon-globe"></i></button>
                        </span>
                        <input type="" name="latitud" id="latitud" class="form form-control"  />
                    </div>
                </div>
                <div class="col-md-4">
                    <label>Exactitud</label>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button style="padding-bottom: 3px;" class="btn btn-warning" type="button" onclick="cargar_mapa()"><i class="glyphicon glyphicon-globe"></i></button>
                        </span>
                        <input type="" id="exactitud" class="form form-control" />
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-other">
            <div class="panel-heading">
                <script>
                    $(function ()
                    {
                        $('#agregar').click(function ()
                        {
                            var html = '<div class="col-md-2">\n\
                                        <label>Nombres</label>\n\
                                        <input name="nombres[]" class="form form-control">\n\
                                    </div>\n\
                                    <div class="col-md-2">\n\
                                        <label>Apellidos</label>\n\
                                        <input name="apellidos[]" class="form form-control">\n\
                                    </div>\n\
                                    <div class="col-md-2">\n\
                                        <label>fecha de nacimiento</label>\n\
                                        <input name="fecha_nacimientod[]" class="fecha form form-control">\n\
                                    </div>\n\
                                    <div class="col-md-2">\n\
                                        <label>Fecha de fallecimiento</label>\n\
                                        <input name="fecha_fallecimiento[]" class="fecha form form-control">\n\
                                    </div>\n\
                                    <div class="col-md-4">\n\
                                        <label>Causa</label>\n\
                                        <input name="causa[]" class="form form-control">\n\
                                    </div>';
                            $('#form_mortalidad').append(html);
                            $('.fecha').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: "-150:+0"});
                        });
                    });
                </script>
                Mortalidad <button type="button" id="agregar" class="btn btn-success"><i class="glyphicon glyphicon-user"></i> Agregar</button>
            </div>
            <div class="panel-body">
                <div id="form_mortalidad">
                </div>
            </div>
        </div>
        <div class="panel panel-other">
            <div class="panel-heading">
                Riesgos del ambiente
            </div>
            <div class="panel-body">
                <?php
                echo ficha::datosIngreso(false);
                ?>
            </div>
        </div>
        <div class="panel-heading">
            <button id="button_save" type="submit" class="btn btn-danger">Guardar ficha</button>
        </div>
    </form>

</div>


<div class="modal fade" id="ModalMapa" tabindex="-1" role="dialog" aria-labelledby="ModalMapa">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Ubicacion geografica</h4>
            </div>
            <div class="modal-body">
                <div id="mapholder" style="width: 500px; height: 400px;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</div>
<#--content_fin--#>