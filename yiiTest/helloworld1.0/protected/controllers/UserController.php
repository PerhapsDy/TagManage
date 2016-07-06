<?php

/**
 * SiteController is the default controller to handle tag requests.
 */
class UserController extends CController
{
	/**
	 * Index action is the default action in a controller.
	 */
	public function actionIndex(){
	    if(isset($_POST['bmanage'])){
	       if($_POST['bmanage'] == 'increase'){
	           $user_model = new User();
               $user_model->username = $_POST['increase'];
               $user_model->tagId = $_POST['tag'];
               $user_model->save();
               $user=$user_model->findAll();
               $tag_model = new Tag();
               $tag = $tag_model->findAll();
               $this->renderPartial('index',array('user'=>$user, 'tag'=>$tag));
	       }else if($_POST['bmanage'] == 'delete'){
	           $user_model = User::model()->findByPk($_POST['id']);	
               $user_model->delete();   
               $model = User::model()->findAll();       
               $user = $user_model->findAll(); 
               $tag_model = new Tag();
               $tag = $tag_model->findAll();
               $this->renderPartial('index',array('user'=>$user, 'tag'=>$tag));
	       }else if($_POST['bmanage'] == 'modify'){
	           $user_model = User::model()->findByPk($_POST['id']);
               $user_model->username = $_POST['modify'];
               $user_model->tagId = $_POST['tag'];
               $user_model->save();
               $user = $user_model->findAll(); 
               $tag_model = new Tag();
               $tag = $tag_model->findAll();
               $this->renderPartial('index',array('user'=>$user, 'tag'=>$tag));
	       }
			
		}else{
		    $this->render('index');
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
}