<?php
include_once dirname(__FILE__) . '/../../../base.php';
include Config::$Controller . 'anico_form.php';
include Config::$Controller . 'caracteristicas.php';
include Config::$Controller . 'datos.php';
include_once Config::$Controller . '/login.php';
$Validar = new login();
$Validar->UsuarioCorrecto(array('Encuestador'));

$form->ruta       = '../_plantillas';
$form->plantilla  = '_ficha.php';
$form->parametros = array('titulo' => 'Ficha familiar'//, 'js'     => '../js/source/registro.js'
);
$form->create(__FILE__);
?>
<#--content_ini--#>
<script src="../js/source/registro.js"></script>
<div class="container-fluid">
    <ul class="nav nav-tabs" role="tablist" id="tabs_person">
        <li role="presentation" id="li_persona" class="active"><a href="#tab_persona" aria-controls="home" role="tab" data-toggle="tab">Persona</a></li>
        <li role="presentation" id="li_caracteristicas"><a href="#tab_caracteristicas" aria-controls="caracteristicas" role="tab" data-toggle="tab">caracteristicas</a></li>
        <li role="presentation"id="li_programacion"><a href="#tab_programacion" aria-controls="programacion" role="tab" data-toggle="tab">PE y DT</a></li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="tab_persona">
            <form id="form_persona" method="post" action="../ajaxpersona/guardarpersona">
                <div class="panel panel-other">
                    <div class="panel-heading">
                        Datos de la persona
                    </div>
                    <div class="panel-body">
                        <div class="container-fluid">
                            <div class="col-md-12">
                                <label>Tarjeta familiar</label>
                                <input class="form form-control" value="<?php echo (isset($_POST['form_new_persona_codigo'])) ? $_POST['form_new_persona_codigo'] : ''; ?>" name="codigo" id="codigo" required="true"/>
                            </div>
                            <div class="col-md-2">
                                <label>¿Cabeza de familia?</label>
                                <button type="button" id="si_no" class="btn btn-danger form form-control">NO</button>
                                <input type="hidden" id="es_cabeza_familia" name="es_cabeza_familia" value="no" />
                            </div>
                            <div class="col-md-3">
                                <label>Genero</label>
                                <select name="sexo" id="sexo" class="form form-control" >
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label>
                                    ¿Familiaridad?
                                </label>
                                <select name="id_persona_familiaridad" class="form-control" id="id_persona_familiaridad">
                                    <?php datos::familiaridad(); ?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label>Documento</label>
                                <input name="documento" id="documento" class="form form-control" required="true"/>
                            </div>
                            <div class="col-md-3">
                                <label>Tipo de documento</label>
                                <select name="id_documento_tipo" id="id_documento_tipo" class="form form-control" ><?php datos::tipodocumento(); ?></select>
                            </div>
                            <div class="col-md-4">
                                <label>Fecha de nacimiento</label>
                                <div class="input-group">
                                    <input name="fecha_nacimiento" id="fecha_nacimiento" class="fecha form form-control" required="true"/>
                                    <span class="input-group-addon"><i id="edad"></i></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Estado civil</label>
                                <select name="id_estado_civil" id="id_estado_civil" class="form form-control" ><?php datos::estadocivil(); ?></select>
                            </div>
                            <div class="col-md-2">
                                <label>Nivel educativo</label>
                                <select name="id_nivel_educativo" id="id_nivel_educativo" class="form form-control"><?php datos::niveleducativo(); ?></select>
                            </div>
                            <div class="col-md-3">
                                <label>Tipo de ocupacion</label>
                                <input name="ocupacion" id="ocupacion" class="form form-control"/>
                            </div>
                            <div class="col-md-3">
                                <label>Primer Nombre</label>
                                <input name="nombre1" id="nombre1" class="form form-control" required="true"/>
                            </div>
                            <div class="col-md-3">
                                <label>Segundo Nombre</label>
                                <input name="nombre2" id="nombre2" class="form form-control" />
                            </div>
                            <div class="col-md-3">
                                <label>Primer Apellido</label>
                                <input name="apellido1" id="apellido1" class="form form-control" required="true"/>
                            </div>
                            <div class="col-md-3">
                                <label>Segundo Apellido</label>
                                <input name="apellido2" id="apellido2" class="form form-control" />
                            </div>
                            <div class="col-md-3">
                                <label>EPS</label>
                                <div class="input-group">
                                    <select name="id_asegurador" id="id_asegurador" class="form form-control" ><?php datos::asegurador(); ?></select>
                                    <span class="input-group-addon" style="cursor: pointer;" onclick="Agregar_eps()"><i class="glyphicon glyphicon-plus-sign"></i></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Regimen</label>
                                <select name="id_regimen" id="id_regimen" class="form form-control" ><?php datos::regimen(); ?></select>
                            </div>
                            <div class="col-md-3">
                                <label>Tipo afiliado</label>
                                <select name="tipo_afiliado" id="tipo_afiliado" class="form form-control" ><?php datos::tipoafiliado(); ?></select>
                            </div>
                            <div class="col-md-3">
                                <label>Rango</label>
                                <select name="id_rango" id="id_rango" class="form form-control" >
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>

                        </div>
                        <div class="panel-heading">
                            <button class="btn btn-danger">Guardar persona</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div role="tabpanel" class="tab-pane" id="tab_caracteristicas">
            <form id="form_caracteristicas" method="post" action="../ajaxcaracteristicas/guardarregistro">
                <input type="hidden" id="id_persona" name="id_persona" value="">
                <div class="panel panel-other">
                    <div class="panel-heading">
                        Características
                    </div>
                    <div class="panel-body">
                        <?php
                        $cat              = new caracteristicas();
                        echo $cat->crearformulario();
                        ?>
                    </div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-danger" value="Guardar">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
        <div role="tabpanel" class="tab-pane" id="tab_programacion">
            <div class="constant-alt">
                <div id="programas_control">
                    programacion
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Agregar EPS</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="col-md-12">
                        <label>Agregar EPS</label>
                        <input class="form form-control" id="new_eps" name="new_eps">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="save_eps();">Guardar</button>
            </div>
        </div>
    </div>
</div>

<#--content_fin--#>