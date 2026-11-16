<?php
    require "../vendor/autoload.php";

    $uri = getenv("MONGODB_URI");

    $client = new MongoDB\Client($uri);
    $db = "testdb";

    function getUsers(){
        $client = $GLOBALS["client"];
        $db = $GLOBALS["db"];
        $users = $client->$db->users->find();
        return $users;
    }

    function getUserById($id){
        $client = $GLOBALS["client"];
        $db = $GLOBALS["db"];
        // por algún el constructor de ObjectId da este error:
        // Error: Undefined type 'MongoDB\BSON\ObjectId'.
        // el código sigue funcionando así que voy a hacer como que no he visto nada
        /** @disregard P1009 */
        $objectId = new MongoDB\BSON\ObjectId($id);
        return $client->$db->users->findOne(["_id" => $objectId]);
    }

    function insertUser($newUser){
        $client = $GLOBALS["client"];
        $db = $GLOBALS["db"];
        $client->$db->users->insertOne($newUser);
    }

    function getItems(){
        $client = $GLOBALS["client"];
        $db = $GLOBALS["db"];
        $items = $client->$db->items->find();
        return $items;
    }

    function getItemById($id){
        $client = $GLOBALS["client"];
        $db = $GLOBALS["db"];
        /** @disregard P1009 */
        $objectId = new MongoDB\BSON\ObjectId($id);
        return $client->$db->items->findOne(["_id" => $objectId]);
    }

    function insertItem($newItem){
        $client = $GLOBALS["client"];
        $db = $GLOBALS["db"];
        $client->$db->items->insertOne($newItem);
    }

    function getPendingPurchases(){
        $client = $GLOBALS["client"];
        $db = $GLOBALS["db"];
        $purchases = $client->$db->purchases->find(["state" => "pending"]);
        return $purchases;
    }

    function getResolvedPurchases(){
        $client = $GLOBALS["client"];
        $db = $GLOBALS["db"];
        $purchases = $client->$db->purchases->find(["state" => [ '$ne' => "pending"]]);
        return $purchases;
    }

    function getUserPurchases($id){
        $client = $GLOBALS["client"];
        $db = $GLOBALS["db"];
        $purchases = $client->$db->purchases->find(["user_id" => $id]);
        return $purchases;
    }

    function getPurchaseById($id){
        $client = $GLOBALS["client"];
        $db = $GLOBALS["db"];
        /** @disregard P1009 */
        $objectId = new MongoDB\BSON\ObjectId($id);
        return $client->$db->purchases->findOne(["_id" => $objectId]);
    }

    function createPurchaseRequest($newPurchase){
        $client = $GLOBALS["client"];
        $db = $GLOBALS["db"];
        $client->$db->purchases->insertOne($newPurchase);
    }
?>