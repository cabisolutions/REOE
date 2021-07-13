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


function mostrarImagen(evt, id) {
    var tgt = evt.target || window.event.srcElement,
        files = tgt.files;
        document.getElementById('imagen_'+id).classList.remove("d-none");
        document.getElementById('imagen_'+id).classList.add("d-block");


    if (FileReader && files && files.length) {
        var fr = new FileReader();
        fr.onload = function() {
            document.getElementById('imagen_'+id).src = fr.result;
        }
        fr.readAsDataURL(files[0]);
    }
    
    else {
        alert("No se pudo subir tu iamgen, intenta de nuevo por favor")
    }
}

