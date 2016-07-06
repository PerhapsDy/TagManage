<html>
    <body>
        <table>
            <tr>
                <td colspan="4">内容管理</td>
                
            
            </tr>
            <tr>
                <th>内容</th>               
                <th colspan="2">操作</th>
                <th>标签管理</th> 
            </tr>
            <?php if(isset($user)){ ?>
            <?php foreach($user as $u) { ?>
            <tr>
                <?php echo CHtml::beginForm(); ?>
                <td>
                    <input name="modify" value="<?php echo $u['username'];?>"/>
                </td>
                <td>
                    <input type="hidden" name="id" value="<?php echo $u['id'];?>"/>
                    <input type="hidden" name="bmanage" value="modify"/>
                    <?php echo CHtml::submitButton('修改'); ?>
                </td>
                <?php echo CHtml::endForm(); ?>
                <?php echo CHtml::beginForm(); ?>
                <td>
                    <input type="hidden" name="id" value="<?php echo $u['id'];?>"/>
                    <input type="hidden" name="bmanage" value="delete"/>
                    <?php echo CHtml::submitButton('删除'); ?>
                </td>
                <?php echo CHtml::endForm(); ?>
                <?php echo CHtml::beginForm(); ?>
                
                <td style="text-align:center;" >
                    <input type="hidden" name="id" value="<?php echo $u['id'];?>"/>
                    <input type="hidden" name="bmanage" value="manage"/>
                    <?php echo CHtml::submitButton('管理'); ?>
                </td>
                <?php echo CHtml::endForm(); ?>
            </tr>
            
            <?php }?>
            <?php }?>
            <tr>
            <?php echo CHtml::beginForm(); ?>
                <td><input name="increase" /></td>
                <td colspan="2">
                        <input type="hidden" name="bmanage" value="increase"/>
                        <?php echo CHtml::submitButton('新增'); ?>
                </td>
            <?php echo CHtml::endForm(); ?>
            </tr>
            
        </table>
        <table style="display: none;">
            <tr>
                <td colspan="4">
                    <form action="/yiitest/helloworld/index.php/user/index">
                        <input value="/yiitest/helloworld/index.php/site/index"/>
                        <input name="password"/>
                        <input type="submit" />
                    </form>
                </td>
            </tr>
        </table>
    </body>
</html>
