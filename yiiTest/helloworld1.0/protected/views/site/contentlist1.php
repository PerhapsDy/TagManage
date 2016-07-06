<html>
    <head>
		<link rel="stylesheet" href="http://localhost/yiiTest/helloworld1.0/css/style.css" type="text/css" />
		<link rel="stylesheet" href="http://localhost/yiiTest/helloworld1.0/css/form.css" type="text/css" />
    </head>
    <body>
        
        <h1><?php echo CHtml::link('内容管理',array('index')); ?></h1>
        <div>  
            <div><label>已选标签</label></div>
            <div>
            </div>
        </div>
        <div><label>$tag</label></div>
        <table>
            <tr>
                <th>标签</th>
                <th>内容</th>
            </tr>
                <?php foreach($users as $user){
                        echo '<tr><td>'.$tag.'</td>
                             <td>'.$user.'</td></tr>';
                }?>
        </table>
    
    </body>
</html>