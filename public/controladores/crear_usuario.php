<!DOCTYPE html> 
<html> 
<head> 
<meta charset="UTF-8"> 
    <title> Nuevo REGISTRO </title> 
</head> 
<body> 
 
    <?php                  
        include '../../config/conexionBD.php';                 
 
        $nombres = isset($_POST["nombres"]) ? mb_strtoupper(trim($_POST["nombres"]), 'UTF-8') : null; 
        $apellidos = isset($_POST["apellidos"]) ? mb_strtoupper(trim($_POST["apellidos"]), 'UTF-8') : null;         
        $correo = isset($_POST["correo"]) ? trim($_POST["correo"]): null;         
        $contrasena = isset($_POST["contrasena"]) ? trim($_POST["contrasena"]) : null;
        $fotoNombre = $_FILES["foto"]["name"];
        $fotoRuta = $_FILES["foto"]["tmp_name"];
        $fotoDestino = "../../fotos/".$fotoNombre;
        copy($fotoRuta,$fotoDestino);

        $rol = "user";
                
        $sql = "INSERT INTO usuario VALUES (0, '$nombres', '$apellidos', '$correo', MD5('$contrasena'), '$rol', 0, null, null, '$fotoDestino')";         
 
        if ($conn->query($sql) === TRUE) {             
            echo "<p>REGISTRADO</p>";      
        } else {             
            if($conn->errno == 1062){                 
                echo "<p class='error'>La persona con la cedula $cedula ya esta registrada en el sistema </p>";
            }else{                 
                echo "<p class='error'>Error: " . mysqli_error($conn) . "</p>"; 
            }             
        } 
         
        
        $conn->close();         
        echo "<a href='../vista/crear_usuario.html'>Regresar</a>"; 
    ?> 
 
</body> 
</html> 
        