<?php
    session_start();

    require "db.php";
 
    function addToCart(){
        $cart = $_SESSION["shopCart"];
        $quant = $_POST["quantity"];

        $item = getItemById($_POST["itemid"]);
        if($quant > $item->quantity){
            throw new Exception("No se pueden añadir más unidades de las disponibles");
        } else {
            $client = $GLOBALS["client"];
            $db = $GLOBALS["db"];

            $client->$db->items->updateOne(
                ["_id" => $item->_id],
                ['$set' => ["quantity" => ($item->quantity - $quant)]]
            );
        }

        $cartItem = [
            "id" => (string) $item->_id,
            "name" => $item->name,
            "price" => $item->price,
            "quantity" => $quant,
            "imageSource" => $item->imageSource
        ];
        $cart[] = $cartItem;
        return $cart;
    }

    function removeFromCart(){
        $cart = $_SESSION["shopCart"];
        $index = $_POST["index"];
        $item = getItemById($cart[$index]["id"]);

        $client = $GLOBALS["client"];
        $db = $GLOBALS["db"];
        
        $client->$db->items->updateOne(
            ["_id" => $item->_id],
            ['$set' => ["quantity" => ($item->quantity + $cart[$index]["quantity"])]]
        );

        array_splice($cart, $index, 1);
        return $cart;
    }

    try {
        if($_POST["cartAction"] == "addItem"){
            $cart = addToCart();
            $_SESSION["shopCart"] = $cart;
        } elseif($_POST["cartAction"] == "deleteItem"){
            $cart = removeFromCart();
            $_SESSION["shopCart"] = $cart;
        }

        header("Location: /src/carrito.php");
    } catch (Exception $e){
        echo $e;
    }
    
    
?>