<?php
require_once "Constantes.php";
require_once "metier/Adresse.php";

/**
 * 
*Classe permettant d'acceder en bdd pour inserer supprimer modifier
 * selectionner l'objet Adresse
 * @author pascal Lamy
 *
 */
class AdresseDB 
{
	private $db; // Instance de PDO
	
	public function __construct($db)
	{
		$this->db=$db;;
	}
	/**
	 * 
	 * fonction d'Insertion de l'objet Adresse en base de donnee
	 * @param Adresse $p
	 */
	public function ajout(Adresse $a):void{
		$q = $this->db->prepare('INSERT INTO adresse(numero,rue,codepostal,ville,id_pers) values(:numero,:rue,:codepostal,:ville,:id_pers)');
	
		$q->bindValue(':numero',$a->getNumero());
		$q->bindValue(':rue',$a->getRue());
		$q->bindValue(':codepostal',$a->getCodePostal());
		$q->bindValue(':ville',$a->getVille());
		$q->bindValue(':id_pers',$a->getVille());
			$q->execute();	
			$q->closeCursor();
			$q = NULL;
	}
    /**
     * 
     * fonction de Suppression de l'objet Adresse
     * @param Adresse $a
     */
	public function suppression(Adresse $a):void{
		$q = $this->db->prepare('DELETE FROM adresse WHERE numero=:n,rue=:r,codepostal=:c,ville=:v,id_pers=:p');
	
		$q->bindValue(':n',$a->getNumero(),PDO::PARAM_STR);
		$q->bindValue(':r',$a->getRue(),PDO::PARAM_STR);
		$q->bindValue(':c',$a->getCodePostal(),PDO::PARAM_STR);
		$q->bindValue(':v',$a->getVille(),PDO::PARAM_STR);
		$q->bindValue(':v',$a->getIdPers(),PDO::PARAM_STR);
			$q->execute();	
			$q->closeCursor();
			$q = NULL;
	}
/** 
	 * Fonction de modification d'une adresse
	 * @param Adresse $a
	 * @throws Exception
	 */
	public function update(Adresse $a){
		try {
			$q = $this->db->prepare('UPDATE adresse SET numero=:n,rue=:r,codepostal=:c,ville=:v,id_pers=:p WHERE id=:i');
	
			$q->bindValue(':i',$a->getId());
			$q->bindValue(':n',$a->getNumero());
			$q->bindValue(':r',$a->getRue());
			$q->bindValue(':c',$a->getCodePostal());
			$q->bindValue(':v',$a->getVille());
			$q->bindValue(':p',$a->getIdPers());
				$q->execute();	
				$q->closeCursor();
				$q = NULL;
		}
		catch(Exception $e){
			throw new Exception(Constant::EXCEPTION_DB_ADR_UP); 
			
		}
	}
	/**
	 * 
	 * Fonction qui retourne toutes les adresses
	 * @throws Exception
	 */
	public function selectAll(){
		$query = "SELECT numero, rue, codepostal, ville, id_pers FROM adresse";
		$q = $this->db->prepare($query);
		$q->execute();
		
		$result = $q->fetchAll(PDO::FETCH_ASSOC);

		if(empty($result)){
			throw new Exception(Constant::EXCEPTION_DB_ADR_UP);
		}

		$q->closeCursor();
		$q = NULL;
		return $result;
	}	
		/**
	 * 
	 * Fonction qui retourne l'adresse en fonction de son id
	 * @throws Exception
	 * @param $id
	 */
	public function selectionId($id) {
		$query = "SELECT numero, rue, codepostal, ville, id_pers FROM adresse WHERE id=:id";
		$q = $this->db->prepare($query);
		$q->bindValue(':id', $id);
		$q->execute();

		$arrAll = $q->fetchAll(PDO::FETCH_ASSOC);

		if(empty($arrAll)){
			throw new Exception(Constantes::EXCEPTION_DB_ADRESSE);
		}
		
		$q->closeCursor();
		$q = NULL;
		$res= $this->convertPdoAdre($arrAll);
		return $res;
	}	
	/**
	 * 
	 * Fonction qui convertie un PDO Adresse en objet Adresse
	 * @param $pdoAdres
	 * @throws Exception
	 */
	public function convertPdoAdre($pdoAdres){
		if(empty($pdoAdres)){
			throw new Exception(Constantes::EXCEPTION_DB_ADR_UP);
		}
		$obj=(object)$pdoAdres;
		$adre=new Adresse($obj->numero, $obj->rue, $obj->codepostal, $obj->ville, $obj->idPers);
		$adre->setId(interval($obj->id));
		return $adre;
	}
}