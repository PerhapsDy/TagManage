<html>
    <body>
        <table>
            <tr>
                <td colspan="2"><?php echo CHtml::link('内容管理',array('index')); ?></td>
                <td colspan="2">标签管理</td>
            
            </tr>
            <tr>
                <th>内容</th>
                <th colspan="2">操作</th>
            </tr>
            <?php foreach($tag as $t) { ?>
            <tr>
                <?php echo CHtml::beginForm(); ?>
                <td>
                    <input name="modify" value="<?php echo $t['tag'];?>"/>
                </td>
                <td>
                    <input type="hidden" name="id" value="<?php echo $t['id'];?>"/>
                    <input type="hidden" name="tmanage" value="modify"/>
                    <?php echo CHtml::submitButton('修改'); ?>
                </td>
                <?php echo CHtml::endForm(); ?>
                <?php echo CHtml::beginForm(); ?>
                <td>
                    <input type="hidden" name="id" value="<?php echo $t['id'];?>"/>
                    <input type="hidden" name="tmanage" value="delete"/>
                    <?php echo CHtml::submitButton('删除'); ?>
                </td>
                <?php echo CHtml::endForm(); ?>
            </tr>
            
            <?php }?>
            <tr>
            <?php echo CHtml::beginForm(); ?>
                <td><input name="increase" /></td>
                <td colspan="2">
                        <input type="hidden" name="tmanage" value="increase"/>
                        <?php echo CHtml::submitButton('新增'); ?>
                </td>
            <?php echo CHtml::endForm(); ?>
            </tr>
            
        </table>
    </body>
</html>
