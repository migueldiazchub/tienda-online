<?php
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
?>