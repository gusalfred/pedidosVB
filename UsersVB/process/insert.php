<?php
include("../conf/Conexion.php");
if(isset($_POST['nombre'])){
     $name=mysqli_real_escape_string($Conexion,$_POST['nombre']);
}
if(isset($_POST['apellido'])){
    $lastname=$_POST['apellido'];
}
if(isset($_POST['id'])){
    $id=mysqli_real_escape_string($Conexion,$_POST['id']);
}
if(isset($_POST['correo'])){
    $mail=$_POST['correo'];
}
if(isset($_POST['telf'])){
    $telf=$_POST['telf'];
}
if(isset($_POST['telfOfi'])){
    $telfOfi=$_POST['telfOfi'];
}
if(isset($_POST['pais'])){
    $pais=$_POST['pais'];
}
if(isset($_POST['states'])){
    $estado=$_POST['states'];
}
if(isset($_POST['cities'])){
    $city=$_POST['cities'];
}
if(isset($_POST['address'])){
    $add=mysqli_real_escape_string($Conexion,$_POST['address']);
}
if(isset($_POST['code'])){
    $code=mysqli_real_escape_string($Conexion,$_POST['code']);
}else{
    $code='';
}
//array para el json
$insert=array();
//inserción en caso de q se reciba el post numero
//revision de valores repetidos
$revisa=mysqli_query($Conexion,"select * from users where ci='$id'");
//conteo de coincidencias
$cont=mysqli_num_rows($revisa);
//mensaje en caso de haber una o mas coincidencias
if($cont>0){
    $insert['stat']="repetido";
    $insert['msg']="<i class='fa fa-lg mdi mdi-alert-outline'></i>&nbsp Ya existe un registro con la identidad: ".$id;
    echo json_encode($insert);
    mysqli_free_result($revisa);
    die();
}else{
    $newUsr=mysqli_query($Conexion,"insert into users (nombre,apellido,ci,telf,telfOfi,address,code,pais,estado,ciudad)
                         values ('$name','$lastname','$id','$telf','$telfOfi','$add','$code','$pais','$estado','$city')");
    if(!$newUsr){
        $insert['stat']="error";
        $insert['msg']="<i class='mdi mdi-close-circle-outline'></i> Error al insertar".mysqli_error($Conexion)."";
        }else{
            $insert['stat']="ok";
            $insert['msg']='<i class="fa fa-2x mdi mdi-check-circle-outline"></i>&nbsp Registro Agregado con éxito!';
            mysqli_free_result($revisa);
        }
    }
//consula para consultar datos
if(isset($_POST['id_edit'])){
    $idEdit=$_POST['id_edit'];
    $seledit=mysqli_query($Conexion,"select * from pedido where id_ship='$idEdit'");
    $datacons=mysqli_fetch_array($seledit);
    $insert['name_cons']=$datacons['id_pedido'];
    $insert['stat_cons']=$datacons['estado'];
}

//actualizacion
if(isset($_POST['id_update'])){
    $idup=$_POST['id_update'];
    $state=$_POST['state'];
    switch($state){
        case '1':
            $state='Panamá';
            break;
        case '2':
            $state='En curso';
            break;
        case '3':
            $state='Venezuela';
            break;
    }
    $update=mysqli_query($Conexion,"update pedido set estado='".$state."' where id_ship='".$idup."'");
    if(!$update){
        $insert['stat']='error'.mysqli_error($Conexion).'';
    }else{
        $insert['stat']='ok';        
    }
}

//eliminar
if(isset($_POST['id_Del'])){
    $idDel=$_POST['id_Del'];
    $eliminar=mysqli_query($Conexion,"update pedido set eliminado='si' where id_ship='$idDel'");
    if(!$eliminar){
        $insert['stat']='error'.mysqli_error($Conexion).'';
    }else{
        $insert['stat']='ok';        
    }
}
echo json_encode($insert);
?>