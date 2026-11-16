<?php
    require "db.php";

    function approvePurchase(){
        $id = $_POST["purchaseId"];
        $purchase = getPurchaseById($id);

        $client = $GLOBALS["client"];
        $db = $GLOBALS["db"];
        $client->$db->purchases->updateOne(
            ["_id" => $purchase->_id],
            ['$set' => ["state" => "confirmed"]]
        );
    }

    function rejectPurchase(){
        $client = $GLOBALS["client"];
        $db = $GLOBALS["db"];    
    
        $id = $_POST["purchaseId"];
        $purchase = getPurchaseById($id);
        foreach($purchase->items as $itemPurchased){
            $item = getItemById($itemPurchased->item_id);
            $client->$db->items->updateOne(
                ["_id" => $item->_id],
                ['$set' => ["quantity" => ($item->quantity + $itemPurchased->quantity)]]
            );
        }
    
        $client->$db->purchases->updateOne(
            ["_id" => $purchase->_id],
            ['$set' => ["state" => "rejected"]]
        );
    }

    try {
        $action = $_POST["adminAction"];
        if($action == "approvePurchase"){
            approvePurchase();
        } elseif ($action == "rejectPurchase"){
            rejectPurchase();
        }
        header("Location: /src/gestion-compras.php");
    } catch (Exception $e) {
        
        echo $e;
    }
?>