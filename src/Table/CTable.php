<?php
namespace Edtau\Table;
/**
 * Class CTable
 * @package edtau\Table
 * Class used for generating a table from array
 */
class CTable implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;

    private $tableHeader = false;
    public function setHeader($array){
        $this->tableHeader = $this->addHead($array);
    }
    /**
     * @param $array the values used to get a table row
     * @return string the table row
     */
    private function addRow($array)
    {
        $td = "<tr>";
        foreach ($array as $value) {
            $td .= "<td>$value</td>";
        }
        $td .= "</tr>";
        return $td;
    }

    /**
     * Function to generate the tablehead
     * @param $theadData the data for the tablehead
     * @return string the tablehead
     */
    private function addHead($theadData)
    {
        $thead = " <thead>\n<tr>\n";
        foreach ($theadData as $head) {
            $thead .= "<th>$head</th>";
        }
        $thead .= "</thead></tr>\n";
        return $thead;
    }

    /**
     * Function to get the generated table
     * the first row in the array becomes the head of
     * the table if the tableheader is not set
     * @param $array the table data
     * @param null $id optional to use id for table
     * @return string the complete table
     */
    public function table($array, $id = null)
    {
        $table = $id != null ?"<table id='$id'>\n":"<table>\n";
        if($this->tableHeader != false){
            $thead = $this->tableHeader;
        } else {
            $theadData = array_shift($array);
            $thead = $this->addHead($theadData);
        }
        $table .= $thead;
        $row = "";
        if (is_array($array)) {
            foreach ($array as $value) {
                $row .= $this->addRow($value);
            }
        }
        $table .= $row;
        $table .= "</table>\n";
        return $table;
    }
}