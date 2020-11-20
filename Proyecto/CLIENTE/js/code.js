var aux;
var idAux;
var nLineas;

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
        var borra = confirm("Desea borrar la linea");
        var fila_borrar = $(this).parent().parent();//$(this) es el boton que ha generado el evento, me interesa la fila
        var objeto_dato = { 
            dni:fila_borrar.find('.dniCli').text(), //dentro de la fila, busco el td de clase dni, y me quedo con el texto
        };
        borrar_cliente(objeto_dato, fila_borrar, borra); 
               
    });

    $(document).on('click', ".editarCliente", function(){
        $(".modalEditarCliente").show();
        var fila_editar = $(this).parent().parent();//$(this) es el boton que ha generado el evento, me interesa la fila
        var objeto_dato = { 
            dni:fila_editar.find('.dniCli').text(), //dentro de la fila, busco el td de clase dni, y me quedo con el texto
        };     
        //console.log("entra EDITAR CLIENTE");
        buscar_cliente(objeto_dato);        
    });

    $(".boton_modificar").click(function () {
        //console.log("entra BOTON modificar");
        editar_cliente();
        $(".modalEditarCliente").hide();
    });

    
//PEDIDOS
    $(".modalNuevoPedido").hide();
    $(".modalEditarPedido").hide();
    $(".modalNuevaLineaPedido").hide();
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
        $(".modalEditarPedido").hide();
        $(".modalNuevaLineaPedido").hide();
    });
    
    $(document).on('click', ".borrarPedido", function(){
        var borra = confirm("Desea borrar la linea");
        var fila_borrar = $(this).parent().parent();//$(this) es el boton que ha generado el evento, me interesa la fila
        var objeto_dato = { 
            idPedido:fila_borrar.find('.idPedido').text(), //dentro de la fila, busco el td de clase idPedido, y me quedo con el texto
        };
        borrar_pedido(objeto_dato, fila_borrar, borra);
    });

    $(document).on('click', ".editarPedido", function(){
        $(".modalEditarPedido").show();
        var fila_editar = $(this).parent().parent();//$(this) es el boton que ha generado el evento, me interesa la fila
        var objeto_dato = { 
            idPedido:fila_editar.find('.idPedido').text(), //dentro de la fila, busco el td de clase idPedido, y me quedo con el texto
        };   
        console.log("ID: "+objeto_dato.idPedido);     
        buscar_pedido(objeto_dato);
    });

    $(".boton_editarPedido").click(function () {
        editar_pedido();
        $(".modalEditarPedido").hide();
    });

//LINEAS PEDIDO

    $(document).on('click', ".detallesPedido", function(){
        var fila_detalles = $(this).parent().parent();//$(this) es el boton que ha generado el evento, me interesa la fila  
        var objeto_dato = { 
            idPedido:fila_detalles.find('.idPedido').text(), //dentro de la fila, busco el td de clase idPedido, y me quedo con el texto
        }; 
        idAux = objeto_dato.idPedido;
        console.log("entra detalles");        
        listar_lineas_pedidos(objeto_dato);        
    });

    $(document).on('click', ".borrarLineaPedido", function(){
        var borra = confirm("Desea borrar la linea");
        var fila_borrar = $(this).parent().parent();//$(this) es el boton que ha generado el evento, me interesa la fila
        var objeto_dato = { 
            idPedido: idAux,
            nlinea:fila_borrar.find('.nlinea').text(), //dentro de la fila, busco el td de clase nlinea, y me quedo con el texto
        };
        borrar_linea_pedido(objeto_dato, fila_borrar, borra);
    });

    $(document).on('click', ".nuevaLineaPedido", function(){        
        $(".modalNuevaLineaPedido").show();          
    });

    $(".boton_insertarLinea").click(function(){ 
        var numero = buscar_nlinea(idAux);
        insertar_linea_pedido(idAux, numero);
        $(".modalNuevaLineaPedido").hide();                          
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
                $(".tablaClientes tbody").append("<tr id='" + respuesta[key].dniCliente + "'><td class='dniCli'>" + respuesta[key].dniCliente + "</td><td class='nombreCli'>" + respuesta[key].nombre +
                    "</td> <td><button class='editarCliente'>Editar</button><button id='borrarCliente'>Borrar</button></td></tr>");
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
            $(".tablaClientes tbody").append("<tr id='" + objeto_dato.dniCliente + "'><td class='dniCli'>" + objeto_dato.dniCliente + "</td><td class='nombreCli'>" + objeto_dato.nombre +
                "</td> <td><button class='editarCliente'>Editar</button><button id='borrarCliente'>Borrar</button></td></tr>");
            alert("Dato insertado correctamente !!!!");//si es correcta, inserto los datos en una fila nueva            
        } else {
            alert("Error en la insercion"); //si no es correcta no inserto nada
        }
    }).fail(function (jqXHR, textStatus, errorThrown) {
        console.log("La solicitud ha fallado: " + textStatus + errorThrown);
    });
}

function borrar_cliente(objeto_dato, fila_borrar, borra){
    console.log(borra);
    if(borra){        
        $.ajax({
            
            url: "PHP/clientes/borrar_cliente.php", // paso el dni del cliente a borrar
            type: "POST",
            data: objeto_dato, 
                

            success: function (respuesta) {
                console.log("entra AJAX");  // recojo la respuesta, que sera true o false
                if (respuesta) {              
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

function editar_cliente(){
    var objeto_dato = {   //Monto un objeto con los datos del cliente a modificar en la BD
        dniCliente: $('#dniEditarCliente').val(),
        nombre: $('#nombreEditarCliente').val(),
        direccion: $('#direccionEditarCliente').val(),
        email: $('#emailEditarCliente').val()
    };

    //console.log("entra METODO editar");

    $.ajax({        
        url: "PHP/clientes/editar_cliente.php", // paso el dni del cliente a modificar
        type: "POST",
        data: objeto_dato, 
        dataType: "json",     

        success: function (respuesta) {
            console.log(respuesta);  // recojo la respuesta, que sera true o false
            if (respuesta) {
                //console.log("entra AJAX"); // si se ha modificado la fila de la bd, modifico la de la pagina                
                $("#"+objeto_dato.dniCliente+"").children().remove(); 
                $("#"+objeto_dato.dniCliente+"").append("<td class='dniCli'>" + objeto_dato.dniCliente + "</td><td class='nombreCli'>" + respuesta.nombre + 
                "</td> <td><button class='editarCliente'>Editar</button><button id='borrarCliente'>Borrar</button></td>");
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
                $(".tablaPedidos tbody").append("<tr class='"+respuesta[key].idPedido+"'><td class='idPedido'>" + respuesta[key].idPedido + "</td><td class='dniCliente'>" + respuesta[key].dniCliente +
                    "</td> <td class='fecha'>" + respuesta[key].fecha + "</td> <td>" +
                    "<button class='detallesPedido'>Detalles</button>" +
                    "<button class='editarPedido'>Editar</button> " +
                    "<button class='borrarPedido'>Borrar</button></td></tr>");
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
        fecha: $('#fechaPedido').val(),
    };  
    
    console.log(objeto_dato.fecha);

    $.ajax({
        url: "PHP/pedidos/insertar_pedido.php", // Paso datos 
        type: "POST",
        data: objeto_dato,
        dataType: "json",
    }).done(function (respuesta) {
        console.log(respuesta);  // recojo la respuesta, que sera true o false
        if (respuesta) {
            $(".tablaPedidos tbody").append("<tr class='"+objeto_dato.idPedido+"'><td class='idPedido'>" + objeto_dato.idPedido + "</td><td class='dniCliente'>" + objeto_dato.dniCliente +
                    "</td> <td class='fecha'>" + objeto_dato.fecha + "</td> <td>" +
                    "<button class='detallesPedido'>Detalles</button>" +
                    "<button class='editarPedido'>Editar</button> " +
                    "<button class='borrarPedido'>Borrar</button></td></tr>");          
            alert("Dato insertado correctamente !!!!");//si es correcta, inserto los datos en una fila nueva            
        } else {
            alert("Error en la insercion"); //si no es correcta no inserto nada
        }
    }).fail(function (jqXHR, textStatus, errorThrown) {
        console.log("La solicitud ha fallado: " + textStatus + errorThrown);
    });
}

function borrar_pedido(objeto_dato, fila_borrar, borra){
    console.log(objeto_dato);
    if(borra){
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
}

function editar_pedido(){
    var objeto_dato = {   //Monto un objeto con los datos del pedido a insertar en la BD
        idPedido: $('#idPedidoEditar').val(),
        dniCliente: $('#idClienteEditar :selected').text(),
        fecha: $('#fechaEditar').val()
    };

    console.log(objeto_dato);

    $.ajax({        
        url: "PHP/pedidos/editar_pedido.php", // paso el dni del cliente a modificar
        type: "POST",
        data: objeto_dato, 
        dataType: "json",     

        success: function (respuesta) {
            //console.log(respuesta);  // recojo la respuesta, que sera true o false
            if (respuesta) {
                $("."+objeto_dato.idPedido+"").children().remove(); 
                $("."+objeto_dato.idPedido+"").append("<td>" + objeto_dato.idPedido + "</td><td>" + objeto_dato.dniCliente + "</td><td>" + respuesta.fecha + 
                "</td><td><button class='detallesPedido'>Detalles</button>" +
                "<button class='editarPedido'>Editar</button> " +
                "<button class='borrarPedido'>Borrar</button></td>");
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

function buscar_pedido(objeto_dato){
    $.ajax({
        
        url: "PHP/pedidos/buscar_pedido.php", // paso el dni del cliente y recogo sus datos
        type: "POST",
        data: objeto_dato,   
        dataType: "json",  

        success: function (respuesta) {
            console.log("entra buscar");
            console.log(respuesta);  // recojo la respuesta
            if (respuesta) {   
                //$("#idClienteEditar").val(respuesta.dniCliente);
                $("#fechaEditar").val(respuesta.fecha);
                $("#idPedidoEditar").val(respuesta.idPedido);
            } else {
                alert("Error al buscar"); //si no es correcta enseño mensaje
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
                $("#idClienteEditar").append("<option value='" + respuesta[key].dniCliente + "'>" + respuesta[key].dniCliente + "</option>");                
            }
        },       

        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        },
    });
}

//LINEAS PEDIDO
function listar_lineas_pedidos(objeto_dato) {  //Falta que se cierre -------------------------------

    $("."+objeto_dato.idPedido+"").after("<table class='tablaLineasPedido'><tr><th>Linea</th> <th>Cantidad</th> <th>Producto</th ><th>Acciones</th></tr></table>");
    //console.log(objeto_dato);
    $.ajax({
        url: "PHP/lineasPedido/listar_lineas_pedido.php", // no paso ningun dato, solo recojo
        type: "POST",
        data: objeto_dato,
        dataType: "json",

        success: function (respuesta) {
            console.log(respuesta); // array de objetos, lo itero y pinto una fila por cada objeto      
            for (var key in respuesta) {
                $(".tablaLineasPedido").append("<tr class='"+respuesta[key].nlinea+"'><td class='nlinea'>" + respuesta[key].nlinea + "</td><td class='cantidad'>" + respuesta[key].cantidad +
                    "</td> <td class='producto'>" + respuesta[key].idProducto + "</td> <td>" +
                    "<button class='borrarLineaPedido'>Borrar</button></td></tr>");
            }            
            $(".tablaLineasPedido").append("<tr class='lineaBoton'><td><button class='nuevaLineaPedido'>Añadir</button></td></tr>");

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log("La solicitud ha fallado: " + textStatus + errorThrown);
        }
    });
}

function insertar_linea_pedido(numero) { 
    var objeto_dato = {   //Monto un objeto con los datos del pedido a insertar en la BD
        idPedido: idAux,
        idProducto: $('#idProducto').val(),
        nlinea: numero, //Cambiar manualmente
        cantidad: $("#cantidad").val() 
    };   
    
    console.log(objeto_dato);

    $.ajax({
        url: "PHP/lineasPedido/insertar_linea_pedido.php", // Paso datos 
        type: "POST",
        data: objeto_dato,
        dataType: "json",
    }).done(function (respuesta) {
        console.log(respuesta);  // recojo la respuesta, que sera true o false
        if (respuesta) {
            $("."+idAux+".lineaBoton").before("<tr class='"+objeto_dato.nlinea+"'><td class='nlinea'>" + objeto_dato.nlinea + "</td><td class='cantidad'>" + objeto_dato.cantidad +
                    "</td> <td class='producto'>" + objeto_dato.idProducto + "</td> <td>" +
                    "<button class='borrarLineaPedido'>Borrar</button></td></tr>");               
            alert("Dato insertado correctamente !!!!");//si es correcta, inserto los datos en una fila nueva            
        } else {
            alert("Error en la insercion"); //si no es correcta no inserto nada
        }
    }).fail(function (jqXHR, textStatus, errorThrown) {
        console.log("La solicitud ha fallado: " + textStatus + errorThrown);
    });
}

function borrar_linea_pedido(objeto_dato, fila_borrar, borra){
    console.log(objeto_dato);
    if(borra){
        $.ajax({
            
            url: "PHP/lineasPedido/borrar_linea_pedido.php", // paso el dni del cliente a borrar
            type: "POST",
            data: objeto_dato,  

            success: function (respuesta) {
                console.log(respuesta);  // recojo la respuesta, que sera true o false
                if (respuesta) {
                    console.log(respuesta);
                    var borra = confirm("Desea borrar la linea");
                    if(borra){
                        fila_borrar.remove(); // si se ha borrado la fila de la bd, borro de la pagina
                    alert("Linea borrada correctamente !!!!");//si es correcta, borro la fila   
                    }                          
                } else {
                    alert("Error al borrar"); //si no es correcta enseño mensaje
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("La solicitud ha fallado: " + textStatus + errorThrown);
            }
        });
    }
}

function buscar_nlinea(idAux){
    console.log("entra buscar");
    var objeto_dato = {   //Monto un objeto con los datos del pedido a insertar en la BD
        idPedido: idAux 
    };
    $.ajax({
        
        url: "PHP/lineasPedido/buscar_nlinea.php", // paso el idPedido y recogo el max nlinea
        type: "POST",
        data: objeto_dato,   
        dataType: "json",  

        success: function (respuesta) {
            console.log("entra buscar");
            console.log(respuesta);  // recojo la respuesta
            if (respuesta) {   
                $("#numerolineas").val(respuesta.nlinea + 1)
            } else {
                alert("Error al buscar"); //si no es correcta enseño mensaje
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log("La solicitud ha fallado: " + textStatus + errorThrown);
        }
    });
}

 //nlinea se recoge de la base de datos, poner el nombre envez de dni en pedidos
