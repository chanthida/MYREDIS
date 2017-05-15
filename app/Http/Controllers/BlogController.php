<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class BlogController extends Controller
{
    //
    public function showArticle($id){
		$this->id = $id;
    	$storage = Redis::Connection();


	if($storage->zScore('articleViews','article:'.$id)){

		$storage->pipeline(function ($pipe){
			$pipe->zIncrBy('articleViews',1,'article:'.$this->id);
			$pipe->incr('article:'.$this->id.':views');
		});

	}else{
		$views = $storage->incr('article:'.$this->id.':views');
		$storage->zIncrBy('articleViews',$views,'article:'.$this->id);
	}
    	// $views = $storage->incr('article:'.$this->id.':views');
		$views = $storage->get('article:'.$this->id.':views');
		$storage->zIncrBy('articleViews',$views,'article:'.$this->id);


    	return "id: ".$id." views: ".$views; 
    }
}
