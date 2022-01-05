<?php
/**
 *classe personne designant les carateristiques d'une personne
 * @author lamy pascal
 *
 */

class Personne{

	/**id de la personne*/
	private  int $id;
	/**nom de la personne*/
	private ?string $nom;
	/**prenom de la personne*/
	private  ?string $prenom;
	/**Date de naissance*/
    private DateTime $datenaiss;
    /**Téléphone de la personne */
	private string $telephone;
	/**email de la personne**/
	private string $email;
     /** Login **/
    private string $login;
    /** Email **/
    private string $pwd;
	/** Adresse **/
	private string $adresse;


	public function __construct(string $n,string $p,DateTime $d,string $t,string $e,string $l,string $pw,string $adr){

		$this->nom=$n;
		$this->prenom=$p;
        $this->datenaiss=$d;
        $this->telephone=$t;
		$this->email=$e;
        $this->login=$l;
        $this->pwd=$pw;
		$this->adresse=$adr;

		
	}

	/**
	 * Methodes getter pour r�cup�rer les valeurs des  aux attributs de l'objet
         * @assertClass
	 */
	public function getId(){
		return $this->id;
	}
	public function getNom(){
		return $this->nom;
	}
	public function getPrenom(){
		return $this->prenom;
	}
    public function getDatenaissance(){
		return $this->datenaiss;
	}
    public function getTelephone(){
		return $this->telephone;
	}
	public function getEmail(){
		return $this->email;
	}
        public function getLogin(){
		return $this->login;
	}
        public function getPwd(){
		return $this->pwd;
	}
	public function getAdresse(){
		return $this->adresse;
	}

	
	/**
	 * Methodes setter pour avoir affecter des valeurs  aux attributs de l'objet
	 */

	public function setId(int $id){
		if($id!=null){
			$this->id=$id;
		}
	}
	public function setNom(string $n){
		if($n!=null && is_string($n)){
			$this->nom=$n;
		}
	}
	public function setPrenom(string$pre){
		if($pre!=null && is_string($pre)){
			$this->prenom=$pre;
		}
    }
    public function setDateNaissance(DateTime $dateNais){
            if($dateNais!=null){
            $this->datenaiss=$dateNais;
            }
        }
        public function setTelephone(string $tel){
            if($tel!=null && is_string($tel)){
                $this->telephone=$tel;
            }
        }
        public function setEmail(string $mail){
            if($mail!=null && is_string($mail)){
                $this->email=$mail;
            }
        }
        public function setLogin(string $logi){
            if($logi!=null && is_string($logi)){
                $this->login=$logi;
            }
        }
            
        public function setPwd(string $pw){
            if($pw!=null && is_string($pw)){
                $this->pwd = md5($pw);
            }
        }
		public function setAdresse(string $adr){
			if($adr!=null && is_string($adr)){
				$this->adresse=$adr;
			}
		}
	
	/**
	 *
	 * renvoie sous forme de chaine de caracteres l'objet personne en appelant echo ou print
	 */

	public function __toString(){
		return '[' .$this->getNom().','
		.$this->getPrenom().','
		.$this->getDatenaissance()->format('Y-m-d').','
		.$this->getTelephone().','
		.$this->getEmail().','
        .$this->getLogin().','
		.$this->getPwd().','
		.$this->getAdresse().']';
}
}