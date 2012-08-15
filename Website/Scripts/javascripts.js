

 var fotos=new Array('./Bilder/Hülsen.jpg','./Bilder/Knochen.jpg','./Bilder/zylinder.jpg','./Bilder/Wurstform.jpg','./Bilder/Ringe.jpg','./Bilder/Scheiben.jpg');

 var speed=5000;
 var pos=0;

function start() {
 if (document.title == "Startseite") {
  document.getElementById("menu1").style.backgroundColor = '#F76114';
  }
 if (document.title == "Über uns") {
  document.getElementById("menu2").style.backgroundColor = '#F76114';
  }
 if (document.title == "fuhrpark") {
  document.getElementById("menu2").style.backgroundColor = '#F76114';
  }
 if (document.title == "Anfahrt") {
  document.getElementById("menu4").style.backgroundColor = '#F76114';
  }
}
function doit () {

// Diashow-Script von Thomas Salvador, http://www.brauchbar.de
// Freeware. Nutzung erlaubt, solange diese Copyrightmeldung
// unveraendert erhalten bleibt.

if (!(document.images)) {return;}

 document.bild.src=fotos[pos++];

 if (pos == fotos.length) { pos = 0; }
 setTimeout("doit();",speed);
}



