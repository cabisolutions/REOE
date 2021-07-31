$(function() {
    $('#estado_id').change(function() {
        $.getJSON('municipios.php', {
            estado_id: $(this).val()
        }, function(data, textStatus, jqXHR) {
            // console.log(data.data);
            var municipios = $('#municipio_id');
            municipios.html('<option value="">Selecciona</option>')
            data.data.forEach(function(v, i) {
                // console.log(v);
                municipios.append(new Option(v['municipio'], v['id']));
            });
        });
    });
});