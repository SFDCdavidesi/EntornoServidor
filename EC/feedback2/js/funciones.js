function creaTabla(muestra = "todos") {
    let contenido = document.getElementById("contenidotabla");
      contenido.innerHTML='';
    let conta = 0;
    for (var i = 0; i < filas; i++) {
      let tr=document.createElement("TR");
      for (var j = 0; j < columnas; j++) {
          let td=document.createElement("TD");
        let imagen = document.createElement("img");

        imagen.src = "./img/segovia/imagen" + ++conta + ".jpg";
        let parimpar=(conta%2==0?"par":"impar");
        imagen.alt="Imagen " + conta + " , por lo que es " + parimpar;
        imagen.title=conta + " " + parimpar;
        imagen.width = 200;
        if (
          muestra == "todos" ||
          (muestra == "par" && conta % 2 == 0) ||
          (muestra == "impar" && conta % 2 != 0)
        ) {
        //  contenido.appendChild(imagen);
        td.appendChild(imagen);
        tr.appendChild(td);
        }
      }
      contenido.appendChild(tr);
    }
  }