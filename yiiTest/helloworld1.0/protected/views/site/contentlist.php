<html>
    <head>
		<link rel="stylesheet" href="http://localhost/yiiTest/helloworld1.0/css/style.css" type="text/css" />
		<link rel="stylesheet" href="http://localhost/yiiTest/helloworld1.0/css/form.css" type="text/css" />
        
		<script type="text/javascript" src="http://localhost/yiiTest/helloworld1.0/js/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="http://localhost/yiiTest/helloworld1.0/js/layer/layer.js"></script>
		<script type="text/javascript" src="http://localhost/yiiTest/helloworld1.0/js/common.js"></script>
        <script type="text/javascript">                
            var tags = new Array();
            var i = 0;
            var k ;
			$(function(){ 
                $('.btn_sub').click(function(){
                    var tag = $(this).parent('label').find('#hid').val();;
                    var exist    = $.inArray(tag,tags);
                    if(exist<0){
                        tags[i] = tag;
                        i++;
                        $('input[name="hidtag"]').val(tags);
                        document.getElementById('myform').submit();
                        
                    }else{
                        alert('标签选择重复');return false;
                    }
                }); 
                $('.btn_delhid').click(function(){
                    
					var taghidden = $(this).parent('label').find('#hid').val();
                    tags.splice($.inArray(taghidden,tags),1);
                    k--;
                    var label = document.getElementById(taghidden);
                    label.style.display='none';
                    
                    
                });    		
			});  
            window.onload=function(){
                var num = document.getElementById('num');
                var n = num.value;
                var tag ;
                for(k=0;k<n;k++){
                    m = 'hid'+k;
                    tag = document.getElementById(m);
                    tags[i]=tag.value;
                    i++;
                }                    
            }          
            
            function del(aaa){
                var inputhidden = aaa;
                tags.splice($.inArray(inputhidden,tags),1); 
                
				document.getElementById('tagshow').innerHTML= '';
                var tagstring='';
                for(j=k;j!=i;j++){
                    if(tags[j]){
                        var  inputhidden = '<input type="hidden" id="gid" class="gid" value='+tags[j]+'/>';
                        var deletetag='<a class="btn_del" href="javascript:void(0)" onclick="del('+"'"+tags[j]+"'"+')"><img src="http://localhost/yiiTest/helloworld1.0/images/dot_del.png" /></a>'
                        tagstring = tagstring+'<label style="margin-right:10px;background-color:#FCD24C;"><a href="/yiitest/helloworld1.0/index.php/site/tagcontent?manage=search&tag='+tags[j]+'" >'+tags[j]+'</a>'+inputhidden+deletetag+'</label>';
                    }
                    
                }
				document.getElementById('tagshow').innerHTML= tagstring;
                
            }
		
        </script>
    </head>
    <body>
        
        <h1><?php echo CHtml::link('内容管理',array('index')); ?></h1>
        <div>  
            <div><label>已选标签</label></div>
            <div>
                <?php
                    if(!empty($tags)){  
                        $i = 0;
                        foreach($tags as $tag){?>
                        <label style="margin-right:10px;background-color:#FCD24C;">
                            <?php echo $tag;?>
                        </label>
                        <input type="hidden" id="hid<?php echo $i;?>" value="<?php echo $tag; ?>"/>
                <?php $i++; 
                        } 
                    }else{ $i = 0;?>
                    
                        <label style="margin-right:10px;background-color:#FCD24C;">
                            <?php echo $tag;?>
                        </label>
                        <input type="hidden" id="hid<?php echo $i;?>" value="<?php echo $tag; ?>"/>
                <?php }?>
            </div>
        </div>
        <table>
            <tr>
                <th>标签</th>
                <th>内容</th>
            </tr>
            <form action="/yiitest/helloworld1.0/index.php/site/tagcontent" method="post" id="myform" name="myform">
            <?php foreach($contents as $content){ ?>
                    <tr>
                        <td>
                            <?php foreach($content['ships'] as $ship){
                                     echo '<label style="margin-right:10px;background-color:#FCD24C;">
                                                <a id="btn_sub" class="btn_sub" href="javascript:void(0)" >'.$ship['tag'].'
                                                </a>
                                                <input type="hidden" id="hid" value="'.$ship['tag'].'" />
                                          </label>';
                            }?>
                        </td>
                        <td>
                            <?php echo $content['username']; ?>
                            <input type="hidden" id="hidtag" name="hidtag" value="" />
                            <input type="hidden" id="" name="manage" value="findmore" />
                            <input type="hidden" id="num" value="<?php echo $num;?>" />
                        </td>
                    </tr>
            <?php }?>
            </form>
        </table>
    
    </body>
</html>