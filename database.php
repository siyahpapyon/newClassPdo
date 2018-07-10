<?php

class Database{

    //string parametres
    // if you want to change $this->isConn or $this->datab 

  public $isConn;
  protected $datab;

   // Mysql connect

  public function __construct($username = "root", $host="localhost", $password="", $dbname="xname", $options = []){
   $this->isConn = TRUE;
   try{

     $this->datab = new PDO("mysql:host={$host};dbname={$dbname};charset=UTF8", $username, $password, $options);
     $this->datab ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $this->datab->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

   }catch(PDOException $e){
     throw new Exception($e->getMessage());
   }

 }

   // Disconnect from dbf

 public function Disconnect(){

   $this->datab = NULL;
   $this->isConn = FALSE;
 }

   // Get row
 public function getRow($query, $params = []){

   try{

    $stmt = $this->datab->prepare($query);
    $stmt->execute($params);
    return $stmt->fetch();

  }catch(PDOException $e){

    throw new Exception($e->getMessage());
  }

}

   // Get rows
public function getRows($query, $params = []){

 try{

   $stmt = $this->datab->prepare($query);
   $stmt->execute($params);
   return $stmt->fetchAll();
 }catch(PDOException $e){

  throw new Exception($e->getMessage());
}

}

   // Insert row
public function insertRow($query, $params = []){

 try{
  $stmt = $this->datab->prepare($query);
  $stmt->execute($params);
  return TRUE;
}catch(PDOException $e){

 throw new Exception($e->getMessage());
}

}

   // Update row
public function updateRow($query, $params = []){

  $this->insertRow($query, $params);
}

//Delete row

public function deleteRow($query, $params = []){

  $this->insertRow($query, $params);
}





}
