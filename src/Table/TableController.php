<?php
namespace Edtau\Table;


/**
 * Class CTable
 * @package edtau\Table
 * Class used for generating a table from array
 */
class TableController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;
          
    public function initialize(){
        $this->table = new \Edtau\Table\CTable();
        $this->table->setDI($this->di);
    }

    public function getTableAction($data, $header = null, $id = null){
        if($header != null){
            $this->table->setHeader($header);
        }
        $table = $this->table->table($data,$id);
        $this->views->add('default/page', [
            'title' => "Table",
            'content' => $table,

        ]);

    }
   public function testAction(){
       $data = array(
           array('Förnamn', 'Efternamn', 'Ålder'),
           array('Anders', 'Andersson', '40'),
           array('Stig', 'Larsson', '41'),
           array('Anna', 'Svensson', '45')
       );
       $tableSetheaderNo = $this->table->table($data);

       $this->table->setHeader(array('Förnamn', 'Efternamn', 'Ålder'));
       $data = array(
           array('Anders', 'Andersson', '40'),
           array('Stig', 'Larsson', '41'),
           array('Anna', 'Svensson', '45'),
           array('Bengt', 'Andersson', '40'),
           array('Karin', 'Larsson', '41'),
           array('Ulf', 'Svensson', '45')
       );
       $tableSetheader = $this->table->table($data);

       $tableId = $this->table->table($data,"red");
       $this->views->add('table/default', [
           'title' => "Table test",
           'tableNoHeader' => $tableSetheaderNo,
           'tableHeader' => $tableSetheader,
           'tableHeaderId' => $tableId

       ]);
    }
}