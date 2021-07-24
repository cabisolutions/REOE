function obtenerDatos(id) {
    fetch(`http://localhost/reoe/usuario?id=${id}`)
        .then(response => response.json())
        //.then(json => console.log(json))
        .then(json => asignarDatos(json))

}

async function asignarDatos(datos) {
    usuario = datos['data']

    document.getElementById('modalTitulo').textContent = 'Detalle usuario'
    console.log(document.getElementById('id_usuario').value = usuario[0].id)
    document.getElementById('direccion_id_usuario').value = usuario[0].direccion_id
    document.getElementById('nombre').value = usuario[0].nombre
    document.getElementById('primer_apellido').value = usuario[0].primer_apellido
    document.getElementById('segundo_apellido').value = usuario[0].segundo_apellido
    if (usuario[0].sexo === 'Femenino') {
        document.getElementById('sexo1').checked = true
    } else (
        document.getElementById('sexo2').checked = true
    )
    document.getElementById('fecha_nacimiento').value = usuario[0].fecha_nacimiento
    document.getElementById('numero_celular').value = usuario[0].numero_celular
    document.getElementById('correo_electronico').value = usuario[0].correo_electronico
    if (usuario[0].perfil === 'Administrador') {
        document.getElementById('perfil1').checked = true
    } else (
        document.getElementById('perfil2').checked = true
    )
    if (usuario[0].estatus === 'Activo') {
        document.getElementById('estatus1').checked = true
    } else (
        document.getElementById('estatus2').checked = true
    )
    document.getElementById('imagen_identificacion').src = './usuarios/identificaciones/' + usuario[0].identificacion
    document.getElementById('imagen_comprobante_domicilio').src = './usuarios/comprobantes_domicilio/' + usuario[0].comprobante_domicilio
    document.getElementById('calle_usuario').value = usuario[0].calle
    document.getElementById('colonia_usuario').value = usuario[0].colonia
    document.getElementById('numero_exterior_usuario').value = usuario[0].numero_exterior
    document.getElementById('numero_interior_usuario').value = usuario[0].numero_interior
    document.getElementById('codigo_postal_usuario').value = usuario[0].codigo_postal
    //document.getElementById('estado_id_usuario').getElementsByTagName('option')[usuario[0].estado_id].selected = 'selected'
    document.getElementById('estado_id_usuario').value = usuario[0].estado_id
    
    await $("#estado_id_usuario").change()

    //await a()

    setTimeout(function(){
        document.getElementById('municipio_id_usuario').value = usuario[0].municipio_id
    },100);
    

    //console.log(document.getElementById('municipio_id_usuario').options[0])
    //console.log(document.getElementById('municipio_id_usuario').value = usuario[0].municipio_id)
    //$("#municipio_id_usuario").val("771").change();

    
    
    //document.getElementById('estado_id_usuario_default').textContent = usuario[0].estado_id
    //document.getElementById('municipio_id_usuario_default').tex = usuario[0].municipio_id
}

function limpiarCampos() {

    document.getElementById('modalTitulo').textContent = 'Crear usuario'
    document.getElementById('id_usuario').value = ''
    document.getElementById('direccion_id_usuario').value = ''
    document.getElementById('nombre').value = ''
    document.getElementById('primer_apellido').value = ''
    document.getElementById('segundo_apellido').value = ''
    document.getElementById('sexo1').checked = false
    document.getElementById('sexo2').checked = false
    document.getElementById('fecha_nacimiento').value = ''
    document.getElementById('numero_celular').value = ''
    document.getElementById('correo_electronico').value = ''
    document.getElementById('perfil1').checked = false
    document.getElementById('perfil2').checked = false
    document.getElementById('estatus1').checked = false
    document.getElementById('estatus2').checked = false
    document.getElementById('imagen_identificacion').src = ''
    document.getElementById('imagen_comprobante_domicilio').src = ''
    document.getElementById('calle_usuario').value = ''
    document.getElementById('colonia_usuario').value = ''
    document.getElementById('numero_exterior_usuario').value = ''
    document.getElementById('numero_interior_usuario').value = ''
    document.getElementById('codigo_postal_usuario').value = ''
    document.getElementById('estado_id_usuario').value = 'Selecciona un estado'
    document.getElementById('municipio_id_usuario').value = 'Selecciona primero un estado'

}

function formSubmit(e) {
    //console.log('aaaaaaaaaaaaaaaaaa')
    var form = document.getElementById('formulario_usuario')
    //form.target='_blank';
    //form.action='usuario.php';
    //form.submit();
    //form.action='usuario.php';
    //form.target='';
    e.preventDefault()

    var myModalEl = document.querySelector('#modalUsuario')
    var modal = bootstrap.Modal.getOrCreateInstance(myModalEl)
    modal.hide()

    var modalMensaje = new bootstrap.Modal(document.getElementById('modalMensaje'))
    var tiitulo = document.getElementById('modalTitulo').textContent
    document.getElementById('modalMensajeTitulo').textContent = tiitulo
    modalMensaje.toggle()
    //modalMensaje.show()
}


function enviarPost(){
    const data = new FormData(document.getElementById('formulario_usuario'))

    if(data.get('id_usuario') == ''){
        console.log('Vacio')
        data.delete('id_usuario')
    }
    //console.log(data.get('id_usuario'))

    fetch(`http://localhost/reoe/usuario`, {
        method: 'POST',
        body: data
    })
        .then(function (response) {
            if (response.ok) {
                return response.text()
            } else {
                throw "Error en la llamada Ajax";
            }

        })
        .then(function (texto) {
            console.log(texto);
        })
        .catch(function (err) {
            console.log(err);
        });
    
}
