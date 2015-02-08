<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <!-- Title and other stuffs -->
    <title>ThinkphpHelper V0.3.2 - for Thinkphp3.2.2</title>
    <meta name="keywords" content="ThinkphpHelper,Thinkphp代码自动生成" />
    <meta name="description" content="ThinkphpHelper,Thinkphp代码自动生成工具" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="sjj">
    <script src="./Application/Tph/Public/js/jquery.js"></script> <!-- jQuery -->

    <!-- Bootstrap start -->
    <script src="./Application/Tph/Public/bootstrap/js/bootstrap.min.js"></script>
    <link href="./Application/Tph/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./Application/Tph/Public/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
    <!-- Bootstrap end -->
</head>

<body>
<nav class="navbar navbar-inverse" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">
                <!--<img alt="Brand" src="...">-->
                Thinkphp代码生成器
            </a>
        </div>

        <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#">模块生成</a></li>
            <li><a href="#">Link</a></li>
        </ul>

    </div>
</nav>
<!-- Header starts -->
<header>
    <div class="container">
        <div class="row">

        </div>
    </div>
</header>

<div class="content">
    <div class="sidebar">
        <!--<div class="sidebar-dropdown"><a href="#">导航</a></div>-->
        <ul id="nav">
            <!--<li><a href="/index.php/Tph/CreateM"><i class="icon-bar-chart"></i>生成模块布局</a></li>-->
            <!--<li><a href="/index.php/Tph/CRUD/crud"><i class="icon-bar-chart"></i>生成CRUD代码</a></li>-->
            <!--<li><a href="/index.php/Tph/MCode"><i class="icon-table"></i>模型代码生成</a></li>-->
            <!--<li><a href="/index.php/Tph/Index/ui"><i class="icon-magic"></i>UI控件</a></li>-->
        </ul>
    </div>

    
<form id="hh">
    <?php foreach($validation as $val): ?>
        xx<input  validateJson='<?php echo json_encode($val);?>' />
    <?php endforeach;?>
</form>

<script>
    $(function(){
        $("#hh").FormValidate();
    });
    !function($){
        $.fn.FormValidate = function(){
            var _formObj = $(this);
            var check = true;
            var Form = {
                'EXISTS_VALIDATE': 0,
                'MUST_VALIDATE': 1,
                'VALUE_VALIDATE': 2,
                'data' : {},
                'input':function() {

                    var input =  _formObj.find(':input[type!=button]');
                    Form.validate(input);
                },
                'select':function() {

                },
                'checkbox':function() {

                },
                'validate': function(obj){
                    var name ='';
                    $.each(obj, function(){
                        var objValue = $(this).val();
                        var obj = $.parseJSON($(this).attr('validateJson'));
//                        alert(Array.isArray(obj));
                        if (Array.isArray(obj)) {
                            obj.forEach(function(value, index, arraySelf){
                                if (Array.isArray(value)) {
                                    alert(value.length);

                                } else {
                                    alert(arraySelf.length);
                                    return true;
                                    alert(value);
                                }
                            });
                        }

//                        alert(obj[0]);
//                        return false;
//                        $.each(obj, function(index, value){
//                            switch(index)
//                            {
//                                case 0:
//
//                                case 3:
//                                    if (value === $(this).VALUE_VALIDATE) {
//                                        if ($.trim(value) === '') {
//                                            break;
//                                        }
//                                    } else if(value === $(this).VALUE_VALIDATE ) {
//
//                                    }
//                                case 1:
//
//                                case 2:
//
//                                case 4:
//
//                                case 5:
//
//                                default :
//
//                            }
//                        });

                    });
                },

                'processer': function(){
                    Form.input();

//                    $(this).select();
//                    $(this).checkbox();
                },
                'submit':function(){

                }
            }

            Form.processer();

        }
    }(window.jQuery);
</script>
</div>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            </div>
        </div>
    </div>
</footer>
<span class="totop"><a href="#"><i class="icon-chevron-up"></i></a></span>
</body>
</html>