<?php

if (isset($_POST['username']) and !empty($_POST['username']) and 
    isset($_POST['password']) and !empty($_POST['password'])) {

    require_once('./classes/Database.php');
    require_once('./classes/Sanitizing.php');

    $sanitizing = new Sanitizing();
    $username = (string) $sanitizing->sanitizeString($_POST['username']); 
    $password = (string) $_POST['password']; 
   
    $data = (array) Database::query("SELECT * FROM employes WHERE admin = (:username) ",[':username' => $_POST['username']]);

    if(isset($data) and !empty($data)){
        $test= true; 
    }else{
        $data =  Database::query('SELECT * FROM administrateur WHERE admin = (:username)',[':username' => $_POST['username']]);   
        $test = false;
        }
    if(empty($data)){
        http_response_code(302);
        header('Location: ./#utilisateurInvalide');
        exit();
    }else{
        $passwordBDD = $data[0]['password'];
        $password = $_POST['password'];
        if(password_verify($password,$passwordBDD)){
            session_start();
            if($test){
                $idFromDatabase = (string) $data[0]['id']; 
                $_SESSION['user'] = (array) array($idFromDatabase, session_id());

                http_response_code(302);
                header('Location: ./entreHeureBoard.php');
                exit();
            }else{
                $_SESSION['admin'] = (string) session_id();
            
                http_response_code(302);
                header('Location: ./admin/board.php');
                exit();
            }
        }
        else{
            http_response_code(302);
            header('Location: ./#passwordInvalid');
            exit();
        }
    }

}else{
    http_response_code(302);
    header('Location: ./#champsVide');
    exit();
}

        

    



?>