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
                
               $relation_model = new Relation();             
               $relation = $relation_model->findAll('userId=:userId', array(':userId'=>$_POST['id']));
               $this->renderPartial('relation',array('tag'=>$tag, 'user'=>$user, 'relation'=>$relation));
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
	           $relation = new Relation();
               $relation->tagId = $_POST['tagId'];
               $relation->userId = $_POST['userId'];
               $relation->save();
               
               $tag_model = new Tag();
               $tag = $tag_model->findAll();
               
               $user = User::model()->findByPk($_POST['userId']);
                              
               $relation = $relation->findAll('userId=:userId', array(':userId'=>$_POST['userId']));
               
               $this->renderPartial('relation',array('tag'=>$tag, 'user'=>$user, 'relation'=>$relation));
	       }else if($_POST['manage'] == 'delete'){
	           $relation = new Relation;
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
}