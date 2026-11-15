<?php
    session_start();
    require "db.php";
    
    class Item {
        public $itemId;
        public $name;
        public $price;
        public $quantity;
        public $imageSource;

        function __construct($itemId, $name, $price, $quantity, $imageSource){
            $this->itemId = $itemId;
            $this->name = $name;
            $this->price = $price;
            $this->quantity = $quantity;
            $this->imageSource = $imageSource;
        }
    }

    function testInput($data) {
        if($data == NULL) {
            return "";
        }
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function clearItemSubmission(){
        unset($_POST["itemid"]);
        unset($_POST["itemname"]);
        unset($_POST["itemprice"]);
        unset($_POST["itemquantity"]);
        unset($_POST["imagesource"]);
    }

    function addItem(){
        $id = $name = $price = $quant = $src = "";
        $id = testInput($_POST["itemid"]);
        $name = testInput($_POST["itemname"]);
        $price = testInput($_POST["itemprice"]);
        $quant = testInput($_POST["itemquantity"]);
        $src = testInput($_POST["imagesource"]);

        $newItem = new Item($id, $name, $price, $quant, $src);
        $data = getData();
        $data->items[] = $newItem;
    
        writeData(json_encode($data));
    }

    try {
        addItem();
        clearItemSubmission();
        header("Location: /src/gestion-inventario.php");
    } catch (Exception $e) {
        clearItemSubmission();
        echo $e;
    }


?>