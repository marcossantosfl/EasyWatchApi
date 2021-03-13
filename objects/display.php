<?php
class Display{

    private $connection;

    public $idDisplay;
    public $nameContent;
    public $nameCategory;
    public $image;
    public $price;
    public $available;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }
    
    function read(){
        // prepare query
        $stmt = $this->connection->prepare("SELECT display.idDisplay, content.nameContent, category.nameCategory, content.image, display.price, display.available FROM ((display INNER JOIN category ON category.idCategory = display.idCategory) INNER JOIN content ON content.idContent = display.idContent);");
  
        // execute query
        $stmt->execute();

        return $stmt;   
    }
}
?>