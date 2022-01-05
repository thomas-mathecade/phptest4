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
	private ?string $rue;
	private ?int $codePostal;
	private ?string $ville;
	
	public function __construct(int $numero, string $rue, int $codePostal, string $ville) {
            $this->numero = $numero;
            $this->rue = $rue;
            $this->codePostal = $codePostal;
            $this->ville = $ville;
        }

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
            return $this->codePostal;
        }

        public function getVille() {
            return $this->ville;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function setNumero($numero) {
            $this->numero = $numero;
        }

        public function setRue($rue) {
            $this->rue = $rue;
        }

        public function setCodePostal($codePostal) {
            $this->codePostal = $codePostal;
        }

        public function setVille($ville) {
            $this->ville = $ville;
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
        .$this->getVille().']';

}
}