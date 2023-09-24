<?php
include("../conf/Conexion.php");
$group=array();
//consula para consultar datos
if(isset($_POST['editG'])){
    $EditG=$_POST['editG'];
    for($i=0;$i<count($EditG);$i++){
        $seleditG=mysqli_query($Conexion,"select * from pedido where id_ship='$EditG[$i]'");
        $dataG=mysqli_fetch_array($seleditG);
        $group['N'.$i]=$dataG['id_pedido'];
    }
    $group['Gtotal']=count($EditG);
    if(!$seleditG){
        echo mysqli_error($Conexion);
    }
}

//actualizacion
if(isset($_POST['id_update'])){
    $idGup=$_POST['id_update']; //variable con el array
    $stateG=$_POST['state'];  //variable con el valor
    switch($stateG){  //switch para cada caso del valor
        case '1':
            $stateG='Panamá';
            break;
        case '2':
            $stateG='En curso';
            break;
        case '3':
            $stateG='Venezuela';
            break;
    }
    //ciclo for para actualizar cada valor
    for($b=0;$b<count($idGup);$b++){
        $updateG=mysqli_query($Conexion,"update pedido set estado='".$stateG."' where id_pedido='".$idGup[$b]."'");
    }   
    if(!$updateG){
        $group['stat']='error'.mysqli_error($Conexion).'';
    }else{
        $group['stat']='ok';        
    }
}

//eliminar
if(isset($_POST['DelG'])){
    $groupDel=$_POST['DelG'];
    for($e=0;$e<count($groupDel);$e++){
         $eliminarG=mysqli_query($Conexion,"update pedido set eliminado='si' where id_ship='".$groupDel[$e]."' ");
    }   
    if(!$eliminarG){
        $group['stat']='error'.mysqli_error($Conexion).'';
    }else{
        $group['stat']='ok';        
    }
}
echo json_encode($group);
?>
