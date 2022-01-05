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
    protected function tearDown() : void{
        
    }

    /**
    * @covers AdresseDB::ajout
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/     
    public function testAjout() {
        try{ 
            $this->adresse = new AdresseDB($this->pdodb);
            
            $a = new Adresse(32, "rue sainte croix", 4400, "Nantes", 1);

            $this->adresse->ajout($a);
            $lastId = $this->pdodb->lastInsertId();

            $a->setId(interval($lastId));
            $adre=$this->adresse->selectionId($a->getId());

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

            $adre=$this->adresse->selectionId(1);
            $this->adresse->suppression($adre);

            $adre2=$this->adresse->selectionId(2);
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
     * @covers AdresseDB::selectionId
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/ 
    public function testSelectionId() {
            $this->adresse = new AdresseDB($this->pdodb);
            $a=$this->adresse->selectionId();
            
            $lastId = $this->pdodb->lastInsertId();

            $a->setId($lastId);
            $adre=$this->adresse->selectionId($a->getId());

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
    $tab["id"]="50";
    $tab["numero"]="27";
    $tab["rue"]="rue des lilas";
    $tab["codeposatal"]="21300";
    $tab["ville"]="Brur";
    $tab["id_pers"]="1";
    $this->adresse = new AdresseDB($this->pdodb);
    $adre= $this->adresse->convertPdoAdre($tab);
    $this->assertEquals($tab["numero"],$adre->getNumero());
    $this->assertEquals($tab["rue"],$adre->getRue());
    $this->assertEquals($tab["codeposatal"],$adre->getCodePostal());
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
        $a = new Adresse(32, "rue sainte croix", 4400, "Nantes", 1);
        $a->setId(99);
        $this->adresse->ajout($a);

        $a=new Adresse(21, "rue des pepes", 2154, "Che", 1);
        $lastId = $this->pdodb->lastInsertId();
        $a->setId($lastId);
        $this->adresse->update($a);  
        $pers=$this->adresse->selectionId($a->getId());
        $this->assertEquals($a->getId(),$adre->getId());
        $this->assertEquals($a->getNumero(),$adre->getNumero());
        $this->assertEquals($a->getRue(),$adre->getRue());
        $this->assertEquals($a->getCodePostal(),$adre->getCodePostal());
        $this->assertEquals($a->getVille(),$adre->getVille());
        $this->assertEquals($a->getIdPers(),$adre->getIdPers());
    }
}
?>