jQuery(document).ready(function($) {
    
    var ruta;
    data = {}
    pagina = 10;
    nextpag = pagina + 10
    $(".numactual").text(pagina);
    $(".numnext").text(nextpag);
    $(".numprev").text(pagina-10);

    if (window.location.pathname == "/ver/clientes") {
        ruta = "/obtener/clientes";
        data.pagina = pagina;
        data.nextpag = nextpag;
        data.orderby = $('select[name="orden"]').val();
    }
    // obtener los datos
    ServerData = getDataServer(ruta,data);
    // dibujar los datos 
    for (var i = 0; i < ServerData.length; i++) {
        construirFila(ServerData[i]);
    };

    $('a[name="prev"]').click(function(event) {
        event.preventDefault();
        if (pagina - 10 != 0) {
            $("tbody").empty();
            data.nextpag = pagina - 10;
            data.pagina = pagina;
            pagina -= 10;
            ServerData = getDataServer(ruta,data);
            // dibujar los datos 
            for (var i = 0; i < ServerData.length; i++) {
                construirFila(ServerData[i]);
            };
            $(".numactual").text(pagina);
            $(".numnext").text(pagina+10);
            $(".numprev").text(pagina-10);            
        }

    });
    $('a[name="next"]').click(function(event) {
        event.preventDefault();
        $("tbody").empty();
        data.nextpag = pagina + 10;
        data.pagina = pagina;
        pagina += 10;        
        ServerData = getDataServer(ruta,data);
        // dibujar los datos 
        for (var i = 0; i < ServerData.length; i++) {
            construirFila(ServerData[i]);
        };
        $(".numactual").text(pagina);
        $(".numnext").text(pagina+10);
        $(".numprev").text(pagina-10);        
    });
    // si se seleccionan todos
    $('input[name="check-all"]').change(function(event) {
        if ($(this).prop('checked')) {
            $("input:checkbox").each(function(index, el) {
                $(el).prop('checked', true);
            });
        }
        
    });


});


function getDataServer(url,data){
    var rtrn;
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        data: data,
        async: false
    })
    .done(function(json) {
        console.log(json);
        rtrn = json
    })
    .fail(function() {
        console.log("error");
        alert("Error al conectar con el servidor")
    })
    .always(function() {
        console.log("complete");
    });
    return rtrn;
}


function construirFila(data) {
    // objeto que constituye el nombre_campo:valor
    // modificar los campos del objeto
    var keys = Object.keys(data);
    console.log(data);
    var $contenedor = $("<tr></tr>");
    var contenido = new Array();

    var check =  '<th><input type="checkbox" value="select"></th>'
    contenido.push(check);

    for (var i = 0; i < keys.length; i++) {
        th = "<th>" + data[keys[i]] + "</th>";
        contenido.push(th);
        
    };
    contenido = contenido.join("");
    console.log(contenido);
    $(contenido).appendTo($contenedor);
    console.log($contenedor)

    $('table[name="listado"] tbody').append($contenedor);

}



