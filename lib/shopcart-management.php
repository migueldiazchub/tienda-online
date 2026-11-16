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
        
        for($i = 0; $i < count($cart); $i++){
            if($cart[$i]["id"] == $cartItem["id"]){
                $cartItem["quantity"] += $cart[$i]["quantity"];
                array_splice($cart, $i, 1);
            }
        }

        $cart[] = $cartItem;
        return $cart;
    }

    function removeFromCart($index){
        $cart = $_SESSION["shopCart"];
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

    function removeAll(){
        $cart = $_SESSION["shopCart"];
        foreach($cart as $cartItem){
            $item = getItemById($cartItem["id"]);

            $client = $GLOBALS["client"];
            $db = $GLOBALS["db"];

            $client->$db->items->updateOne(
                ["_id" => $item->_id],
                ['$set' => ["quantity" => ($item->quantity + $cartItem["quantity"])]]
            );
        }
        $cart = [];
        return $cart;
    }

    function requestPurchase(){
        $cart = $_SESSION["shopCart"];
        $userIdString = (string) $_SESSION["userId"];
        $newPurchase = [
            "user_id" => $userIdString,
            "state" => "pending",
            "dateRequested" => date("c"),
            "dateResolved" => "",
            "items" => [],
            "priceTotal" => 0
        ];
        foreach($cart as $item){
            $newPurchase["items"][] = [
                "item_id" => $item["id"],
                "quantity" => $item["quantity"]
            ];
            $newPurchase["priceTotal"] += $item["price"];
        }
        createPurchaseRequest($newPurchase);

        $cart = [];
        return $cart;
    }

    try {
        if($_POST["cartAction"] == "addItem"){
            $cart = addToCart();
            $_SESSION["shopCart"] = $cart;
        } elseif($_POST["cartAction"] == "deleteItem"){
            $cart = removeFromCart($_POST["index"]);
            $_SESSION["shopCart"] = $cart;
        } elseif($_POST["cartAction"] == "cancelPurchase"){
            $cart = removeAll();
            $_SESSION["shopCart"] = $cart;
        } elseif($_POST["cartAction"] == "requestPurchase"){
            $cart = requestPurchase();
            $_SESSION["shopCart"] = $cart;
        }

        header("Location: /src/carrito.php");
    } catch (Exception $e){
        echo $e;
    }
    
    
?>