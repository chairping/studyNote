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

    <script type="text/javascript">
    allPageUrl = '/index.php/Tph/Index/previewAllPage/';
    allPageCodeUrl = '/index.php/Tph/Index/allPageCode/';
    allCodeUrl = '/index.php/Tph/Index/allCode/';
    addPageUrl = '/index.php/Tph/Index/addPage/';
    addCodeUrl = '/index.php/Tph/Index/addCode/';
    editPageUrl = '/index.php/Tph/Index/editPage/';
    editCodeUrl = '/index.php/Tph/Index/editCode/';
    deleteCodeUrl = '/index.php/Tph/Index/deleteCode/';
</script>
<div class="container">
    <!-- modle -->
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Model</h3>
        </div>
        <div class="panel-body">

            <div class="row">
                <div class="col-md-10">
                    <form class="form-horizontal">
                        <!-- 模块 -->
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">选择模块</label>
                            <div class="col-lg-6">
                                <select class="form-control" id="moduleName">
                                    <?php foreach($moduleNameList as $moduleName): ?>
                                        <option value="<?php echo $moduleName;?>"><?php echo $moduleName;?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <!-- 数据库 -->
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">选择数据库</label>
                            <div class="col-lg-6">
                                <select class="form-control" id="dbName">
                                    <option value=""></option>
                                    <?php foreach($dbNameList as $dbName): ?>
                                    <option value="<?php echo $dbName;?>"><?php echo $dbName;?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <!-- 数据表 -->
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">数据表:</label>
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="checkbox" id="tabel_list">

                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" id="createFilesBtn" class="btn btn-primary">直接生成文件</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- end modle -->

    <!-- controller -->
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Controller</h3>
        </div>
        <div class="panel-body">

            <div class="row">
                <div class="col-md-10">
                    <form class="form-horizontal">
                        <!-- 模块 -->
                        <div class="form-group">
                            <label for="cModuleName" class="col-sm-2 control-label">选择模块</label>
                            <div class="col-lg-6">
                                <select class="form-control" id="cModuleName">
                                    <?php foreach($moduleNameList as $moduleName): ?>
                                    <option value="<?php echo $moduleName;?>"><?php echo $moduleName;?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>

                        <!-- 控制器 -->
                        <div class="form-group">
                            <label for="controller" class="col-sm-2 control-label">控制器</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="controller" placeholder="控制器名以，号隔开">
                            </div>
                        </div>

                    </form>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" id="cCreateFilesBtn" class="btn btn-primary">直接生成文件</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- end controller -->

    <!-- start service-->
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Controller</h3>
        </div>
        <div class="panel-body">

            <div class="row">
                <div class="col-md-10">
                    <form class="form-horizontal">
                        <!-- 模块 -->
                        <div class="form-group">
                            <label for="cModuleName" class="col-sm-2 control-label">选择模块</label>
                            <div class="col-lg-6">
                                <select class="form-control" id="cModuleName">
                                    <?php foreach($moduleNameList as $moduleName): ?>
                                    <option value="<?php echo $moduleName;?>"><?php echo $moduleName;?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>

                        <!-- 控制器 -->
                        <div class="form-group">
                            <label for="controller" class="col-sm-2 control-label">控制器</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="controller" placeholder="控制器名以，号隔开">
                            </div>
                        </div>

                    </form>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" id="cCreateFilesBtn" class="btn btn-primary">直接生成文件</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- end service-->

<!-- end container -->
</div>

<script>
    /*modle*/
    $(function(){
        $('#createFilesBtn').click(function() {
            moduleName = $('#moduleName option:selected').val();
            checkedBox = $('#tabel_list input:checked');

            selectTableName = [];
            checkedBox.each(function(){
                selectTableName.push($(this).val());
            });

            $.post("<?php echo U('Index/createModelFiles');?>", {"moduleName":moduleName,"tableName":selectTableName}, function(data){
            });
        });

        /*获取表列表*/
        $("#dbName").change(function(){
            var data = {};
            data.dbName = $(this).val();
            $.post("<?php echo U('Index/getTables');?>", data, function(result){
                var tables = '';

                $.each(result, function(index, val){
                    tables += ' <label><input type="checkbox" name="table" value="'+ val +'">&nbsp;'+ val +'</input></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                });

                $("#tabel_list").html(tables);
            }, 'json');
        });
    });

    /*controller*/
    $(function(){
        $('#cCreateFilesBtn').click(function() {
            moduleName = $('#cModuleName option:selected').val();
            checkedBox = $('#tabel_list input:checked');

            selectTableName = [];
            checkedBox.each(function(){
                selectTableName.push($(this).val());
            });

            $.post("<?php echo U('Index/createModelFiles');?>", {"moduleName":moduleName,"tableName":selectTableName}, function(data){
            });
        });
    });

</script>
<!-- Mainbar ends -->
<div class="clearfix"></div>
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