if (!!window.Notification) {




if (Notification.permission === "granted") {
    // enviar las notificaciones
    recibeNotification();
}
else if (Notification.permission != "denied") {
    // crear un boton que permita las notificaciones
    var r = confirm("Desea recibir notificaciones en su navegador")
    if (r) {
        // pedir permiso
        Notification.requestPermission(function (permission) {
            // si autorizo mostrar notificaciones
            if (permission === "granted") {
                // enviar las notificaciones 
                recibeNotification();
            }

        })        
    }
}
}

function recibeNotification() {
    
}