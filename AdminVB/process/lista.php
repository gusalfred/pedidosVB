<?php
include("../conf/Conexion.php");
if(isset($_POST['busq'])){
    $busq=$_POST['busq'];
    $lista=mysqli_query($Conexion,"select * from pedido where id_pedido like '%$busq%' and eliminado='no'");
    $count=mysqli_num_rows($lista);
}else{
    $lista=mysqli_query($Conexion,"select * from pedido where eliminado='no' order by id_pedido");
    $count=mysqli_num_rows($lista);
}
?>
<?php
if($count>0){?>
<!--inicio tabla -->
    <table class="responsive-table highlight bordered centered">
        <tr>
            <td>
            <input type="checkbox" id="checkall" class="" />
            <label for="checkall" class="black-text ">  
            <b>Código de Pedido</b>
            
            </td>
            <td><b>Estado</b></td>
            <td><b>Opciones</b></td>
        </tr>
    <?php
    for($i=0;$i<$count;$i++){
        $data_ship=mysqli_fetch_array($lista)
        ?>
        <tr>
            <td class="">
            <input type="checkbox" id="check<?php echo $i?>" name="idS[]" value="<?php echo $data_ship['id_ship']?>" class="checkB"/>
            <label for="check<?php echo $i?>" class="grey-text text-darken-4">  
            <?php echo $data_ship['id_pedido']?>
            </label>
            </td>
            <td>
            <?php
            switch($data_ship['estado']){
                case 'Panamá':
                    echo '<b class="red-text"><i class="flag-icon flag-icon-pa"></i> Panamá</b>';
                    break;
                case 'En curso':
                    echo '<b class="amber-text"><i class="fa fa-lg mdi mdi-truck-fast"></i> En camino</b>';
                    break;
                case 'Venezuela':
                    echo '<b class="green-text text-accent-4">Venezuela <i class="flag-icon flag-icon-ve"></i></b>';
                    break;
            }
            ?></td>
            <td class="">
                <button class="btn-floating btn-flat tooltipped waves-effect waves-teal edit" href="#editar" data-tooltip="editar" data-edit="<?php echo $data_ship['id_ship']?>">
                    <i class="mdi mdi-pencil  grey-text text-darken-3"></i>
                </button>
                <button class="btn-floating btn-flat tooltipped waves-effect waves-red delete"  href="#delete" data-tooltip="eliminar" data-del="<?php echo $data_ship['id_ship']?>">
                    <i class="mdi mdi-delete grey-text text-darken-3"></i>
                </button>
            </td>
        </tr>
    <?php } ?>
    </table>
<?php
}else{ ?>
    <div class="center-align">
        <p style="font-size: x-large;" class="grey-text text-lighten-1"><i class="fa fa-5x mdi mdi-file-hidden "></i><br>Sin registros</p>
    </div>  
<?php }
?>