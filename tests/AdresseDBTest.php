<?php

use PHPUnit\Framework\TestCase;

require_once "Constantes.php";
include_once "PDO/connectionPDO.php";
require_once "metier/Adresse.php";
require_once "PDO/AdresseDB.php";

class AdresseDBTest extends TestCase {
    /**
     * @var AdresseDB
     */
    protected $adresse;
    protected $pdodb;

    protected function setUp():void {
        $strConnection = Constantes::TYPE.':host='.Constantes::HOST.';dbname='.Constantes::BASE; 
        $arrExtraParam= array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
        $this->pdodb = new PDO($strConnection, Constantes::USER, Constantes::PASSWORD, $arrExtraParam);
        $this->pdodb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     *@coversNothing
    * Tears down the fixture, for example, closes a network connection.
    * This method is called after a test is executed.
    */
    protected function tearDown() : void {
        
    }

    /**
    * @covers AdresseDB::ajout
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */     
    public function testAjout() {
        try{ 
            $this->adresse = new AdresseDB($this->pdodb);
            
            $a = new Adresse("1", "lotissement de Quénéha", "22600", "Trévé", 10);

            $this->adresse->ajout($a);
            $adre=$this->adresse->selectionVille($a->getVille());
            echo "pers bdd: $adre";
            $this->assertEquals($a->getNumero(),$adre->getNumero());
            $this->assertEquals($a->getRue(),$adre->getRue());
            $this->assertEquals($a->getCodePostal(),$adre->getCodePostal());
            $this->assertEquals($a->getVille(),$adre->getVille());
            $this->assertEquals($a->getIdPers(),$adre->getIdPers());
        } catch  (Exception $e) {
            echo 'Exception recue : ',  $e->getMessage(), "\n";
        }
    }

    /**
     * @covers AdresseDB::suppression
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */ 
    public function testSuppression() {
        try{
            $this->adresse = new AdresseDB($this->pdodb);

            $adre=$this->adresse->selectionVille("Trévé");
            $this->adresse->suppression($adre);

            $adre2=$this->adresse->selectionVille("Trévé");
            if($adre2!=null){
                $this->markTestIncomplete(
                    "La suppression de l'enreg adresse a echoué"
                );
            }
        } catch (Exception $e){
            $exception="RECORD ADRESSE not present in DATABASE";
            $this->assertEquals($exception,$e->getMessage());
        }
    }

        /**
     * @covers AdresseDB::selectionVille
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */ 
    public function testselectionVille() {
        $this->adresse = new AdresseDB($this->pdodb);
        $a=new Adresse("26", "boulevard victor Hugo", "44000", "Nantes", 4);
        $this->adresse->ajout($a);

        $adre=$this->adresse->selectionVille($a->getVille());
        $this->assertEquals($a->getNumero(),$adre->getNumero());
        $this->assertEquals($a->getRue(),$adre->getRue());
        $this->assertEquals($a->getCodePostal(),$adre->getCodePostal());
        $this->assertEquals($a->getVille(),$adre->getVille());
        $this->assertEquals($a->getIdPers(),$adre->getIdPers());
    }

        /**
         * @covers AdresseDB::selectionId
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */ 
    public function testSelectionId() {
        $this->adresse = new AdresseDB($this->pdodb);
        $a=$this->adresse->selectionVille("Nantes");
        $adre=$this->adresse->selectionId($a->getId());

        $this->assertEquals($a->getId(),$adre->getId());
        $this->assertEquals($a->getNumero(),$adre->getNumero());
        $this->assertEquals($a->getRue(),$adre->getRue());
        $this->assertEquals($a->getCodePostal(),$adre->getCodePostal());
        $this->assertEquals($a->getVille(),$adre->getVille());
        $this->assertEquals($a->getIdPers(),$adre->getIdPers());
    }

            /**
         * @covers AdresseDB::selectAll
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    public function testSelectAll() {
        $ok=true;
        $this->adresse = new AdresseDB($this->pdodb);
        $res=$this->adresse->selectAll();
        $i=0;
        foreach ($res as $key=>$value) {
            $i++; 
        }
        print_r($res);
        if($i==0){
            $this->markTestIncomplete( 'Pas de résultat' );
            $ok=false;
        }
        $this->assertTrue($ok);
    }

    /**
     * @covers AdresseDB::convertPdoAdre
     * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    public function testConvertPdoAdre() {
        $tab["id"]="129";
        $tab["numero"]="1";
        $tab["rue"]="rue des lilas";
        $tab["codepostal"]="21300";
        $tab["ville"]="Brur";
        $tab["id_pers"]="99";
        $this->adresse = new AdresseDB($this->pdodb);
        $adre= $this->adresse->convertPdoAdre($tab);
        $this->assertEquals($tab["numero"],$adre->getNumero());
        $this->assertEquals($tab["rue"],$adre->getRue());
        $this->assertEquals($tab["codepostal"],$adre->getCodePostal());
        $this->assertEquals($tab["ville"],$adre->getVille());
        $this->assertEquals($tab["id_pers"],$adre->getIdPers());
    }

    /**
     * @covers AdresseDB::update
     * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    public function testUpdate() {
        $this->adresse = new AdresseDB($this->pdodb);
        $a = new Adresse("1", "lotissement de Quénéha", "22600", "Trévé", 10);
        $a->setId(199);
        $this->adresse->ajout($a);

        $a = new Adresse("1", "rue des Pépés", "21150", "Che", 12);
        $lastId = $this->pdodb->lastInsertId();
        $a->setId($lastId);
        $this->adresse->update($a);  

        $adre=$this->adresse->selectionId($a->getId());
        $this->assertEquals($a->getId(),$adre->getId());
        $this->assertEquals($a->getNumero(),$adre->getNumero());
        $this->assertEquals($a->getRue(),$adre->getRue());
        $this->assertEquals($a->getCodePostal(),$adre->getCodePostal());
        $this->assertEquals($a->getVille(),$adre->getVille());
        $this->assertEquals($a->getIdPers(),$adre->getIdPers());
    }
}
?>