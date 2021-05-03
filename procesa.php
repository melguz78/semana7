<?php

if($_POST){
 $cod=$_REQUEST["txtCodigo"];
 $nom=$_REQUEST["txtNombre"];
 $pre=$_REQUEST["txtPrecio"];
 $exist=$_REQUEST["txtExist"] ;
 $imagen= $_FILES["FileImagen"];

 $dir="imgs/";
 $ruta="";
 //verificando si el archivo existe, sino se crea uno en la misma instruccion 

 if(!is_dir($dir)){
   mkdir("imgs/");

 }

 //creando ruta de nuevo archivo a subir 
// 
 $ruta= $dir.basename($_FILES["FileImagen"]["name"]);
 //var_dump($ruta);
 //die();
 //subimos el archivo 
 if(move_uploaded_file($_FILES["FileImagen"]["tmp_name"], $ruta)){

   // si llega aqui es porq se subio el archivo
//guardar en base de datos
$productos = new Productos($cod, $nom, $pre, $exist, $ruta);

$productos->guardar();
exit();

}else{

  echo 'No se pudo guardar';
 }
}
if($_GET["getTabla"]){
  $producto =new Productos('','','','','');
  $data=$producto->getTabla();
  echo $data;
}



class Productos{
  public $codigo;
  public $nombre;
  public $precio;
  public $existencia;
  public $imagen;


  public function Productos($cod, $nom, $pre, $exist, $img){
         $this->codigo=$cod;
         $this->nombre=$nom;
         $this->precio=$pre;
         $this->existencia=$exist;
         $this->imagen=$img;
    
  }

  public function guardar(){
$con = new  mysqli ("localhost", "root", "", "temporal");
$sql = "insert into productos values (".$this->codigo.",'".$this->nombre."',".$this->precio.",".$this->existencia.", '".$this->imagen."')";

if($con->query($sql)){
    header("location:index.php?insertar=true");
}else{

    header("location:index.php?insertar=false");
}
  
  }
  public function getTabla(){

    $con= new mysqli("localhost", "root", "", "temporal");
    $sql= "select * from productos";

    $tabla = "<table class='table'> <thead> <tr> <th>codigo</th> <th>Nombre</th> <th>Precio</th> <th>Existencia</th> <th>Imagen</th> </tr> </thead> <tbody>";
    if($resultado = $con->query($sql)){
      while($fila =$resultado->fetch_assoc()){
          $tabla .= "<tr>";
          $tabla .="<td>".$fila["codigo"]."</td>";
          $tabla .="<td>".$fila["nombre"]."</td>";
          $tabla .="<td>".$fila["precio"]."</td>";
          $tabla .="<td>".$fila["existencia"]."</td>";
          $tabla .="<td><img src='".$fila["imagen"]."' style='width:50px; heigth:50px'></td>"; 
         $tabla .= "</tr>";

      }
        $tabla.="</tbody></table>";

    }
return $tabla;

  }

}

 ?>