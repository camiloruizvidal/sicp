function generate_maps(locations, ini_long, ini_lati, zoom)
{
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: zoom,
        center: new google.maps.LatLng(ini_long, ini_lati),
        mapTypeId: google.maps.MapTypeId.HYBRID
    });
    var infowindow = new google.maps.InfoWindow();
    var marker, i;
    for (i = 0; i < locations.length; i++)
    {
        marker = new google.maps.Marker({
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
function generate_map()
{
    $.ajax({
        url: '../../../controller/anico_ajax.php?control=georeferenciacion&function=datos',
        type: 'POST',
        data: $('#search').serialize(),
        dataType: 'json',
        success: function (data)
        {
            try
            {
                if (data.success)
                {
                    generate_maps(data.data, data.longitud, data.latitud, data.zoom);
                    info_people(data.data);
                }
            }
            catch (Exception)
            {
                alert("No se ha podido establecer conexion con el generador de mapas. Msg: " + Exception);
            }
        }
    });
}
function info_people(data)
{
    var html = '<table id="table_sumary" border="1" class="table table-hover">';
    html += '<thead>';
    html += '<tr>';
    html += '<th><i class="fa fa-users" aria-hidden="true"></i> Persona</th>';
    html += '<th><i class="fa fa-map-marker" aria-hidden="true"></i> Longitud</th>';
    html += '<th><i class="fa fa-map-marker" aria-hidden="true"></i> Latitud</th>';
    html += '</tr>';
    html += '</thead>';
    html += '<tbody>';
    $.each(data, function (index, value)
    {
        html += '<tr>';
        $.each(value, function (index1, value1)
        {
            html += '<td>';
            html += value1;
            html += '</td>';
        });
        html += '</tr>';
    });
    html += '<tbody>';
    html += '</table>';
    $('#data_table').html(html);
    $('#table_sumary').DataTable();
}
function save()
{
    $.ajax({
        url: '../../../controller/anico_ajax.php?control=georeferenciacion&function=datos',
        type: 'POST',
        data: $('#search').serialize(),
        dataType: 'json',
        success: function (data)
        {
            try
            {
                if (data.success)
                {
                    var url = 'data[url]=https://maps.googleapis.com/maps/api/staticmap&' +
                            'data[center]=' + data.longitud + ',' + data.latitud + '&' +
                            'data[zoom]=' + data.zoom + '&' +
                            'data[size]=500x400&' +
                            'data[maptype]=hybrid&';
                    $.each(data.data, function (index, value)
                    {
                        url += 'data[markers]=color:red%7Clabel:o%7C' + parseFloat(value[1]) + ',' + parseFloat(value[2]) + '&';
                    });
                    url += 'data[key]=AIzaSyD1Jc53ZYuZgWMNoYHTBbXVQQdc8V0F6Eo';
                    window.location = '../../../controller/anico_ajax.php?control=georeferenciacion&function=saveexcel&' + url;
                }
            }
            catch (Exception)
            {
                alert("No se ha podido establecer conexion con el generador de mapas. Msg: " + Exception);
            }
        }
    });
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
    $('#genero_hiden').hide();
    $('#id_municipio').change(function ()
    {
        veredas($(this).val());
        corregimiento($(this).val());
    });
    $('#id_departamento').change(function ()
    {
        municipios($(this).val());
    });
    $('#search').submit(function (e)
    {
        e.preventDefault();
        $('#map').attr('style', 'width: 500px; height: 400px;');
        generate_map();
    });
    $('#save_file').click(function ()
    {
        save();
    });
    $('#genero').change(function ()
    {
        if ($(this).val() === 'Femenino')
        {
            $('#genero_hiden').show();
        }
        else
        {
            $('#genero_hiden').hide();
        }

    });
});