<?php
require_once 'config.php';

class BD
{
    protected static $instance; // Contiendra l'instance de la classe PDO.

    private $pdo;

    protected function __construct()
    {
        try {
            $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
            $this->pdo = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            echo "ERREUR : " . $e->getMessage();
        }
    }

    // Constructeur en privé.
    protected function __clone()
    {
    } // Méthode de clonage en privé aussi.

    public static function getInstance()
    {
        if (!isset(self::$instance)) // Si on n'a pas encore instancié notre classe.
        {
            self::$instance = new self; // On s'instancie nous-mêmes. :)
        }

        return self::$instance;
    }

    public function getPdo()
    {
        if (!isset(self::$instance)) {
            getInstance();
        }
        return $this->pdo;
    }
}

?>