window.onload = function () {

    $(".modalNuevoCliente").hide();

    listar_clientes();

    $("#nuevoCliente").click(function () {
        $(".modalNuevoCliente").show();
    });

    $(".boton_cancelar").click(function () {
        $(".modalNuevoCliente").hide();
    });

    $(".boton_crear").click(function () {
        insertar_cliente();
        $(".modalNuevoCliente").hide();
    });

    $("#borrarCliente").click(function () {
        console.log("entra");
        var dni = $(this).parent().attr("id");
        borrar_cliente(dni);
    });


}

function listar_clientes() {
    $.ajax({
        url: "PHP/clientes/listar_clientes.php", // no paso ningun dato, solo recojo
        type: "POST",
        dataType: "json",

        success: function (respuesta) {
            console.log(respuesta); // array de objetos, lo itero y pinto una fila por cada objeto

            for (var key in respuesta) {
                $(".tablaClientes tbody").append("<tr id='" + respuesta[key].dniCliente + "'><td id=''>" + respuesta[key].dniCliente + "</td><td id=''>" + respuesta[key].nombre +
                    "</td> <td><button id='editarCliente'>Editar</button><button id='borrarCliente'>Borrar</button></td></tr>");
            }

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log("La solicitud ha fallado: " + textStatus + errorThrown);
        }
    });
}

function insertar_cliente() {
    var objeto_dato = {   //Monto un objeto con los datos del cliente a insertar en la BD
        dniCliente: $('#dniCliente').val(),
        nombre: $('#nombreCliente').val(),
        direccion: $('#direccionCliente').val(),
        email: $('#emailCliente').val()
    };

    console.log(objeto_dato);

    $.ajax({
        url: "PHP/clientes/insertar_cliente.php", // Paso datos 
        type: "POST",
        data: objeto_dato,
        dataType: "json",
    }).done(function (respuesta) {
        console.log(respuesta);  // recojo la respuesta, que sera true o false
        if (respuesta) {
            $(".tablaClientes tbody").append("<tr id='" + objeto_dato.dniCliente + "'><td id=''>" + objeto_dato.dniCliente + "</td><td id=''>" + objeto_dato.nombre +
                "</td> <td><button id='editarCliente'>Editar</button><button id='borrarCliente'>Borrar</button></td></tr>");
            alert("Dato insertado correctamente !!!!");//si es correcta, inserto los datos en una fila nueva            
        } else {
            alert("Error en la insercion"); //si no es correcta no inserto nada
        }
    }).fail(function (jqXHR, textStatus, errorThrown) {
        console.log("La solicitud ha fallado: " + textStatus + errorThrown);
    });
}

function borrar_cliente(dni){

    $.ajax({
        url: "PHP/clientes/borrar_cliente.php", // paso el dni del cliente a borrar
        type: "POST",
        data: ('dato', dni),
        dataType: "json",

        success: function (respuesta) {
            console.log(respuesta);  // recojo la respuesta, que sera true o false
            if (respuesta) {
                console.log("entra");
                $("#" + dni +"").remove();
                alert("Linea borrada correctamente !!!!");//si es correcta, borro la fila            
            } else {
                alert("Error al borrar"); //si no es correcta enseño mensaje
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log("La solicitud ha fallado: " + textStatus + errorThrown);
        }
    });
}