function addCarrito(id){
let direccion=window.location;
direccion+="?addProduct=" + id;
   window.location=direccion;
}
