<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  


  <title>Document</title>
  <script> 
                $(document).ready(function(){
//programacion de boton llenar formulario 
               
                 $("#btnLlenar").on("click", function(){

                $('#miModal').modal({backdrop:'static', keyboar:false});

                });
                $('#FileImagen').on('change', function(){
          var tam = this.files[0];
           ("Tamaño real:" + tam);
          var megas= (tam/1024)/1024;
          ("Tamaño en megas" + megas);
          if(megas > 2){
            alert(' La  imagen supera la cantidad de megas permidos para un archivo, seleccione una de maximo 2 megas');
            $('#FileImegen').val="";
          }

        })

        $("#btnver").on("click", function(){
            $.ajax ({
              type:"get",
              url: "procesa.php",
              data:{getTabla: true},
              datatype: "html",
              async: true
            }).done(function(respuesta){
              $("#aqui").append(respuesta);
            }).fail(function(){
              elert ('error');
            })
        })
    });
                </script>  
</head>
<body>

<br>
 <h4>SOPORTE TABLA PRODUCTOS </h4> 
      <input type="button"  value="Nuevo Registro" name="btnLlenar" id="btnLlenar" class="btn btn-danger">
      <input type="button"  value="Ver Tabla" name="btnver" id="btnver" class="btn btn-primary">
        <br><br>
        <div id="aqui">
        
        </div>
        <div id="miModal" class="modal fade show" role="dialog" aria-hidden="true" style="pading left=40%" >
              <div class="modal-dialog modal-lg">
                <div class="modal-content" style="width: 520px;">
                  <div class="modal-header">
                     <div  style="width: 500px;"   class="form-group;" >          
                      
                        <h4>login</h4> <hr>
                        <br><br>
                              <form action="procesa.php" method="post" enctype="multipart/form-data" >

                              <input type="text" name="txtCodigo" placeholder="Codigo de producto" class=" form-control"><br><br>
                              <input type="text" name="txtNombre" placeholder="Nombre de producto" class=" form-control"><br><br>
                              <input type="text" name="txtPrecio" placeholder="Precio de producto" class=" form-control"><br><br>
                              <input type="number" name="txtExist" placeholder="Existencia  producto" class=" form-control"><br><br>
                              <input type="file" name="FileImagen" id="FileImagen"><br><br>
                              <div class="modal-footer">
                                 
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                  <input type="submit" name="btnGuardar" value="Guardar" class="btn  btn-success">
                              </div>
                              
                              
                              </form>
                         </div>       



         </div>
              </div>
                  </div>
                       </div>
                            </div>


</body>
</html>