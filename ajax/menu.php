<?php

if (strlen(session_id()) < 1) 
  session_start();
require_once "../modulo/ejecutarSQL.php";

$categoria=new ejecutarSQL();


$idcategoria=isset($_POST["idcategoria"])? limpiarCadena($_POST["idcategoria"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$precio=isset($_POST["precio"])? limpiarCadena($_POST["precio"]):"";
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";


switch ($_GET["op"]){


    case 'permisos':
    
        	
		$rspta = $categoria->listar("select * from permisos ");
      
            
		//Obtener los permisos asignados al usuario
		$id=$_GET['id'];
		$marcados =$categoria->listar("SELECT * FROM `detalleusuario` where idusuario=".$id);

		//Declaramos el array para almacenar todos los permisos marcados
		$valores=array();

		//Almacenar los permisos asignados al usuario en el array
		while ($per = $marcados->fetch_object())
			{
				array_push($valores, $per->idpermiso);
			}
            echo '<li> Inicio </li>';
            
		//Mostramos la lista de permisos en la vista y si están o no marcados
		while ($reg = $rspta->fetch_object())
				{
					$sw=in_array($reg->idpermisos,$valores)?'checked':'';
					echo '<li> <input type="checkbox" '.$sw.'  name="permiso[]" value="'.$reg->idpermisos.'">'.$reg->permisos.'</li>';
				}
	
               
		break;

    
    case 'guardaryeditar':
                $ms="Registro la categoria";


        if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name']))
		{
			$imagen=$_POST["imagenactual"];
		}
		else 
		{
			$ext = explode(".", $_FILES["imagen"]["name"]);
			if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png")
			{
				$imagen = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/usuarios/" . $imagen);
			}
		}


                if (empty($idcategoria))
                {
                    $sql=" INSERT INTO `comida`( `menu`, `descripcion`, `precio,  `imagen`, `condicion`) VALUES ('$nombre','$descripcion','$precio','$imagen',1)";
                  
                   

                }else
                
                {
                    $sql="update `categoria` set `categoria`='$nombre', descripcion='$descripcion' where idcategoria='$idcategoria'";
                $ms="Edito el Registro de la categoria";
                  


                }
                $respuesta=$categoria->insertar($sql);

                $perx=$_POST["permiso"];

                $i=0;

                while ($i < count($perx)){
$sql="INSERT INTO `detalleusuario`( `idusuario`, `permiso`) VALUES ( (select max(idusuario) from usuario)  , '$perx[$i]' )";
$respuesta=$categoria->insertar($sql);
                    $i++;
                }


                 echo $respuesta ? $ms : "El usuario fue registrado";     
              


    break;
case 'mostrar':
    
$sql="SELECT * FROM `categoria` WHERE idcategoria=".$idcategoria;
$respuesta=$categoria->mostrar($sql);
echo json_encode($respuesta);



break;
case 'activar':
    $sql="update `categoria` set condicion=1 WHERE idcategoria=".$idcategoria;
    $respuesta=$categoria->insertar($sql);
    echo $respuesta ? "Se activo  la categoria" : "La categoria no se pudo ingresar";     
              

    break;
case 'desactivar':
    $sql="update `categoria` set condicion=0 WHERE idcategoria=".$idcategoria;
    $respuesta=$categoria->insertar($sql);
    echo $respuesta ? "Se desactivo la categoria" : "La categoria no se pudo ingresar";     
              

    break;
    case 'verificar':
        $logina=$_POST['logina'];
	    $clavea=$_POST['clavea'];
        $xs="select * from usuario where login='".$logina."' and nombre='".$clavea."'";
	    $inf=0;
        $_SESSION['bandera']="";
        $rspta=$categoria->listar("select * from comida where login='".$logina."' and clave='".$clavea."'");
        while ($reg=$rspta->fetch_object()){
            $_SESSION['bandera']="1";

            $_SESSION['login1']=$reg->login;
            $_SESSION['nombre1']=$reg->nombre;
          
            $inf=1;
        }

        echo json_encode(  $inf);

    break;
        case 'listar':
            $rspta=$categoria->listar("select * from  comida order by nombre desc");
            //Vamos a declarar un array
            $data= Array();
   
            while ($reg=$rspta->fetch_object()){
                $data[]=array(
                    "0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idmenu.')">Editar</button>'.
                        ' <button class="btn btn-danger" onclick="desactivar('.$reg->idmenu.')">Anular</button>':
                        '<button class="btn btn-warning" onclick="mostrar('.$reg->idmenu.')"><i class="fa fa-pencil">Editar</i></button>'.
                        ' <button class="btn btn-primary" onclick="activar('.$reg->idmenu.')"><i class="fa fa-check"></i></button>',
                        "1"=>$reg->menu,
                        "2"=>$reg->precio,
                    "3"=>'<img src=../files/usuarios/'.$reg->imagen.' width=36 height=36 >',
                    "4"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':
                    '<span class="label bg-red">Desactivado</span>'
                    );
            }
            $results = array(
                "sEcho"=>1, //Información para el datatables
                "iTotalRecords"=>count($data), //enviamos el total registros al datatable
                "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
                "aaData"=>$data);
            echo json_encode($results);
   
       break;
        break;
}
?>