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
				$('#btn_add').click(function(){
					var tag      = $('input[name="tag"]').val();
    				$('input[name="tag"]').val('');
                    if(tag!=''){
                        var exist    = $.inArray(tag,tags); 
                        var tagstring='';
                        if(exist<0){
                            tags[i] = tag;
                            i++;
                        }
                        for(j=k;j!=i;j++){
                            if(tags[j]){
                                var  inputhidden = '<input type="hidden" id="aid" class="gid" value='+tags[j]+'/>';
                                var deletetag='<a class="btn_del" href="javascript:void(0)" onclick="del('+"'"+tags[j]+"'"+')"><img src="http://localhost/yiiTest/helloworld1.0/images/dot_del.png" /></a>'
                                tagstring = tagstring+'<label style="margin-right:10px;background-color:#FCD24C;"><a href="/yiitest/helloworld1.0/index.php/site/tagcontent?manage=search&tag='+tags[j]+'" >'+tags[j]+inputhidden+deletetag+'</label>';
                            }
                            
                        }
    					document.getElementById('tagshow').innerHTML= tagstring;
                    }
                    
				
				});  
                $('#btn_sub').click(function(){
                    if(tags){
                        $('input[name="hidtag"]').val(tags);
                        document.getElementById('myform').submit();
                        
                    }else{
                        alert('请选择标签');return false;
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
        <table>
            <tr>
                <td>内容</td>
                <td >
                    <input name="modify" value="<?php echo $user['username'];?>" readonly="true" style="width: 100;"/>
                </td>
            </tr>
            <tr>
                <td>已有标签</td>
                <td >
                <input type="hidden"  id="num" value="<?php echo $num;?>"/>
                <label id="tagshow"></label>
                <?php if(!empty($ship)){
                          $i = 0;
                          foreach($ship as $s){
                                
                                echo '<label id="'.$s['tag'].'" style="margin-right:10px;background-color:#FCD24C;" ><a href="/yiitest/helloworld1.0/index.php/site/tagcontent?manage=search&tag='.$s['tag'].'" >'.$s['tag'].'
                                        <a id="btn_delhid" class="btn_delhid" href="javascript:void(0)" ><img src="http://localhost/yiiTest/helloworld1.0/images/dot_del.png" /></a>
                                        <input type="hidden"  id="hid'.$i.'" value="'.$s['tag'].'"/>
                                        <input type="hidden"  id="hid" value="'.$s['tag'].'"/>
                                      </label>';
                                $i++;
                          }
                          
                      }
                ?>
                </td>
                
            </tr>
            <tr>
                <td>标签</td>
                <td colspan="2">
                    <input name="tag" id="tag" style="width: 200;"/>
                    <input type="button" id="btn_add" value="新增标签" />
                </td>
            </tr>
            <tr>
                <form action="/yiitest/helloworld1.0/index.php/site/tagmanage" id="myform" method="post">
                    <td >
                        <input type="hidden" id="hidtag" name="hidtag" value=""/>
                        <input type="hidden" name="userId" value="<?php echo $user['id'];?>"/>
                        <input type="hidden" name="manage" value="increase" />
                        <input type="button" id="btn_sub" value="提交" />
                    </td>
                </form>
            </tr>
            
        </table>
    </body>
</html>
