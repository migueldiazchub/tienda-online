<?php
    require "../vendor/autoload.php";

    // Replace the placeholder with your Atlas connection string
    $uri = getenv("MONGODB_URI");
    
    // Create a MongoDB client
    $client = new MongoDB\Client($uri);
    $db = "testdb";

    function getData(){
        $datafile = fopen("../assets/data.json", "r");
        $data = fread($datafile, filesize("../assets/data.json"));
        fclose($datafile);
        return json_decode($data);
    }

    function getUsers(){
        $client = $GLOBALS["client"];
        $db = $GLOBALS["db"];
        $users = $client->$db->users->find();
        return $users;
    }

    function getItems(){
        $data = getData();
        $items = $data->items;
        return $items;
    }

    function getItemById($id){
        $itemList = getItems();
        $itemQueried = "";
        foreach($itemList as $item){
            if($item->itemId == $id){
                $itemQueried = $item;
                return $itemQueried;
            }
        }
        return null;
    }

    function writeData($newData){
        $datafile = fopen("../assets/data.json", "w");
        fwrite($datafile, $newData);
        fclose($datafile);
    }
?>