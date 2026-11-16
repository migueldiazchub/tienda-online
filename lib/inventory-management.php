<?php
    session_start();
    require "db.php";

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
        unset($_POST["itemname"]);
        unset($_POST["itemprice"]);
        unset($_POST["itemquantity"]);
        unset($_POST["imagesource"]);
    }

    function addItem(){
        $name = $price = $quant = $src = "";
        $name = testInput($_POST["itemname"]);
        $price = testInput($_POST["itemprice"]);
        $quant = testInput($_POST["itemquantity"]);
        $src = testInput($_POST["imagesource"]);

        $newItem = [
            "name" => $name,
            "price" => $price,
            "quantity" => $quant,
            "imageSource" => $src
        ];
        insertItem($newItem);
    }

    function updateStock(){
        $id = $_POST["itemid"];
        $item = getItemById($id);
        $quant = $_POST["stockquantity"];

        $client = $GLOBALS["client"];
        $db = $GLOBALS["db"];

        if($item->quantity + $quant < 0){
            $client->$db->items->updateOne(
                ["_id" => $item->_id],
                ['$set' => ["quantity" => 0]]
            );
        } else {
            $client->$db->items->updateOne(
                ["_id" => $item->_id],
                ['$set' => ["quantity" => ($item->quantity + $quant)]]
            );
        }
    }

    function deleteItem(){
        $id = $_POST["itemid"];

        $client = $GLOBALS["client"];
        $db = $GLOBALS["db"];
        /** @disregard P1009 */
        $objectId = new MongoDB\BSON\ObjectId($id);
        $client->$db->items->deleteOne(["_id" => $objectId]);
    }

    try {
        $action = $_POST["adminAction"];
        if($action == "addItem"){
            addItem();
            clearItemSubmission();
        } elseif($action == "updateStock"){
            updateStock();
        } elseif($action == "deleteItem"){
            deleteItem(); 
        }
        header("Location: /src/gestion-inventario.php");
    } catch (Exception $e) {
        clearItemSubmission();
        echo $e;
    }
?>