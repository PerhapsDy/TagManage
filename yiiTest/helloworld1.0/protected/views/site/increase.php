<?php
    
    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>添加新闻 - 新闻管理 - 管理系统 </title>
		<link rel="stylesheet" href="http://localhost/yiiTest/helloworld1.0/css/style.css" type="text/css" />
		<link rel="stylesheet" href="http://localhost/yiiTest/helloworld1.0/css/form.css" type="text/css" />
		<script type="text/javascript" src="http://localhost/yiiTest/helloworld1.0/js/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="http://localhost/yiiTest/helloworld1.0/js/layer/layer.js"></script>
		<script type="text/javascript" src="http://localhost/yiiTest/helloworld1.0/js/common.js"></script>
		<script type="text/javascript">
			$(function(){
                //日期组件
                laydate({
        			elem: '#news_date', //需显示日期的元素选择器
        	        event: 'click', //触发事件
        	        format: 'YYYY-MM-DD', //日期格式
        	        istime: false, //是否开启时间选择
        	        isclear: true, //是否显示清空
        	        istoday: true, //是否显示今天
        	        issure: true, //是否显示确认
        	        festival: true, //是否显示节日
        	        //min: '1900-01-01 00:00:00', //最小日期
        	       	//max: '2099-12-31 23:59:59', //最大日期
        	        //start: '2014-6-15 23:00:00',    //开始日期
        	        //fixed: false, //是否固定在可视区域
        	        //zIndex: 99999999, //css z-index
        	        choose: function(dates){ //选择好日期的回调
        	        }
        		});
                
                //简介字数统计
                $("#news_intro").keyup(function(){
                    var maxlen = 140;
                    var len = $(this).val().length;
                    if(len > maxlen){
                        $(this).val($(this).val().substring(0, maxlen));
                    }
                    var num = maxlen - len;
                    $("#introwordscount").text(num);
                });
                
                //添加新闻
                $('.btn_submit').click(function(){
                    //start数据检查
                    var title       = $('input[name=title]').val();
                    var sort        = $('#news_sort').val();
                    var pic         = $('input[name=pic]').val();
                    var author      = $('input[name=author]').val();
                    var source      = $('input[name=source]').val();
                    var sourceurl   = $('input[name=sourceurl]').val();
                    var date        = $('input[name=date]').val();
                    var intro       = $('#news_intro').val();
                    var status      = $('#news_status').val();
                    var content     = ckeditor.getData();
                    
                    if(title == ''){
                        layer.msg('标题不能为空');
						return false;
                    }
                    if(date == ''){
                        layer.msg('请填写日期');
						return false;
                    }
                    if(sort  == '0'){
                        layer.msg('请选择分类');
						return false;
                    }
                    if(pic == ''){
                        layer.msg('请上传图片');
						return false;
                    }
                    if(content== ''){
                        layer.msg('内容不能为空');
						return false;
                    }
                    //end数据检查
                    
                    $.ajax({
						type : 'POST',
						data : {
							title      : title,
                            tag        : tag
						},
                        dataType : 'json',
						url      : 'news_do.php?act=add',
						success  : function(data){
                            var code = data.code;
							var msg  = data.msg;
							switch(code){
								case 1:
									layer.alert(msg, {icon: 6,shade: false}, function(index){
										location.href = 'news_list.php';
									});
									break;
								default:
									layer.alert(msg, {icon: 5});
							}
                        }
					});
                    
                });
                
			});
				
		</script>
	</head>
	<body>
		<div id="container">
			<div>新增</div>
            <div>
                <form action="/yiitest/helloworld/index.php/site/tagManage" method="post">
        			<p>
                        <label>标题</label>
                        <input name="title" type="text"/>
                        <span class="warn-inline">*</span>
                    </p>
        			<p>
                        <label>标签</label>
                        <input name="tag" type="text" />
                    </p>
        			<p>
        				<label>&nbsp;</label>
        				<input type="button" value="提　交" />
        			</p>
                </form>
			</div>
		</div>
	</body>
</html>