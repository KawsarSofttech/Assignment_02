<?php

class Connection{

	public $conn;

	public function __construct(){
		$this->conn = new PDO("mysql:host=localhost;dbname=phonebook","root","");
	}

	// get all notes
	public function getAllnotes($user_id)
	{
		$statement = $this->conn->prepare("SELECT * FROM tasks WHERE user_id= '$user_id'");
		$statement->execute();
		$data = $statement->fetchAll();
		return $data;	
	}

	// get a note
	public function getNote($id)
	{
		$statement = $this->conn->prepare("SELECT * FROM tasks WHERE id=$id;");
		$statement->execute();
		$data = $statement->fetchAll();
		return $data;
	}

	// update a note
	public function update($name,$mobnumber,$address,$id)
	{
		$name = addslashes($name);
		$statement = $this->conn->prepare("UPDATE tasks SET name='$name',mobnumber='$mobnumber',address='$address' WHERE id=$id;");
		$statement->execute();
	}

	//delete a note
	public function delete($id)
	{
		$statement = $this->conn->prepare("DELETE FROM tasks WHERE id=$id;");
		$statement->execute();
	}

	// insert a task
	public function addNote($name,$mobnumber,$address,$user_id,$img)
	{
		$statement = $this->conn->prepare("INSERT INTO tasks (name,mobnumber,address,image,status,user_id) VALUES (:name,:mobnumber,:address,:image,:status,:user_id);");
				$statement->execute(
					array(
						':name' => $name,
						':mobnumber' => $mobnumber,
						':address' => $address,
						':image'=> $img,
						':status' => 1,
						':user_id'	=> $user_id	
					)
				);

	}

	public function insert($query,$array)
	{
		$statement = $this->conn->prepare($query);
		$statement->execute($array);
	}

	public function fetch($query,$array)
	{
		$statement = $this->conn->prepare($query);
		$statement->execute($array);
		$data = $statement->fetchAll();
		return $data;
	}

}

?>
