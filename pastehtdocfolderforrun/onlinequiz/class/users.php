<?php
session_start();
class users{
    public $conn;
    public $data;
    public $cat;
    public $qus;
    public function __construct(){
        $this->conn=new mysqli('localhost', 'root', '', 'quizsystem');
//    if($link){
//        echo 'connection sucess';
//    }
// else {
//      echo 'connection fail';  
//    }
    }
    public function answer($data){
        print_r($data)   ;
    }
    public function qus_show($qus){
//echo $qus;
      $query=$this->conn->query("select * from questions where cat_id='$qus'");   
        while($row=$query->fetch_array(MYSQLI_ASSOC))
        {
            $this->qus[]=$row;
        }    
        return $this->qus;
    }  
        
    

    public function cat_show(){
     $query=$this->conn->query("select * from category");   
        while($row=$query->fetch_array(MYSQLI_ASSOC))
        {
            $this->cat[]=$row;
        }    
        return $this->cat;
    }

    public function users_profile($email){
        //echo $email;   
        $query=$this->conn->query("select * from signup where email='$email'");   
        $row=$query->fetch_array(MYSQLI_ASSOC);
        if($query->num_rows>0){
            $this->data[]=$row;
        } return $this->data;
    }

    public function signup($data){
        $this->conn->query($data); 
        return true;
    }
    public function url($addr){
        header("location:".$addr);
    }
    public function signin($email, $password){
 // echo $email;
        $query=$this->conn->query("select email,password from signup where email= '$email' and password= '$password' "); 
        //$query->fetch_array(MYSQLI_ASSOC);
        if($query->num_rows>0){
            $_SESSION['email']=$email;
            return true;
        }
 else {            return false;}
    }
}

?>