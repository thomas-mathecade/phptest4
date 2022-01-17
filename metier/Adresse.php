<?php
/**
 * 
 * Classe permettant de definir une adresse
 * @author Pascal Lamy
 *
 */
class Adresse {
	
	private int $id;
	private string $numero;
	private string $rue;
	private string $codepostal;
	private string $ville;
	private ?int $idPers;
	
	public function __construct(string $numero, string $rue, string $codepostal, string $ville, int $idPers) {
            $this->numero = $numero;
            $this->rue = $rue;
            $this->codepostal = $codepostal;
            $this->ville = $ville;
            $this->idPers = $idPers;
        }

        /** 
         * GET
         * **/
        public function getId() {
            return $this->id;
        }

        public function getNumero() {
            return $this->numero;
        }

        public function getRue() {
            return $this->rue;
        }

        public function getCodePostal() {
            return $this->codepostal;
        }

        public function getVille() {
            return $this->ville;
        }

        public function getIdPers() {
            return $this->idPers;
        }

        /** 
         * SET
         * **/
        public function setId(int $id) {
            if($id!=null){
                $this->id=$id;
            }
        }

        public function setNumero(string $numero) {
            if($numero!=null && is_string($numero)){
                $this->numero=$numero;
            }
        }

        public function setRue(string $rue) {
            if($rue!=null && is_string($rue)){
                $this->rue=$rue;
            }
        }

        public function setCodePostal(string $codepostal) {
            if($codepostal!=null && is_string($codepostal)){
                $this->codepostal=$codepostal;
            }
        }

        public function setVille(string $ville) {
            if($ville!=null && is_string($ville)){
                $this->ville=$ville;
            }
        }

        public function setIdPers(int $idPers) {
            if($idPers!=null){
                $this->idPers=$idPers;
            }
        }

	/**
	 *
	 * renvoie sous forme de chaine de caracteres l'objet adresse en appelant echo ou print
	 */

	public function __toString(){
		return '[' .$this->getId().','
		.$this->getNumero().','
		.$this->getRue().','
		.$this->getCodePostal().','
        .$this->getVille().','
        .$this->getIdPers().']';
    }
}