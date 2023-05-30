<?php
class Modele_bd
{
	public $conn;

	public function __construct()
	{
		$login = "root";
		$mdp = "root";
		$bd = "test";
		$serveur = "localhost";

		try {
			$this->conn = new PDO(
				"mysql:host=$serveur;dbname=$bd",
				$login,
				$mdp,
				array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'')
			);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			print "Erreur de connexion PDO ";
			die();
		}
	}

	/*
 * Fonction : Page accessible que si l'utilisateur est connecté
 * Démarre la variable si cette dernière n'est pas lancé
 * Si la variable SESSION['user'] n'existe pas : retourne false
 */

	public function logged_only()
	{

		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		if (!isset($_SESSION['user'])) {
			return false;
		}
		return true;
	}

	/*
 * Fonction : Page accessible que si l'utilisateur est déconnecté
 * Démarre la variable si cette dernière n'est pas lancé
 * Si la variable SESSION['user'] existe pas : retourne false
 */

	public function unlogged_only()
	{

		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		if (isset($_SESSION['user'])) {
			return false;
		}
		return true;
	}
}

?>