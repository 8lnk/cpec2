<?php
	// подключение библиотек
	require "inc/lib.inc.php";
	require "inc/config.inc.php";
    $id = $_GET['id'] ?? null;
  
	if(!$id = clearInt($id)){
        echo "error";
	} else {
        $goods = selectAllItems($link); 

        foreach ($goods as $item) {
            if($item['id'] == $id) {
                $realId = $id;
                break;  
            } else {
                $realId = null;
            }      
        }  

        if (isset($realId)) {
            add2Basket($id);
        }
        
    }
    header('Location: catalog.php');
		
        

    
