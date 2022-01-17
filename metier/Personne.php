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

	public function __construct(string $nom,string $prenom,DateTime $datenaiss,string $telephone,string $email,string $login,string $pwd){

		$this->nom=$nom;
		$this->prenom=$prenom;
        $this->datenaiss=$datenaiss;
        $this->telephone=$telephone;
		$this->email=$email;
        $this->login=$login;
        $this->pwd=$pwd;
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
	public function setNom(string $nom){
		if($nom!=null && is_string($nom)){
			$this->nom=$nom;
		}
	}
	public function setPrenom(string $prenom){
		if($prenom!=null && is_string($prenom)){
			$this->prenom=$prenom;
		}
    }
    public function setDateNaissance(DateTime $datenaiss){
            if($datenaiss!=null){
            $this->datenaiss=$datenaiss;
            }
        }
        public function setTelephone(string $telephone){
            if($telephone!=null && is_string($telephone)){
                $this->telephone=$telephone;
            }
        }
        public function setEmail(string $email){
            if($email!=null && is_string($email)){
                $this->email=$email;
            }
        }
        public function setLogin(string $login){
            if($login!=null && is_string($login)){
                $this->login=$login;
            }
        }
            
        public function setPwd(string $pwd){
            if($pwd!=null && is_string($pwd)){
                $this->pwd = md5($pwd);
            }
        }

		public function setAdresse(string $adresse){
            if($adresse!=null && is_string($adresse)){
                $this->adresse=$adresse;
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
		.$this->getPwd().']';
}
}