<?php 
/**
* 
*/
class UsuarioController
{
	
	function __construct()
	{
		
	}

	//Funcion principal que muestra el index
	function index(){
		require_once('Views/Alumno/bienvenido.php');
	}

	//Funcion que llama a la pagina para registrar
	function register(){
		require_once('Views/Alumno/register.php');
	}

	//Funcion que guarda al alumno en la base de datos
	function save(){
		if (!isset($_POST['estado'])) {
			$estado="of";
		}else{
			$estado="on";
		}
		$alumno= new Alumno(null, $_POST['nombres'],$_POST['apellidos'],$estado);

		Alumno::save($alumno);
		$this->show();
	}

	//Funcion que llama a la pagina para mostrar a los alumnos 
	function show(){
		$listaAlumnos=Alumno::all();

		require_once('Views/Alumno/show.php');
	}
	
	// Funcion que llama a la pagina para actualizar datos del alumno
	function updateshow(){
		$id=$_GET['idAlumno'];
		$alumno=Alumno::searchById($id);
		require_once('Views/Alumno/updateshow.php');
	}

	//Funcion que actualiza los datos del alumno
	function update(){
		$alumno = new Alumno($_POST['id'],$_POST['nombres'],$_POST['apellidos'],$_POST['estado']);
		Alumno::update($alumno);
		$this->show();
	}

	//Funcion que borra al alumno de la base de datos
	function delete(){
		$id=$_GET['id'];
		Alumno::delete($id);
		$this->show();
	}

	//Funcion que busca al alumno y luego lo muestra por pantalla
	function search(){
		if (!empty($_POST['id'])) {
			$id=$_POST['id'];
			$alumno=Alumno::searchById($id);
			$listaAlumnos[]=$alumno;
			//var_dump($id);
			//die();
			require_once('Views/Alumno/show.php');
		} else {
			$listaAlumnos=Alumno::all();

			require_once('Views/Alumno/show.php');
		}
		
		
	}

	//Funcion que llama a la pagina de error
	function error(){
		require_once('Views/Alumno/error.php');
	}

}

?>