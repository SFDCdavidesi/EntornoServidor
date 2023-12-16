<?php
require_once ("C_errores.php");

          
            
class SQL extends Errores{
    private $servername;
    private $username;
    private $password;
    private $dbname;


    protected $con;

    public function __construct($server,$usern,$pass,$dbname){
        $this->servername=$server;
        $this->username=$usern;
        $this->password=$pass;
        $this->dbname=$dbname;
        try{
        $dsn = "mysql:host=$this->servername;dbname=$this->dbname";
        $this->con = new PDO($dsn, $usern, $pass);
        $this->con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        $this->error($e->getMessage());
    }

    }

    
}
class BBDD extends SQL{
public function muestraErrores(){
    $this->pmuestraErrores();
}

    public function __construct(){
        global $config;     
        parent::__construct($config["database.host"],$config["database.username"],$config["database.password"],$config["database.dbname"]);


    }
    private function existeUsuario($username):bool{
        $stmt=$this->con->prepare("SELECT COUNT(usuario) as NumUsers from usuarios where usuario=:usuario ");
        $stmt->bindParam("usuario",$username);
        $stmt->execute();
        $numregs=$stmt->fetch(PDO::FETCH_ASSOC);
        return $numregs["NumUsers"]>0;
    }
    public function modificaUsuario($usuario):bool
    {
        try{
            $stmt=$this->con->prepare("UPDATE usuarios set email=:email, password=:password,nombre=:nombre,apellidos=:apellidos where usuario=:usuario");
            $stmt->bindParam("email",$usuario["correo"]);
            $stmt->bindParam("nombre",$usuario["nombre"]);
            $stmt->bindParam("apellidos",$usuario["apellidos"]);
            $hassedpass=password_hash($usuario["pass"],PASSWORD_DEFAULT);
            //compruebo si la contraseña se ha modificado
            $passactual=$this->damePassword($usuario["usuario"]);
            if ($usuario["pass"]!=$passactual["password"]){
                $stmt->bindParam("password",$hassedpass);
            }else{
                $stmt->bindParam("password",$passactual["password"]);

            }
           
            $stmt->bindParam("usuario",$usuario["usuario"]);

            $stmt->execute();
            return true;
        }catch(PDOException $e){
return false;
        }
    }
    public function altaUsuario($usuario):bool{
        try{
        

            $stmt = $this->con->prepare("INSERT INTO usuarios (usuario,email,password,nombre,apellidos) values (:usuario,:email,:password,:nombre,:apellidos)");
        $username=$usuario["nombreDeUsuario"];
        if ($this->existeUsuario($username)){
            $this->error("El usuario " . $username . " ya existe en la BBDD");
            return false;
        }
        $email=$usuario["email"];
        $pass=password_hash($usuario["pass1"],PASSWORD_DEFAULT);
        $nombre=$usuario["nombre"];
        $apellidos=$usuario["apellido"];

        $stmt->bindParam("usuario",$username);
        $stmt->bindParam("email",$email);
        $stmt->bindParam("password",$pass);
        $stmt->bindParam("nombre",$nombre);
        $stmt->bindParam("apellidos",$apellidos);
        $stmt->execute();
        return true;
        }catch(PDOException $e){
            $this->error($e->getMessage());
            return false;
        }
    }
    private function damePassword($u){
        try{
        $stmt=$this->con->prepare("SELECT password FROM usuarios where usuario=:u");
        $stmt->bindParam("u",$u);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            $this->error($e->getMessage());
            return null;
        }
    }
    public function validaUsuario($u,$p){
        if ($this->existeUsuario($u)){
            $ph = password_hash($p,PASSWORD_DEFAULT);
            return password_verify($p,$ph);
        }
    }
    public function getMenu(){
        try{
           $stmt = $this->con->query("select * from menu");
           return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch (PDOException $e){
            $this->error($e->getMessage());
        }
return null;
    }
    public function eliminaUsuario($usu):bool{
        try{
        $stmt=$this->con->prepare("DELETE from usuarios where usuario=:usuario");
        $stmt->bindParam("usuario",$usu);
        $stmt->execute();
        return true;
        }catch(PDOException $e){
           $this->error($e->getMessage());
           return false;
        
        }
    }
    public function getQueryParams($query,$params){
        $stmt=$this->con->query($query);
        if ($params!=null && !empty($params)){
             foreach($params as $k=>$v){
            $stmt->bindParam($k,$v);
        }    
        }
   
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        try{}catch(PDOException $e){
            $this->error($e->getMessage());
        }
    }
    
}
?>