$(function () {
    $('#estado_id').change(function () {
        $.getJSON('municipios.php', {
            estado_id: $(this).val()
        }, function (data, textStatus, jqXHR) {
            // console.log(data.data);
            var municipios = $('#municipio_id');
            municipios.html('<option value="">Selecciona</option>')
            data.data.forEach(function (v, i) {
                // console.log(v);
                municipios.append(new Option(v['municipio'], v['id']));
            });
        });
    });
});


function attRequired(name) {
    var inputs = document.getElementsByName(name)    
    
    if (contieneChecked(inputs,true)) {
        inputs.forEach(element => {
            element.required = false            
        });
    }
    else {
        inputs.forEach(element => {
            element.required = true            
        });
    }
}

function contieneChecked(a, obj) {
    var i = a.length;
    while (i--) {
        if (a[i].checked === obj) {
            console.log('mmm')
            return true;
        }
    }
    return false;
}
