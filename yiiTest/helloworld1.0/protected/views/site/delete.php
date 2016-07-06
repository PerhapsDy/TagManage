<html>
    <body>
        <h1>删除成功</h1>
        <?php echo CHtml::link('Start Again',array('index')); ?>
        <?php echo CHtml::beginForm(); ?>
        <table>
            <tr>
                <td><input value="<?php echo Yii::app()->request->getUrl(); ?>"/></td>
                <td><button>修改</button></td>
                <input type="hidden" name="delete" value="delete"/>
                <td><?php echo CHtml::submitButton('Delete'); ?></td>
            </tr>
            <tr>
                <td><input name="username"/></td>
                <td colspan="2"><button>新增</button></td>
            </tr>
        </table>
        <?php echo CHtml::endForm(); ?>
        <form action="http://localhost">
            <input name="password"/>
            <input type="submit" />
        </form>
    
    </body>
</html>