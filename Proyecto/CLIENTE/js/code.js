var aux;

window.onload = function () {

    

    //CLIENTE
    $(".modalNuevoCliente").hide();
    $(".modalEditarCliente").hide();

    listar_clientes();

    $("#nuevoCliente").click(function () {
        $(".modalNuevoCliente").show();
    });

    $(".boton_cancelar").click(function () {
        $(".modalNuevoCliente").hide();
        $(".modalEditarCliente").hide();
    });

    $(".boton_crear").click(function () {
        insertar_cliente();
        $(".modalNuevoCliente").hide();
    });

    $(document).on('click', "#borrarCliente", function(){
        var fila_borrar = $(this).parent().parent();//$(this) es el boton que ha generado el evento, me interesa la fila
        var objeto_dato = { 
            dni:fila_borrar.find('.dniCli').text(), //dentro de la fila, busco el td de clase dni, y me quedo con el texto
        };
        borrar_cliente(objeto_dato, fila_borrar);
    });

    $(document).on('click', "#editarCliente", function(){
        $(".modalEditarCliente").show();
        var fila_editar = $(this).parent().parent();//$(this) es el boton que ha generado el evento, me interesa la fila
        console.log(fila_editar);   
        var objeto_dato = { 
            dni:fila_editar.find('.dniCli').text(), //dentro de la fila, busco el td de clase dni, y me quedo con el texto
        };        
        buscar_cliente(objeto_dato);

        $(".boton_modificar").click(function () {
            editar_cliente(fila_editar);
            fila_editar.remove();
            $(".modalEditarCliente").hide();
        });
    });

    
//PEDIDOS
    $(".modalNuevoPedido").hide();
    listar_pedidos(aux);
    relleno_select();

    $("#nuevoPedido").click(function () {        
        $(".modalNuevoPedido").show();        
    });
    
    $(".boton_crearPedido").click(function(){  
        aux++; 
        insertar_pedido(aux);        
        $(".modalNuevoPedido").hide(); 
    });

    $(".boton_cancelarPedido").click(function(){
        $(".modalNuevoPedido").hide(); 
    });
    
    $(document).on('click', "#borrarPedido", function(){
        var fila_borrar = $(this).parent().parent();//$(this) es el boton que ha generado el evento, me interesa la fila
        var objeto_dato = { 
            idPedido:fila_borrar.find('.idPed').text(), //dentro de la fila, busco el td de clase dni, y me quedo con el texto
        };
        borrar_pedido(objeto_dato, fila_borrar);
    });


}

//CLIENTE
function listar_clientes() {
    $.ajax({
        url: "PHP/clientes/listar_clientes.php", // no paso ningun dato, solo recojo
        type: "POST",
        dataType: "json",

        success: function (respuesta) {
            console.log(respuesta); // array de objetos, lo itero y pinto una fila por cada objeto

            for (var key in respuesta) {
                $(".tablaClientes tbody").append("<tr><td class='dniCli'>" + respuesta[key].dniCliente + "</td><td class='nombreCli'>" + respuesta[key].nombre +
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
            $(".tablaClientes tbody").append("<tr><td class='dniCli'>" + objeto_dato.dniCliente + "</td><td class='nombreCli'>" + objeto_dato.nombre +
                "</td> <td><button id='editarCliente'>Editar</button><button id='borrarCliente'>Borrar</button></td></tr>");
            alert("Dato insertado correctamente !!!!");//si es correcta, inserto los datos en una fila nueva            
        } else {
            alert("Error en la insercion"); //si no es correcta no inserto nada
        }
    }).fail(function (jqXHR, textStatus, errorThrown) {
        console.log("La solicitud ha fallado: " + textStatus + errorThrown);
    });
}

function borrar_cliente(objeto_dato, fila_borrar){
    $.ajax({
        
        url: "PHP/clientes/borrar_cliente.php", // paso el dni del cliente a borrar
        type: "POST",
        data: objeto_dato, 
            

        success: function (respuesta) {
            console.log(respuesta);  // recojo la respuesta, que sera true o false
            if (respuesta) {
                console.log("entra");
                fila_borrar.remove(); // si se ha borrado la fila de la bd, borro de la pagina
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

function buscar_cliente(objeto_dato){
    $.ajax({
        
        url: "PHP/clientes/buscar_cliente.php", // paso el dni del cliente y recogo sus datos
        type: "POST",
        data: objeto_dato,   
        dataType: "json",  

        success: function (respuesta) {
            console.log("entra buscar");
            console.log(respuesta);  // recojo la respuesta
            if (respuesta) {     
                $("#dniEditarCliente").val(respuesta.dniCliente);
                $("#nombreEditarCliente").val(respuesta.nombre);
                $("#direccionEditarCliente").val(respuesta.direccion);
                $("#emailEditarCliente").val(respuesta.email);
            } else {
                alert("Error al buscar"); //si no es correcta enseño mensaje
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log("La solicitud ha fallado: " + textStatus + errorThrown);
        }
    });
}

function editar_cliente(fila_editar){
    var objeto_dato = {   //Monto un objeto con los datos del cliente a modificar en la BD
        dniCliente: $('#dniEditarCliente').val(),
        nombre: $('#nombreEditarCliente').val(),
        direccion: $('#direccionEditarCliente').val(),
        email: $('#emailEditarCliente').val()
    };

    $.ajax({        
        url: "PHP/clientes/editar_cliente.php", // paso el dni del cliente a modificar
        type: "POST",
        data: objeto_dato, 
        dataType: "json",     

        success: function (respuesta) {
            console.log(respuesta);  // recojo la respuesta, que sera true o false
            if (respuesta) {
                console.log("entra editar");                
                // si se ha modificado la fila de la bd, modifico la de la pagina
                fila_editar.children('.nombreCli').text(objeto_dato.nombre); // --------------- ARREGLAR  ----------
                alert("Cliente modificado correctamente !!!!");//si es correcta, modifico la fila            
            } else {
                alert("Error al modificar"); //si no es correcta enseño mensaje
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log("La solicitud ha fallado: " + textStatus + errorThrown);
        }
    });
}


//PEDIDOS
function listar_pedidos() {
    $.ajax({
        url: "PHP/pedidos/listar_pedidos.php", // no paso ningun dato, solo recojo
        type: "POST",
        dataType: "json",

        success: function (respuesta) {
            console.log(respuesta); // array de objetos, lo itero y pinto una fila por cada objeto

            for (var key in respuesta) {
                $(".tablaPedidos tbody").append("<tr><td class='idPedido'>" + respuesta[key].idPedido + "</td><td class='dniCliente'>" + respuesta[key].dniCliente +
                    "</td> <td class='fecha'>" + respuesta[key].fecha + "</td> <td>" +
                    "<button id='detallesPedido'>Detalles</button>" +
                    "<button id='editarPedido'>Editar</button> " +
                    "<button id='borrarPedido'>Borrar</button></td></tr>");
                    aux = respuesta[key].idPedido;
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log("La solicitud ha fallado: " + textStatus + errorThrown);
        }
    });
}

function insertar_pedido(aux) {
    var objeto_dato = {   //Monto un objeto con los datos del pedido a insertar en la BD
        idPedido: aux,
        dniCliente: $('#selectCliente :selected').text(),
        fecha: $('#fecha').val()
    };    

    $.ajax({
        url: "PHP/pedidos/insertar_pedido.php", // Paso datos 
        type: "POST",
        data: objeto_dato,
        dataType: "json",
    }).done(function (respuesta) {
        console.log(respuesta);  // recojo la respuesta, que sera true o false
        if (respuesta) {
            $(".tablaPedidos tbody").append("<tr><td class='idPedido'>" + objeto_dato.idPedido + "</td><td class='dniCliente'>" + objeto_dato.dniCliente +
                    "</td> <td class='fecha'>" + objeto_dato.fecha + "</td> <td>" +
                    "<button id='detallesPedido'>Detalles</button>" +
                    "<button id='editarPedido'>Editar</button> " +
                    "<button id='borrarPedido'>Borrar</button></td></tr>");            
            alert("Dato insertado correctamente !!!!");//si es correcta, inserto los datos en una fila nueva            
        } else {
            alert("Error en la insercion"); //si no es correcta no inserto nada
        }
    }).fail(function (jqXHR, textStatus, errorThrown) {
        console.log("La solicitud ha fallado: " + textStatus + errorThrown);
    });
}

function borrar_pedido(objeto_dato, fila_borrar){
    $.ajax({
        
        url: "PHP/pedidos/borrar_pedido.php", // paso el dni del cliente a borrar
        type: "POST",
        data: objeto_dato,             

        success: function (respuesta) {
            console.log(respuesta);  // recojo la respuesta, que sera true o false
            if (respuesta) {
                console.log(respuesta);
                fila_borrar.remove(); // si se ha borrado la fila de la bd, borro de la pagina
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

function relleno_select(){
    $.ajax({
        url: "PHP/pedidos/rellenar_select.php", 
        type : 'POST',    
        dataType : 'json', 

        success : function(respuesta) {
            for (var key in respuesta) {
                $("#selectCliente").append("<option value='" + respuesta[key].dniCliente + "'>" + respuesta[key].dniCliente + "</option>");
            }
        },       

        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        },
    });
}

