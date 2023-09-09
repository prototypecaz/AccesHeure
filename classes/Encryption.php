<?php

class Encryption {

    public function passwordHash(string $password) : string {
        return (string) password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
    }

    public function passwordVerify(string $password, string $hash) : bool {
        return (bool) password_verify($password, $hash);
    }

}

?>