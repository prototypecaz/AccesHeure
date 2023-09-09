<?php

class Sanitizing {

    public function sanitizeString(string $string) : string {
        return (string) htmlspecialchars(
            filter_var(
                $string, 
                FILTER_SANITIZE_STRING, 
                FILTER_FLAG_STRIP_HIGH
            )
        );
    }

    public function sanitizeInteger(int $integer) : int {
        return (int) filter_var(
            $integer, 
            FILTER_SANITIZE_NUMBER_INT
        );
    }

    public function sanitizeFloat(float $float) : float {
        return (float) filter_var(
            $float,
            FILTER_SANITIZE_NUMBER_FLOAT,
	        FILTER_FLAG_ALLOW_FRACTION
        );
    }

    public function validateEmail(string $email) : bool {
        return (bool) filter_var(
            $email,
            FILTER_VALIDATE_EMAIL
        );
    }

}

?>