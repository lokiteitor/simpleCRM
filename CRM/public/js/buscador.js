jQuery(document).ready(function($) {
    
    // al ingresar texto en las campos de busqueda a partir de las tres primeras 
    // letras enviar la consulta al servidor que buscara coincidencias y regresara
    // los datos en forma json para de forma asincrona llenar los datalist

    // por convencion nombra a cada campo de busqueda con la clase .buscador
    // el campo input debe de contener un atributo data-busqueda que contenga el 
    // o los tipos de elementos que se buscan separados por , en caso de ser varias

    // a cada uno de estos campos asignarle un listener del evento keyup

    var data = {};

    $('.buscador').each(function(index, el) {
        $(el).keyup(function(event) {
            if ($(this).val().length > 3) {
                // enviar los datos a el servidor
                data.valor = $(this).val();
                data.nombre = $(this).attr('name');                
                data.solicitud = $(this).data('busqueda');
                buscar(data);
            };
        });
    });

});


function buscar (data,datalist) {
    // Enviar al servidor los datos y cuando los reciba dibujarlos en el datalist
    // adecuado en el formato debido
    console.log('consultado al servidor')
    ruta = window.location.origin + '/engine/buscador'
    $.ajax({
        url: ruta,
        type: 'GET',
        dataType: 'json',
        data: data
    })
    .done(function(json) {
        console.log("success");
        dibujarwithUI(json,data);
    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        console.log("complete");
    });
}


function dibujar (json,data) {
    // escribir en el datalist
    console.log(data);
    console.log(json);
    nombrelista = $('input[name="'+data.nombre+'"]').attr('list');
    $lista = $('#'+nombrelista);
    $lista.empty();

    for (var i = 0; i < json.length; i++) {
        $elemento = $('<option></option>');
        $elemento.val(data.valor);
        $elemento.text(json[i].id+'-'+json[i].nombre);
        opcion = '<option value="' + json[i].id + '-' + json[i].nombre + '">';
        $lista.append($elemento);
    };

    $('datalist option').each(function(index, el) {
        $(el).click(function(event) {
           $(this).val($(this.text()));
           console.log('ok');
        });
    });    

}

function dibujarwithUI(json,data) {
    // escribir en el datalist
    var lista = new Array();
    for (var i = 0; i < json.length; i++) {
        elemento = json[i].id + '-' + json[i].nombre;
        lista.push(elemento);
    }

    $('input[name="'+data.nombre+'"]').autocomplete({
        source : lista
    })
}