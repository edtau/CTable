CTable simple PHP class to render HTML tables from array
==================================

[![Latest Stable Version](https://poser.pugx.org/leaphly/cart-bundle/version.png)](https://packagist.org/packages/edtau/ctable)
 
By Eddie Taube (eddie.taube@gmail.com)

CTable is intended to be used with Anax-MVC (https://github.com/mosbth/Anax-MVC) but can also easy be used for a custom 
PHP application. 

## Installation
To install the package you can use composer <pre>composer require edtau/ctable</pre>, download the zipfile or clone it through github. For use with ANAX-MVC it is recommended that you copy the Table folder from src to app src. In the folder you find two classes CTable.php and TableController.php. if you want to test CTable copy the file table.php from the package folder webroot then simple run table.php from your application to test the different tables. 

## Installation
If you want to use the package in your own custom application there is a couple of things you have to do for the class to work. 

1. Remove from CTable: <pre>implements \Anax\DI\IInjectionAware</pre> 
2. And remove the code from CTable:  
  <pre>use \Anax\DI\TInjectable;</pre>
    
3. Now the class should work in your custom project. 

## Usage
You have two different options when you want to generate a html-table. 

1. First option 
<pre>
  $table = new CTable();
  $data = array(
           array('Förnamn', 'Efternamn', 'Ålder'),
           array('Anders', 'Andersson', '40'),
           array('Stig', 'Larsson', '41'),
           array('Anna', 'Svensson', '45')
       );
  $html = $table->table($data);
</pre> 
$html now cointains your generated table the first array automatic becomes the headers of your table. 
You can also set the id by sending the param to your table when getting the html. 

  $html = $table->table($data,$myId);

2. Second option set the header for a custom table
 <pre>$this->table->setHeader(array('Förnamn', 'Efternamn', 'Ålder'));
       $array = array(
           array('Anders', 'Andersson', '40'),
           array('Stig', 'Larsson', '41'),
           array('Anna', 'Svensson', '45'),
           array('Bengt', 'Andersson', '40'),
           array('Karin', 'Larsson', '41'),
           array('Ulf', 'Svensson', '45')
       );
       $html = $this->table->table($array);
</pre>
The code will generate a table based on your header of course you still have the option to send param id to the table method. 


License
----------------------------------

This software is free software and carries a MIT license.



Todo
----------------------------------

* Add support for CSS classes 
* Add support for striped tables
 


History
----------------------------------

v1.0* (2015-11-10)
