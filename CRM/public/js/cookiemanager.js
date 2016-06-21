
function readCookie(name) {
  // leer el valor de una cookie
  var nameEQ = name + "="; 
  var ca = document.cookie.split(';');

  for(var i=0;i < ca.length;i++) {

    var c = ca[i];
    while (c.charAt(0)==' ') c = c.substring(1,c.length);
    if (c.indexOf(nameEQ) == 0) {
      return decodeURIComponent( c.substring(nameEQ.length,c.length) );
    }

  }

  return null;

}

function deleteValueFromCookie (name,value,path="/") {
  var elementos = readCookie(name);
  elementos = elementos.split(",");
  var indice = elementos.indexOf(value);
  elementos.splice(indice, 1);
  document.cookie = name+"="+encodeURIComponent(elementos.join(","))+";path="+path;

}

function borrarCookie (name) {
  document.cookie = name+"=;max-age=0"
  
}