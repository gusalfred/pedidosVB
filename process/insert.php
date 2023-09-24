<?php
include("../conf/Conexion.php");
if(isset($_POST['numero'])){
    $num=$_POST['numero'];
}else{
    $num="";
}
//array para el json
$insert=array();
if($num !=''){
    for ($i=0; $i < count($num); $i++) {
        //revision de valores repetidos
        $revisa=mysqli_query($Conexion,"select * from pedido where id_pedido='$num[$i]'");
        //conteo de coincidencias
        $cont=mysqli_num_rows($revisa);
        //mensaje en caso de haber una o mas coincidencias
        if($cont>0){
            $insert['stat']="repetido";
             $insert['msg']="<i class='fa fa-lg mdi mdi-alert-outline'></i>&nbsp Ya existe un registro con este número: ".$num[$i];
            echo json_encode($insert);
            die();
        }else{
            $newShip=mysqli_query($Conexion,"insert into pedido (id_pedido) values ('".strtoupper($num[$i])."')");
            if(!$newShip){
                $insert['stat']="error";
                $insert['msg']="<i class='mdi mdi-close-circle-outline'></i> Error al insertar".mysqli_error($Conexion)."";
                }else{
                    $insert['stat']="ok";
                    $insert['msg']='<i class="fa fa-2x mdi mdi-check-circle-outline"></i>&nbsp Insertado!';
                    mysqli_free_result($revisa);
                }
            }
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