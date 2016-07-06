<?php

/**
 * SiteController is the default controller to handle tag requests.
 */
class SiteController extends CController
{
	/**
	 * Index action is the default action in a controller.
	 */
	public function actionIndex(){
	    if(isset($_POST['bmanage'])){
	       if($_POST['bmanage'] == 'increase'){
	           $user_model = new User();
               $user_model->username = $_POST['increase'];
               $user_model->save();
               $user=$user_model->findAll();
               $this->renderPartial('index',array('user'=>$user));
	       }else if($_POST['bmanage'] == 'delete'){
	           $user_model = User::model()->findByPk($_POST['id']);	
               $user_model->delete();   
               $model = User::model()->findAll();       
               $user = $user_model->findAll(); 
               $this->renderPartial('index',array('user'=>$user));
	       }else if($_POST['bmanage'] == 'modify'){
	           $user_model = User::model()->findByPk($_POST['id']);
               $user_model->username = $_POST['modify'];
               $user_model->save();
               $user = $user_model->findAll();
               $this->renderPartial('index',array('user'=>$user));
	       }else if($_POST['bmanage'] == 'manage'){
	           $tag_model = new Tag();
               $tag = $tag_model->findAll();
               
               $user = User::model()->findByPk($_POST['id']);
               $ship = new Ship();              
               $ship = $ship->findAll('userId=:userId', array(':userId'=>$_POST['id']));
               
               $num = Ship::model()->count('userId=:userId', array(':userId'=>$_POST['id']));
               $this->renderPartial('relation',array('user'=>$user, 'ship'=>$ship, 'num'=>$num));
	       }
			
		}else{
		    $user_model = new User();
            $user = $user_model->findAll();
            $tag_model = new Tag();
            $tag = $tag_model->findAll();
            $this->renderPartial('index',array('user'=>$user, 'tag'=>$tag));
		}
		
	}
    public function actionTag(){
        
        if(isset($_POST['tmanage'])){
		    if($_POST['tmanage'] == 'increase'){
	           $tag_model = new Tag();
               $tag_model->tag = $_POST['increase'];
               $tag_model->save();
               $tag=$tag_model->findAll();
               $this->renderPartial('tag',array('tag'=>$tag));
	       }else if($_POST['tmanage'] == 'delete'){
	           $tag_model = Tag::model()->findByPk($_POST['id']);	
               $tag_model->delete();   
               $model = Tag::model()->findAll();       
               $tag = $tag_model->findAll();               
               $this->renderPartial('tag',array('tag'=>$tag));
	       }else if($_POST['tmanage'] == 'modify'){
	           $tag_model = Tag::model()->findByPk($_POST['id']);
               $tag_model->tag = $_POST['modify'];
               $tag_model->save();
               $tag = $tag_model->findAll(); 
               $this->renderPartial('tag',array('tag'=>$tag));
	       }
        }else{
		    $tag_model = new Tag();
            $tag=$tag_model->findAll();
            $this->renderPartial('tag',array('tag'=>$tag));
		}
	}
     public function actionTagManage(){
        
        if(isset($_POST['manage'])){
		    if($_POST['manage'] == 'increase'){
		       $hidtag   = $_POST['hidtag'];
               $hidtag   = trim($hidtag, ',');
               $hidtags  = explode(',', $hidtag);
               $total = count($hidtags);//总数量
                              
               Ship::model()->deleteAll('userId=:userId', array(':userId'=>$_POST['userId']));           
	           for($i = 0; $i < $total; $i++){
                    $ship = new Ship();
 				    $ship->tag = $hidtags[$i];
                    $ship->userId = $_POST['userId'];
                    if($hidtags[$i]!=''){
                        $ship->save();
                    }
               }
               
               
               $user = User::model()->findByPk($_POST['userId']);
                              
               $ship = $ship->findAll('userId=:userId', array(':userId'=>$_POST['userId']));
               $num = Ship::model()->count('userId=:userId', array(':userId'=>$_POST['userId']));
               $this->renderPartial('relation',array('user'=>$user, 'ship'=>$ship, 'num'=>$num));
	       }else if($_POST['manage'] == 'delete'){
	           $relation = new Relation();
	           $relation = $relation->find('userId=:userId AND tagId=:tagId', array(':userId'=>$_POST['userId'], ':tagId'=>$_POST['tagId']));
               $relation->delete(); 
                 
               $user = User::model()->findByPk($_POST['userId']);     
               
               $relation = $relation->findAll('userId=:userId', array(':userId'=>$_POST['userId']));
               
               $tag_model = new Tag();
               $tag = $tag_model->findAll();        
                      
               $this->renderPartial('relation',array('tag'=>$tag, 'user'=>$user, 'relation'=>$relation));
	       }
        }else{
		    $tag_model = new Tag();
            $tag=$tag_model->findAll();
            $this->renderPartial('tagManage',array('tag'=>$tag));
		}
	}
    public function actionTagContent(){
        
        if(isset($_GET['manage'])){
		    if($_GET['manage'] == 'search'){
		       $tag   = $_GET['tag'];
               $ship = new Ship();
               $ship = $ship->findAll('tag=:tag', array(':tag'=>$tag));
               $contents = array();
               foreach($ship as $s){
                    $user = User::model()->findByPk($s['userId']);
                    $ship_model = Ship::model()->findAll('userId=:userId', array(':userId'=>$s['userId']));
                    
                    $content = array('username'=>$user['username'], 'ships'=>$ship_model);
                    array_push($contents, $content);
               }
               $num = 1;
               
               
               
               $this->renderPartial('contentlist',array('contents'=>$contents, 'tag'=>$tag, 'num'=>$num));
	       }
        }else if(isset($_POST['manage'])){
		    if($_POST['manage'] == 'findmore'){
		       $hidtag   = $_POST['hidtag'];
               $hidtag   = trim($hidtag, ',');
               $tags     = explode(',', $hidtag);
               $total = count($tags);//总数量
               $contents = array();
               
               $ship = new Ship();
               $ship = $ship->findAll('tag=:tag', array(':tag'=>$tags['0']));
               foreach($ship as $s){
                    $user = User::model()->findByPk($s['userId']);
                    $ship_model = Ship::model()->findAll('userId=:userId', array(':userId'=>$s['userId']));
                    
                    $content = array('username'=>$user['username'], 'ships'=>$ship_model);
                    array_push($contents, $content);
                }
               for($i = 1; $i < $total; $i++){
                    $ship = new Ship();
                    $ship = $ship->findAll('tag=:tag', array(':tag'=>$tags[$i]));
                    $contentNew = array();
                    foreach($ship as $s){
                        $user = User::model()->findByPk($s['userId']);
                        $ship_model = Ship::model()->findAll('userId=:userId', array(':userId'=>$s['userId']));
                        
                        $content = array('username'=>$user['username'], 'ships'=>$ship_model);
                        if(in_array($content, $contents)){
                            array_push($contentNew, $content);
                        }
                    }
                        $contents = $contentNew;
                
               }
               $num = $total;
               $this->renderPartial('contentlist',array('contents'=>$contents, 'tags'=>$tags, 'num'=>$num));
	       }else{
		    $tag_model = new Tag();
            $tag=$tag_model->findAll();
            $this->renderPartial('delete',array('tag'=>$tag));
            }
		}
	}
}