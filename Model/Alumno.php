<?php 
/**
* 
*/
class Alumno
{
	//Atributos del alumno
	private $id;
	private $nombres;
	private $apellidos;
	private $estado;

	// Constructor del alumno
	function __construct($id, $nombres,$apellidos, $estado)
	{
		$this->setId($id);
		$this->setNombres($nombres);
		$this->setApellidos($apellidos);
		$this->setEstado($estado);		
	}

	//Retorna el id
	public function getId(){
		return $this->id;
	}

	//Guarda el id
	public function setId($id){
		$this->id = $id;
	}
	//Retorna el nombre
	public function getNombres(){
		return $this->nombres;
	}
	//Guarda el nombre
	public function setNombres($nombres){
		$this->nombres = $nombres;
	}

	//Retorna el apellido
	public function getApellidos(){
		return $this->apellidos;
	}

	//Guarda el apellido
	public function setApellidos($apellidos){
		$this->apellidos = $apellidos;
	}

	//Retorna el estado
	public function getEstado(){

		return $this->estado;
	}

	//Guarda el estado
	public function setEstado($estado){
		
		if (strcmp($estado, 'on')==0) {
			$this->estado=1;
		} elseif(strcmp($estado, '1')==0) {
			$this->estado='checked';
		}elseif (strcmp($estado, '0')==0) {
			$this->estado='of';
		}else {
			$this->estado=0;
		}

	}

	//Funcion que ingresa el objeto alumno con sus datos a la base de datos
	public static function save($alumno){
		$db=Db::getConnect();
		//var_dump($alumno);
		//die();
		

		$insert=$db->prepare('INSERT INTO alumno VALUES (NULL, :nombres,:apellidos,:estado)');
		$insert->bindValue('nombres',$alumno->getNombres());
		$insert->bindValue('apellidos',$alumno->getApellidos());
		$insert->bindValue('estado',$alumno->getEstado());
		$insert->execute();
	}

	//Funcion que lista a los alumnos desde la base de datos
	public static function all(){
		$db=Db::getConnect();
		$listaAlumnos=[];

		$select=$db->query('SELECT * FROM alumno order by id');

		foreach($select->fetchAll() as $alumno){
			$listaAlumnos[]=new Alumno($alumno['id'],$alumno['nombres'],$alumno['apellidos'],$alumno['estado']);
		}
		return $listaAlumnos;
	}

	//Funcion que busca por id desde la base de datos y retorna al alumno
	public static function searchById($id){
		$db=Db::getConnect();
		$select=$db->prepare('SELECT * FROM alumno WHERE id=:id');
		$select->bindValue('id',$id);
		$select->execute();

		$alumnoDb=$select->fetch();


		$alumno = new Alumno ($alumnoDb['id'],$alumnoDb['nombres'], $alumnoDb['apellidos'], $alumnoDb['estado']);
		//var_dump($alumno);
		//die();
		return $alumno;

	}

	//Funcion que actualiza datos del alumno y lo ingresa a la base de datos
	public static function update($alumno){
		$db=Db::getConnect();
		$update=$db->prepare('UPDATE alumno SET nombres=:nombres, apellidos=:apellidos, estado=:estado WHERE id=:id');
		$update->bindValue('nombres', $alumno->getNombres());
		$update->bindValue('apellidos',$alumno->getApellidos());
		$update->bindValue('estado',$alumno->getEstado());
		$update->bindValue('id',$alumno->getId());
		$update->execute();
	}

	//Funcion que elimina al alumno de la base de datos
	public static function delete($id){
		$db=Db::getConnect();
		$delete=$db->prepare('DELETE  FROM alumno WHERE id=:id');
		$delete->bindValue('id',$id);
		$delete->execute();		
	}
}

?>