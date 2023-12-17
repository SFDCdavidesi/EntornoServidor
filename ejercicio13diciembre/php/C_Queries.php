<?php
class Queries{
const GET_LIBROS ="select l.codigo as codigo,l.titulo as titulo,a.nombre as nombre,a.apellidos as apellidos,l.disponible as disponible from libros l join autores a on a.codigo_autor=l.codigo_autor";
const GET_AUTORES="select codigo_autor,nombre,apellidos from autores order by nombre asc";
const CREATE_AUTORES="INSERT INTO autores (nombre,apellidos,año_nacimiento) values(:nombre,:apellidos,:anio_nacimiento)";
const CREATE_LIBROS="INSERT INTO libros (titulo,codigo_autor,disponible) values(:titulo,:codigo_autor,:disponible)";

const GET_NUM_AUTORES="SELECT COUNT(nombre) as numAutores from autores where nombre=:nombre AND apellidos=:apellidos";
const GET_NUM_LIBROS="SELECT COUNT(titulo) as numLibros from libros where titulo=:titulo AND codigo_autor=:codigo_autor";
const GET_LIBRO="select * from libros where codigo=:codigo_libro";
const UPDATE_LIBRO="UPDATE libros set titulo=:titulo,codigo_autor=:codigo_autor,disponible=:disponible where codigo=:codigo_libro";
const DELETE_LIBRO="DELETE FROM libros where codigo=:codigo_libro";
}
?>