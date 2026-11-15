<?php
    session_start();

    require "db.php";
 
    function addToCart(){
        $data = getData();

        $cart = $_SESSION["shopCart"];
        $id = $_POST["itemid"];
        $quant = $_POST["quantity"];

        foreach($data->items as $item){
            if($item->itemId == $id){
                if($quant <= $item->quantity){
                    $item->quantity -= $quant;
                    if(!isset($cart[$id])){
                        $cart[$id] = $quant;
                    } else {
                        $cart[$id] += $quant;
                    }
                    writeData(json_encode($data));
                    return $cart;
                } else {
                    throw new Exception("No se pueden añadir más unidades de las disponibles");
                }
            }
        }
    }

    function removeFromCart(){
        $data = getData();

        $cart = $_SESSION["shopCart"];
        $id = $_POST["itemid"];
        $quant = $cart[$id];

        foreach($data->items as $item){
            if($item->itemId == $id){
                $item->quantity += $quant;
                unset($cart[$id]);
                writeData(json_encode($data));
                return $cart;
            }
        }
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