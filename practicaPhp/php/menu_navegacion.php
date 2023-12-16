<?php
require_once "php/configuracion.php";
require_once "php/C_SQL.php";
class Menu {
    private  $BBDD;
    public function __construct(){
        $this->BBDD = new BBDD  ();
    }   
    public  function pintaMenuList(){
        $menu=$this->BBDD->getMenu();

        foreach ($menu as $k=>$v){
           if ($v["parent"]==null){
            echo "<li><a href=' " . $_SERVER['PHP_SELF'] . "?idMenu=" . $v["id"] . "'>" .  $v["nombre"] . "</a></li>";
           }
        }
    }
    public function pintaMenuListBootstrap(){
        $consultarecursiva="
        WITH RECURSIVE cte AS (
          SELECT id, nombre, parent,orden
          FROM menu
          WHERE parent IS NULL and activo=true
          UNION ALL
          SELECT t.id, t.nombre, t.parent, t.orden
          FROM menu t
          JOIN cte c ON t.parent = c.id
        )
        SELECT *
        FROM cte order by orden
        ";
        $registros=$this->BBDD->getQueryParams($consultarecursiva, null);
        $menu = array();
foreach ($registros as $registro) {
    if ($registro["parent"] == null) {
        $menu[$registro["id"]] = array(
            "nombre" => $registro["nombre"],
            "id"=>$registro["id"],
            "children" => array()
        );
    } else {
        $menu[$registro["parent"]]["children"][] = array(
            "nombre" => $registro["nombre"],
            "id"=> $registro["id"]
        );
    }
}
   return $menu;
 }
 public static function enlaceMenu($id){
    return $_SERVER['PHP_SELF'] . "?id=" . $id;
 }
 public static function itemUsuario($session){
    $linea=" <li class=\"nav-item\">
    <a class=\"nav-link \" href=\"" . Menu::enlaceMenu('usuario') . "\" tabindex=\"-1\" aria-disabled=\"false\">" . $session["usuario"] . "</a>
  </li>";
  return $linea;
 }
 public static function itemMenu($item){
    $linea="";
    if (empty($item["children"])){
        $linea=" <li class=\"nav-item\">";
        $linea.="\r";
        $linea.="<a class=\"nav-link active\" aria-current=\"page\" href=\"" . Menu::enlaceMenu($item["id"]) . "\">" . $item ["nombre"] . "</a>";
        $linea.="</li>";
     }else{
        $linea=" <li class=\"nav-item dropdown\">";
        
        $linea.="  <a class=\"nav-link active dropdown-toggle\" href='#' id=\"navbarScrollingDropdown\" role=\"button\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">" . $item ["nombre"] . "</a>";
     
        $linea.= "<ul class=\"dropdown-menu\" aria-labelledby=\"navbarScrollingDropdown\">";
        foreach ($item["children"] as $child) {
            $linea.=
            "<li><a class=\"dropdown-item\" href=\"" . Menu::enlaceMenu($item["id"]) . "\">" . $child ["nombre"] . "</a>";
            $linea.="</li>\r";
        }
        $linea.= "</ul>\r";
       
     }
    
   return $linea;
}
}
 $menuNavegacion = new Menu();
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar scroll</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
      <?php
      $menu=$menuNavegacion->pintaMenuListBootstrap();
foreach ($menu as $item) {
   echo Menu::itemMenu($item);
}
echo Menu::itemUsuario($_SESSION);
?>
     
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
