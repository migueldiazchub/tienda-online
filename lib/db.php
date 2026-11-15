<?php
    class User {
        public $userId;
        public $username;
        public $email;
        public $password;
        public $admin = false;
        public $purchaseHistory = [];

        function __construct($userId, $username, $email, $password){
            $this->userId = $userId;
            $this->username = $username;
            $this->email = $email;
            $this->password = $password;
        }
    }

    function getData(){
        $datafile = fopen("../assets/data.json", "r");
        $data = fread($datafile, filesize("../assets/data.json"));
        fclose($datafile);
        return json_decode($data);
    }

    function getUsers(){
        $data = getData();
        $users = $data->users;
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
                break;
            }
        }
        return $itemQueried;
    }

    function writeData($newData){
        $datafile = fopen("../assets/data.json", "w");
        fwrite($datafile, $newData);
        fclose($datafile);
    }
?>