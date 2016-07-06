<html>
    <body>
        <table>
            <tr>
                <td colspan="2"><?php echo CHtml::link('内容管理',array('index')); ?></td>
                <td colspan="2"><?php echo CHtml::link('标签管理',array('tag')); ?></td>
            </tr>
            <tr>
                <th>内容</th> 
                <th style="align:center;" >已有标签</th>              
                <th colspan="2">新增标签</th> 
            </tr>
            <tr>
                <td>
                    <input name="modify" value="<?php echo $user['username'];?>" readonly="true"/>
                </td>
                <td>
                <?php 
                    $idarray = array();
                    $displayL = 'block';
                    foreach($relation as $r){
                        array_push($idarray, $r['tagId']);
                    }
                ?>
                <?php 
                    foreach($tag as $t) { 
                            if(in_array($t['id'],$idarray)){
                                $displayL = 'none';
                                    
                ?>
                    <form action="/yiitest/helloworld/index.php/site/tagManage" method="post">
                        <input name="tag" value="<?php echo $t['tag'];?>" readonly="true" style="width: 60;background: red;"/>
                        <input type="hidden" name="userId" value="<?php echo $user['id'];?>"/>
                        <input type="hidden" name="tagId" value="<?php echo $t['id'];?>"/>
                        <input type="hidden" name="manage" value="delete"/>
                        <?php echo CHtml::submitButton('删除'); ?>
                    </form>
                <?php 
                            }
                    }

                ?>
                    <label style="display: <?php echo $displayL; ?>;">无</label>                                
                 
                </td>
                <form action="/yiitest/helloworld/index.php/site/tagManage" method="post">
                <td>
                    <?php 
                        $idarray = array();
                        $displayI = 'none';
                        $displayO = 'block';
                        foreach($relation as $r){
                            array_push($idarray, $r['tagId']);
                        }
                    ?>
                    <select name="tagId" >                       
                    <?php foreach($tag as $t) { 
                            if(in_array($t['id'],$idarray)){
                            }else{
                                $displayI = 'block';
                                $displayO = 'none';
                    ?>
                                <option  value="<?php echo $t['id']; ?>"><?php echo $t['tag']; ?></option>
                        <?php 
                                    }
                                
                            }
                        ?>
                        
                                <option style="display: <?php echo $displayO; ?>;">没有可选标签</option> 
                    </select>
                </td>
                <td>
                    <input type="hidden" name="userId" value="<?php echo $user['id'];?>"/>
                    <input type="hidden" name="manage" value="increase"/>
                    <input type="submit" value="新增" style="display: <?php echo $displayI; ?>;"/>
                </td>
                </form>
            </tr>
            
        </table>
    </body>
</html>
