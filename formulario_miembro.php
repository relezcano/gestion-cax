

<? session_start();
if (empty($_SESSION["id"])){
	header("Location: index.php");
	exit();}
require("include/connect_db.php");

$email="";
$password="";	
$id="0";
$nombre="";
$boton="nuevo";
$domicilio="";
$apellido="";
$dni="";
$celular="";
$fijoDia="";
$fijoNoche="";
$fechaNacimiento="";
$idcategoria="0";
$permiso="0";


if (isset($_GET['id'])){
	$id=$_GET['id'];
	$boton="Modificar";
	$query = 'select * from CAX.miembro where idmiembro="'.$id.'";';
	$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
	$row=mysql_fetch_object($result);
	$nombre=$row->nombre;
	$email=$row->email;
	$domicilio=$row->domicilio;
	$apellido=$row->apellido;
	$dni=$row->dni;
	$celular=$row->celular;
	$fijoDia=$row->fijoDia;
	$fijoNoche=$row->fijoNoche;
	$fechaNacimiento=$row->fechaNacimiento;
	$password=$row->password;
	$idcategoria=$row->idcategoria;
	$permiso=$row->permiso;
}
?>
<html>
<head>
	<title> Comisión de Auxilio - Sistema de Gestion de Disponibilidad de Miembros de Auxilio  </title>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<!-- Estas lineas necesita boostrap para funcionar, necesita incorporar estos archivos -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/style.css">
	<script src="js/bootstrap.min.js"></script>
	<!--estas lines incorporan los archivos necesarios para el datepicker -->
	<meta charset="utf-8" />
    <link rel="stylesheet" href="css/jquery-ui.css" />
    <script src="js/jquery-1.9.1.js"></script>
    <script src="js/jquery-ui.js"></script>
    <!-- funcion para dar formato al text de la fecha -->
	<script>
    $(function() {
        $(".fecha").datepicker(
            {
                dateFormat: "yy/mm/dd",
                dayNames: [ "Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado" ],
                dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ],
                firstDay: 1,
                gotoCurrent: true,
                monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
                monthNamesShort:["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep", "Oct","Nov","Dic"],
                minDate: "-80Y",
                maxDate: "-15Y" ,
                prevText: '&#x3c;&#x3c;Ant', 
        		prevStatus: '',
        		prevJumpText: '&#x3c;&#x3c', 
        		prevJumpStatus: '',
        		nextText: 'Sig&#x3e;&#x3e', 
        		nextStatus: '',
        		nextJumpText: '&#x3e;&#x3e', 
        		nextJumpStatus: '',
        		//changeMonth: true ,
        		changeYear:true//,
        		//numberOfMonths:1
            }
        );
    });
    </script>
    <style>
        #fecha {width:100px;text-align:center;}
    </style>

   <script>
function funcionAceptar(){
    var nombre= document.getElementById('nombre').value;
	var apellido=document.getElementById('apellido').value;
	var email=document.getElementById('email').value;
	var domicilio=document.getElementById('domicilio').value;
	var dni=document.getElementById('dni').value;
	var fechaNacimiento=document.getElementById('fechaNacimiento').value;
	var celular=document.getElementById('celular').value;
	var password=document.getElementById('password').value;
	var cat1=document.getElementById('cat1').checked;
	var cat2=document.getElementById('cat2').checked;
	var cat3=document.getElementById('cat3').checked;
	if(nombre==''){
		alert("El Campo 'Nombre' Esta Vacio");
		document.getElementById('nombre').focus();
		var apellido=document.getElementById('apellido').value;
		return false;
	}else if(apellido==''){
		alert("El Campo 'Apellido' Esta Vacio");
		document.getElementById('apellido').focus();
		return false;
	}else if(email==''){
		alert("El Campo 'email' Esta Vacio");
		document.getElementById('email').focus();
		return false;
	}else if(domicilio==''){
		alert("El Campo 'Domicilio' Esta Vacio");
		document.getElementById('domicilio').focus();
		return false;
	}else if(dni==''){
		alert("El Campo 'DNI' Esta Vacio");
		document.getElementById('dni').focus();
		return false;
	}else if(fechaNacimiento==''){
		alert("El Campo 'fechaNacimiento' Esta Vacio");
		document.getElementById('fechaNacimiento').focus();
		return false;
	}else if(fechaNacimiento=='0000-00-00'){
		alert("'FechaNacimiento' No valida");
		document.getElementById('fechaNacimiento').focus();
		return false;	
	}else if(celular==''){
		alert("El Campo 'Celular' Esta Vacio");
		document.getElementById('celular').focus();
		return false;
	}else if(password==''){
		alert("El Campo 'password' Esta Vacio");
		document.getElementById('password').focus();
		return false;
	}else if (password=='cax1234'){
		alert("Debe Cambiar El PASSWORD");
		document.getElementById('password').focus();
		return false;
	}else if(cat1==false&&cat2==false&&cat3==false){
		alert("Seleccione una Categoria");
		document.getElementById('cat1').focus();
		return false;
	}else{
		return true;
	}	
}
    </script>
 <?
 function emailChange(){
 	echo("<script> alert('existe');</scrtipt>");
 	
 }
 ?>
</head>
<body>
<!-- Navegador-->
<div class="container-full">
	<div class="row">
		<div class="col-md-12">
			<nav role="navigation" class="navbar navbar-default navbar-inverse">
				<div class="navbar-header">
					<!-- Todo se desplegara menos el logotipo-->
					<button type="button" class="navbar-toggle" data-toggle="collapse"
       			     data-target=".navbar-ex1-collapse">
      					<span class="sr-only">Desplegar navegación</span>
      					<span class="icon-bar"></span>
      					<span class="icon-bar"></span>
      					<span class="icon-bar"></span>
    				</button>
    				<!-- Logotipo-->
					<a class="navbar-brand" href="inicio.php"><img src="img/logoComAux.jpg" id="img" width="50px" class="img-circle"></a>
				</div>
				<!-- Elementos desplegables-->
				<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav">
					<li><a href="inicio.php">Inicio</a></li>
					<li><a href="listadomiembro.php">Listado</a></li>
					
				</ul>

				<ul class="nav navbar-nav navbar-right">
					<p class="navbar-text"><font color="red">Conectado como <? echo $_SESSION["nombre"]; echo " ";
					echo $_SESSION["apellido"]; ?></font> </p>
					<li><a href='formulario_miembro.php?id=<? echo $_SESSION["id"];?>'>Mis datos</a></li>
					<li><form  class="navbar-form navbar-right" method="post" action="listadomiembro.php?go"> 
	     	 			<input  type="text" name="name" class="form-control" placeholder="Nombre o apellido"> 
	    	 			<input  type="submit" name="buscar" class="btn btn-danger" value="Buscar"> 
	   	 			</form> </li>
					<li><a href="include/sesion.php" ><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
				</ul>
				</div>
			</nav>
		</div>
	</div>
	<!--inicio  fila  contenedora formulario-->
		<div class="row"> 
		<div class="col-md-1">
		</div>
		<div class="col-md-8">	
			<h3>Formulario de miembro</h3><p></p>
			<form class="form-horizontal" action="include/servicio_miembro.php" method="POST" name="miembro">
				<?if (isset($_GET["ext"])==FALSE && $nombre!="Root"){?>
				<p><?echo ("<input type='hidden' name='id' value='$id'>"); ?></p>
		      	<label  class="col-sm-2 control-label">Nombre</label>
				<p><? echo("<input type='text' name='nombre' id='nombre'value='$nombre'>");?></p>
				<label class="col-sm-2 control-label">Apellido</label>
				<p><? echo("<input type='text' name='apellido' id='apellido'value='$apellido'>");?></p>
				<label class="col-sm-2 control-label">Password</label>
				<p><? echo("<input type='password' name='password' id='password' value='$password'>");?></p>
				<label class="col-sm-2 control-label">Email</label>
				<p><? echo("<input type='text' name='email' id='email' value='$email' >"); ?></p>
				<label class="col-sm-2 control-label">Domicilio</label>
				<p><? echo("<input type='text' name='domicilio' id='domicilio' value='$domicilio'>");?></p>
				<label  class="col-sm-2 control-label">DNI</label>
			  	<p><? echo("<input type='text' name='dni' id='dni' value='$dni'>"); ?></p>
			  	<label class="col-sm-2 control-label">Fecha Nac.</label>
			  	<p><? echo("<input type='text' name='fechaNacimiento' id='fechaNacimiento'class='fecha'value='$fechaNacimiento'>");?></p>
				<label  class="col-sm-2 control-label">Celular</label>
			    <p><? echo("<input type='text' name='celular' id='celular' value='$celular'>");?></p>
				<label  class="col-sm-2 control-label">Tel fijo dia</label>
		    	<p><? echo("<input type='text' name='fijoDia' value='$fijoDia'>"); ?></p>
				<label class="col-sm-2 control-label">Tel fijo noche</label>
		    	<p><? echo("<input type='text' name='fijoNoche' value='$fijoNoche'>");?></p>
		    	<?}else {?>
		    	<p><?echo ("<input type='hidden' name='id' value='$id'>"); ?></p>
		      	<label  class="col-sm-2 control-label">Nombre</label>
				<p><? echo("<input disabled='true' type='text' name='nombre' id='nombre' value='$nombre'>");?></p>
				<label class="col-sm-2 control-label">Apellido</label>
				<p><? echo("<input disabled='true' type='text' name='apellido' id='apellido' value='$apellido'>");?></p>
				<label class="col-sm-2 control-label">Email</label>
				<p><? echo("<input disabled='true' type='text' name='email' id='email' value='$email'>"); ?></p>
				<label class="col-sm-2 control-label">Domicilio</label>
				<p><? echo("<input disabled='true' type='text' name='domicilio' id='domicilio' value='$domicilio'>");?></p>
				<label  class="col-sm-2 control-label">DNI</label>
			  	<p><? echo("<input disabled='true' type='text' name='dni' id='dni' value='$dni'>"); ?></p>
			  	<label class="col-sm-2 control-label">Fecha Nac.</label>
			  	<p><? echo("<input disabled ='true' type='text' name='fechaNacimiento' id='fechaNacimiento'class='fecha'value='$fechaNacimiento'>");?></p>
				<label  class="col-sm-2 control-label">Celular</label>
			    <p><? echo("<input disabled='true' type='text' name='celular' id='celular' value='$celular'>");?></p>
				<label  class="col-sm-2 control-label">Tel fijo dia</label>
		    	<p><? echo("<input disabled='true' type='text' name='fijoDia' value='$fijoDia'>"); ?></p>
				<label class="col-sm-2 control-label">Tel fijo noche</label>
		    	<p><? echo("<input disabled='true' type='text' name='fijoNoche' value='$fijoNoche'>");?></p>
		    	<?}?>
		    	 <p></p>
	    		<?if ($_SESSION["permiso"]==1 && $nombre!="Root"){
	    			if ($permiso==1)
	    				echo("<input type='checkbox' name='permiso' checked='checked' 
								value='1'>");
	    				else 
	    					echo("<input type='checkbox' name='permiso'
								value='1'>");
	    		echo(" ¿Administrador del sistema?");
	    		}
				?>
		    	<p></p>
		    	<? if (isset($_GET["ext"])==FALSE)
						echo("<td><a title='Ver disponibilidad' href='disponibilidad.php?idmiembro=$id&owner'><button type='button' class='btn  btn-success'><span>Ver disponibilidad</span></button></a></td>");
					else
						echo("<td><a title='Ver disponibilidad' href='disponibilidad.php?idmiembro=$id'><button type='button' class='btn  btn-success'><span>Ver disponibilidad</span></button></a></td>");
				?>
	    		<h3>Categoria</h3>
	    		<p></p>	
	    	    <?if (isset($_GET["ext"])==FALSE){?>
		    		<input type="radio" name="idcategoria" value="1" id="cat1"<?if ($idcategoria==1)echo ('checked')?>>
		    		Activo
		    		<input type="radio" name="idcategoria"  value="2" id="cat2"<?if ($idcategoria==2)echo ('checked')?>>
		    		Apoyo
		    		<input type="radio" name="idcategoria"  value="3" id="cat3"<?if ($idcategoria==3)echo ('checked')?>>
		    		Aspirante
		    	<?} else{?>
		    		<input type="radio" disabled='disabled' name="idcategoria" value="1" <?if ($idcategoria==1)echo ('checked')?>>
		    		Activo
		    		<input type="radio" disabled='disabled' name="idcategoria"  value="2" <?if ($idcategoria==2)echo ('checked')?>>
		    		Apoyo
		    		<input type="radio" disabled='disabled' name="idcategoria"  value="3" <?if ($idcategoria==3)echo ('checked')?>>
		    		Aspirante
		    		<?}?>
				<p></p>
			<h3>Habilidades</h3>
			<? 	$query = 'SELECT idskil,nombre from CAX.skill ;';
				$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
				$total=mysql_num_rows($result);
				for($i=1;$i<=$total;$i++){
					$row=mysql_fetch_object($result);
					$consulta= "SELECT idskill FROM CAX.miembro_skill WHERE idmiembro='".$id."' AND 
					idskill='".$i."';";
					$resultado= mysql_query($consulta) or die('Consulta fallida: ' . mysql_error());
					if (isset($_GET["ext"])==FALSE)
						if (mysql_num_rows($resultado)!=0)
							echo ("<input type='checkbox' name='hab".$i."' checked='checked' 
								value='".$i."'> ".$row->nombre." ");
						else echo ("<input type='checkbox' name='hab".$i."'value='".$i."'> ".$row->nombre." ");
					else if (mysql_num_rows($resultado)!=0)
							echo ("<input type='checkbox' disabled='disabled' name='hab".$i."' checked='checked' 
								value='".$i."'> ".$row->nombre." ");
						else echo ("<input type='checkbox' disabled='disabled' name='hab".$i."'value='".$i."'> ".$row->nombre." ");
				}
			?>  
			<p></p>
			<p></p>

			<? if (isset($_GET["ext"])==FALSE)
			echo ('<button type="submit" class="btn btn-success" onclick="return funcionAceptar()">Aceptar</button>');?>
		</form>
		</div>
	    <div class ="col-md-3">
	    </div>
	    </div>
</div>	
</body>
</html>
