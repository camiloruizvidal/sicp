function tipe_data(id_tipo_data, value)
{
    if (id_tipo_data == '1')
    {
        if (value.value == 'si')
        {
            $('#input_' + value.id).prop('checked', 'checked');
        }
        else
        {
            $('#input_' + value.id).prop('checked', false);
        }
    }
    else if (id_tipo_data == '7')
    {
        $('#input_' + value.id).val(value.value);
    }
    else
    {
        $('#input_' + value.id).val(value.value);
    }
}
function cargar_caracteristicas()
{
    $.ajax({
        url: '../../../controller/anico_ajax.php?control=caracteristicas&function=cargarvalores',
        dataType: 'json',
        type: 'POST',
        data: {id_persona: $('#id_persona').val()},
        success: function (data)
        {
            $.each(data, function (index, value)
            {
                tipe_data(value.id_tipo_data, value);
            });
        }
    });
}
function calcularedad()
{
    $.ajax({
        url: '../../../controller/anico_ajax.php?control=other&function=calcularedad',
        type: 'POST',
        data: {edad: $('#fecha_nacimiento').val()},
        dataType: 'json',
        success: function (data)
        {
            $('#edad').html('Años:' + data.year + ', Mes:' + data.months + ', dias:' + data.days + ' ');
        }
    });
}
function cargar_persona()
{
    $('#fecha_nacimiento').change(function ()
    {
        calcularedad();
    });
    $('#documento').change(function ()
    {
        loadingstart();
        $.ajax({
            url: '../../../controller/anico_ajax.php?control=persona&function=verrpersona',
            dataType: 'json',
            type: 'POST',
            data: {documento: $('#documento').val()},
            success: function (data)
            {
                if (Object.keys(data).length > 0)
                {
                    $('#form_persona').clearForm();
                    $.each(data, function (index, value)
                    {
                        $('#' + index).val(value);
                    });
                    ocultar();
                    calcularedad();
                    cargar_caracteristicas();
                }
                else
                {
                    var documento = $('#documento').val();
                    var codigo = $('#codigo').val();
                    $('input').val('');
                    $('#documento').val(documento);
                    $('#codigo').val(codigo);

                }
                loadingstop();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                loadingstop();
                $.notify({message: 'No se puede cargar los datos. Por favor recargue la página.'}, {type: 'danger'});
            }
        });
    });
}
function ocultar()
{
    //$('#li_caracteristicas,#tab_caracteristicas').hide();
}
function mostrar()
{
    $('#li_caracteristicas,#tab_caracteristicas').show();
    $('#li_caracteristicas,#tab_caracteristicas').removeAttr('style');
    $('#tabs_person a[href="#tab_caracteristicas"]').trigger('click');
}
function guardar_caracteristicas()
{
    $('#form_caracteristicas').submit(function (e)
    {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function (data)
            {
                $.notify({message: 'Se han guardado las caracteristicas con éxito'}, {type: 'success'});
                if (data.success)
                {
                    mostrar();
                    programacion();
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                programacion();
            }
        });
    });
}
function programacion()
{
    $.ajax({
        url: '../../../controller/anico_ajax.php?control=programacion&function=verdetalles',
        type: 'POST',
        data: {
            id_persona: $('#id_persona').val(),
            sexo: $('#sexo').val(),
            fecha_nacimiento: $('#fecha_nacimiento').val()
        },
        success: function (data)
        {
            $('#programas_control').html(data);
            $('#tabs_person a[href="#tab_programacion"]').trigger('click');
        }
    });
}
function guardar_persona()
{
    $('#form_persona').submit(function (e)
    {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function (data)
            {
                if (data.success)
                {
                    $.notify({message: 'Se ha guardado con éxito. Por favor ingrese las caracterisiticas'}, {type: 'success'});
                    $('#id_persona').val(data.id);
                    mostrar();
                }
                else
                {
                    $.notify({message: 'Por favor verifique el numero de la tarjeta familiar.'}, {type: 'danger'});
                }
            }
        });
    });
}
function sexo()
{

    $.each($('#id_persona_familiaridad option'), function (index, value)
    {
        if ($('#sexo').val() == 'Femenino')
        {
            if ($(value).attr('data-sexo') == 'm')
            {
                $(value).attr('style', 'display:none');
            }
            if ($(value).attr('data-sexo') == 'f')
            {
                $(value).removeAttr('style');
            }
        }
        if ($('#sexo').val() == 'Masculino')
        {
            if ($(value).attr('data-sexo') == 'f')
            {
                $(value).attr('style', 'display:none');
            }
            if ($(value).attr('data-sexo') == 'm')
            {
                $(value).removeAttr('style');
            }
        }
    });
}
function Agregar_eps()
{
    $('#new_eps').val('');
    $('#myModal').modal();
}
function save_eps()
{
    if ($.trim($('#new_eps').val()) != '')
    {
        $.ajax({
            url: '../../../controller/anico_ajax.php?control=datos&function=saveeps',
            type: 'POST',
            data: {name: $('#new_eps').val()},
            success: function (datares)
            {
                $('#new_eps').val('');
                $('#myModal').modal('hide');
                $.ajax({
                    url: '../../../controller/anico_ajax.php?control=datos&function=aseguradores',
                    success: function (data, textStatus, jqXHR)
                    {
                        $('#id_asegurador').html(data);
                        $('#id_asegurador').val(datares);
                    }
                });
            }
        });
    }
}
function si_no()
{
    $('#si_no').click(function ()
    {
        if ($(this).text() == 'NO')
        {
            $(this).removeClass();
            $(this).addClass('btn btn-success form form-control');
            $(this).text('SI');
            $('#es_cabeza_familia').val('si');
        } else if ($(this).text() == 'SI')
        {
            $(this).removeClass();
            $(this).addClass('btn btn-danger form form-control');
            $(this).text('NO');
            $('#es_cabeza_familia').val('no');
        }
    });
}
$(function ()
{
    si_no();
    cargar_persona();
    guardar_persona();
    guardar_caracteristicas();
    ocultar();
    sexo();
    $('#sexo').change(function ()
    {
        sexo();
    });
});