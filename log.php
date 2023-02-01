<?php
include("conexion.php");
include "SED.php";
// para q funcione el sed, toca buscar ;extension=php_openssl.dll en el php.iniy quitar el ; debe quedar asi extension=php_openssl.dll

$conexion = conectar();
$user = $_POST["user"];
$pass = $_POST["pass"];
 if($_GET["Recordar"] == 'true'){
     $recordar = "true";
 } else {
     $recordar = "false";
 }

$data = array();
$data['status'] = 0;
$data['result'] = '';
$data['message'] = 'Usuario en blanco no valido!';
$data['recordar'] = $_GET["Recordar"];
$hoy = date("Y-m-d H:i:s");

if($user) {
    $select = mysqli_query($conexion, "SELECT * FROM usuario WHERE usu_correo='$user' and usu_estado = 'A'");
    $resultado = mysqli_fetch_array($select);

    switch (mysqli_num_rows($select)) {
        case 1:
            $claveu = SED::encryption(trim($pass));
            $claveb = trim($resultado["usu_clave"]);
            if ($claveu == $claveb) {
                $data['status'] = 1;
                $data['result'] = $resultado;
                $data['message'] = '';

                $_SESSION['usu_nombre'] = $resultado['usuario_apellido1'] . " " . $resultado['usuario_apellido2'] . " " . $resultado['usuario_nombre1'] . " " . $resultado['usuario_nombre2'] ;
                $_SESSION['usu_usuario'] = $resultado['usuario_usuario'] ;
                $_SESSION['usu_grupo'] = $resultado['usuario_grupo'];
                $_SESSION['usu_area'] = $resultado['area_servicio_id'];
                $_SESSION['usu_areanom'] = $resultado['area_servicio_nombre'];
                $_SESSION['usu_id'] = $resultado['usuario_id'];
                $_SESSION['usu_cc'] = $resultado['usuario_documento'];
                $_SESSION['usu_act'] = $resultado['usuario_estado'];
                $_SESSION['usu_tel'] = $resultado['usuario_celular'];
                $_SESSION['usu_email'] = $resultado['usuario_correo'];
                $_SESSION['usu_cargo'] = $resultado['cargo_id'];
                $_SESSION['usu_cargonom'] = $resultado['cargo_nombre'];
                $_SESSION['usu_medicoid'] = $resultado['medico_id'];
                
                $insert = "UPDATE usuario SET usuario_ultacceso = '$hoy' WHERE usuario_id= ".$_SESSION['usu_id']." ";			
                $log = mysqli_query($conexion,$insert);
                
                
                //destruye variables anteriores
                //setcookie('usu_usuario', $_SESSION['usu_usuario'], time() - 3600); 
                //setcookie('usu_grupo', $_SESSION['usu_grupo'], time() - 3600);
                
                //un ano
                //setcookie('vck_campo1', $_SESSION['usu_usuario'], time() + 365 * 24 * 60 * 60); 
    
                setcookie('vck_campo1', $_SESSION['usu_usuario'], time() + 365 * 24 * 60 * 60); 
                setcookie('vck_campo2', $pass, time() + 365 * 24 * 60 * 60); 
                setcookie('vck_campoP', $recordar, time() + 365 * 24 * 60 * 60); 
    
            } else {
                $data['message'] = "Clave Incorrecta!";
            }

            break;
            
        
        case 0:
            $data['message'] = 'Usuario no Encontrado!';
            break;

        default:
            $data['message'] = 'Usuario no Encontrado! (1)';
            break;
    }
}

echo json_encode($data);

?>
