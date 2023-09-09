<?php

/**
 * @brief Connection and execute SQL query on MySQL database
 * @author David.T <d.trouiller@aformac.fr>
 * @copyright Copyright (c) 2020 Database Project, see the LICENSE file for copying permissions
 */

/**
 * Database Class
 * @version 1.0.0
 */
abstract class Database {

    // Constant

    private const CONFIGURATION_FILE = __DIR__ . '/../configuration.php';

    // Attributes

    /**
     * Required argument for PDO instance
     * @var $host (string) : Contain hostname of database
     */
    private static string $host;

    /**
     * Required argument for PDO instance
     * @var $dbname (string) : Contain name of database
     */
    private static string $dbname;

    /**
     * Required argument for PDO instance
     * @var $username (string) : Contain username credential
     */
    private static string $username;

    /**
     * Required argument for PDO instance
     * @var $password (string) : Contain password credential
     */
    private static string $password;
    
    /**
     * PDO Object instanciation for call methods
     * @var $database (object) : Contain PDO object
     */
    private static $database;

    /**
     * PDO Object after instanciation for call methods
     * @var $prepare (object) : Contain PDO object
     */
    private static object $prepare;

    // Methods

    /**
     * query(argument, argument) is a private method for define SQL query and call others methods.
     * @param $query (string)
     * @param $mapper (array)
     * @return void
     */
    public static function query(string $query, array $mapper) : array {
        (is_null(self::$database)) ? self::connection() : null;
        self::checkQuery($query);
        self::prepare($query);
        self::execute($mapper);
        return (array) self::fetchAll();
    }

    /**
     * connection() is a private method for establish a connection once time to MySQL server.
     * @return void
     */
    private static function connection() : void {
        self::checkConfiguration();
        try {
            $database = (object) new PDO( 
                sprintf(
                    'mysql:host=%s;dbname=%s', 
                    self::getHost(), 
                    self::getDbname()
                ), 
                self::getUsername(), 
                self::getPassword() 
            );
        } catch(PDOException $exception) {
            die($exception->getMessage());
        } finally {
            self::$database = (object) $database;
        }
    }

    /**
     * checkConfiguration() is a private method for check integrity of configuration file.
     * @return void
     */
    private static function checkConfiguration() : void {
        (file_exists(self::CONFIGURATION_FILE)) ? require_once(self::CONFIGURATION_FILE) : die('configuration file does not exist');
        (isset($database)) ? null : die("configuration file have not 'database' variable");
        (isset($database['host']) and !empty($database['host'])) ? self::setHost($database['host']) : die("configuration file have not 'host' key or void value");
        (isset($database['dbname']) and !empty($database['dbname'])) ? self::setDbname($database['dbname']) : die("configuration file have not 'dbname' key or void value");
        (isset($database['username']) and !empty($database['username'])) ? self::setUsername($database['username']) : die("configuration file have not 'username' key or void value");
        (isset($database['password']) and !empty($database['password'])) ? self::setPassword($database['password']) : die("configuration file have not 'password' key or void value");
    }

    /**
     * checkQuery(argument) is a private method for check SQL query.
     * @param $query (string)
     * @return void
     */
    private static function checkQuery(string $query) : void {
        (!empty($query)) ? null : die('query is empty');
    }

    /**
     * prepare(argument) is a private method for set SQL query in 'PDO prepare' method.
     * @param $query (string)
     * @return void
     */
    private static function prepare(string $query) : void {
        self::$prepare = (object) self::$database->prepare($query);
    }

    /**
     * execute(argument) is a private method for set data mapper in 'PDO execute' method.
     * @param $mapper (array)
     * @return void
     */
    private static function execute(array $mapper) : void {
        (self::$prepare->execute($mapper)) ? null : die('execution of query have failed');
    }

    /**
     * fetchAll() is a private method for return 'PDO fetchAll' values.
     * @return array
     */
    private static function fetchAll() : array {
        return (array) (self::$prepare->rowCount() > 0) ? self::$prepare->fetchAll(PDO::FETCH_ASSOC) : die();
    }

    // Accessors SETTER

    /**
     * setHost(argument) is a private setter accessor for define values of $host attribut.
     * @param $host (string)
     * @return void
     */
    private static function setHost(string $host) : void {
        self::$host = (string) $host;
    }

    /**
     * setDbname(argument) is a private setter accessor for define values of $dbname attribut.
     * @param $dbname (string)
     * @return void
     */
    private static function setDbname(string $dbname) : void {
        self::$dbname = (string) $dbname;
    }

    /**
     * setUsername(argument) is a private setter accessor for define values of $username attribut.
     * @param $username (string)
     * @return void
     */
    private static function setUsername(string $username) : void {
        self::$username = (string) $username;
    }

    /**
     * setPassword(argument) is a private setter accessor for define values of $password attribut.
     * @param $password (string)
     * @return void
     */
    private static function setPassword(string $password) : void {
        self::$password = (string) $password; 
    }

    // Accessors GETTER

    /**
     * getHost() is a private getter accessor for return values of $host attribut.
     * @return $host (string)
     */
    private static function getHost() : string {
        return (string) self::$host;
    }

    /**
     * getDbname() is a private getter accessor for return values of $dbname attribut.
     * @return $dbname (string)
     */
    private static function getDbname() : string {
        return (string) self::$dbname;
    }

    /**
     * getUsername() is a private getter accessor for return values of $username attribut.
     * @return $username (string)
     */
    private static function getUsername() : string {
        return (string) self::$username;
    }

    /**
     * getPassword() is a private getter accessor for return values of $password attribut.
     * @return $password (string)
     */
    private static function getPassword() : string {
        return (string) self::$password; 
    }

}

?>