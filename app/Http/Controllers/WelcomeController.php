<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
class WelcomeController extends Controller
{
    //
    public function index(){
    	$storage = Redis::Connection();    	
    	$popular = $storage->zRevRange('articleViews',0,-1);



    	$views = $storage->keys('*');
    	// dd($views);	
    	foreach ($views as $view)
			{
				//Get Value of Key from Redis
				$value = $storage->get($view);
				
				//Print Key/value Pairs
				echo "<b>Key:</b> $view <br /><b>Value:</b> $value <br /><br />";
			}	


/*
    	foreach ($popular as $value ) {   		

    		$id = str_replace('article:', '', $value);	    	
    		echo "Article" . $id . " is popular<br>";

    	}
*/
    }


    
}
