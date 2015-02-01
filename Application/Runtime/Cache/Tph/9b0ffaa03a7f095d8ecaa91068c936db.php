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
    allPageUrl = '/index.php/Tph/CRUD/previewAllPage/';
    allPageCodeUrl = '/index.php/Tph/CRUD/allPageCode/';
    allCodeUrl = '/index.php/Tph/CRUD/allCode/';
    addPageUrl = '/index.php/Tph/CRUD/addPage/';
    addCodeUrl = '/index.php/Tph/CRUD/addCode/';
    editPageUrl = '/index.php/Tph/CRUD/editPage/';
    editCodeUrl = '/index.php/Tph/CRUD/editCode/';
    deleteCodeUrl = '/index.php/Tph/CRUD/deleteCode/';


</script>
<div class="mainbar">
    <!-- Page heading -->
    <div class="page-head">
        <h2 class="pull-left"><i class="icon-home"></i> 生成CRUD代码</h2>
        <div class="clearfix"></div>
    </div>
    <!-- Page heading ends -->
    <!-- Matter -->
    <div class="matter">
        <div class="container">
            <!-- Dashboard Graph starts -->
            <div class="row">
                <div class="col-md-6">

                    <div class="widget">

                        <div class="widget-head">
                            <div class="pull-left">直接生成文件</div>
                            <div class="widget-icons pull-right">
                                <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a>
                                <a href="#" class="wclose"><i class="icon-remove"></i></a>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="widget-content">
                            <div class="padd">
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <label class="control-label col-lg-3" for="title">选择模块</label>
                                        <div class="col-lg-6">
                                            <select class="form-control" id="moduleName">
                                                <?php if(is_array($moduleNameList)): $i = 0; $__LIST__ = $moduleNameList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$moduleName): $mod = ($i % 2 );++$i;?><option value="<?php echo ($moduleName); ?>"><?php echo ($moduleName); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- 数据表 -->
                                    <div class="form-group" id="selectTables">
                                        <label class="control-label col-lg-3">数据表:</label>
                                        <div class="col-lg-9">
                                            <?php if(is_array($tableNameList)): $i = 0; $__LIST__ = $tableNameList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$table): $mod = ($i % 2 );++$i;?><input type="checkbox" name="table" value="<?php echo ($table); ?>"><?php echo ($table); ?></input><br><?php endforeach; endif; else: echo "" ;endif; ?>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Widget footer -->
                        <div class="widget-foot">
                            <button type="button" id="createFilesBtn" class="btn btn-primary">直接生成文件</button>
                        </div>
                        <!-- Widget footer end-->
                        <div class="widget-foot" id="fileMsg"></div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="widget">
                        <div class="widget-head">
                            <div class="pull-left" height="80">
                                手动生成
                            </div>
                            <div class="widget-icons pull-right">
                                <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a>
                                <a href="#" class="wclose"><i class="icon-remove"></i></a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="widget-content" >
                            <div class="padd">
                                <div class="form quick-post">
                                    <!-- Edit profile form (not working)-->
                                    <div class="form-horizontal">
                                        <!-- Table -->
                                        <div class="form-group">
                                            <label class="control-label col-lg-3">数据表:</label>
                                            <div class="col-lg-9">
                                                <select class="form-control" id="tables">
                                                    <?php if(is_array($tableNameList)): $i = 0; $__LIST__ = $tableNameList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$table): $mod = ($i % 2 );++$i;?><option value="<?php echo ($table); ?>" ><?php echo ($table); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <label class="control-label col-lg-1" for="title">生成带分页代码</label>
                                        <div class="col-lg-3">
                                            <input type="checkbox" id="isPage" checked />
                                        </div>
                                        <!-- Buttons -->
                                        <div class="form-group">
                                            <!-- Buttons -->
                                            <div class="col-lg-offset-2 col-lg-9">
                                                <button class="btn btn-success" id="gogogo">生成</button>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--end  paddad-->

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">

                    <!-- Widget -->
                    <div class="widget">
                        <!-- Widget head -->
                        <div class="widget-head">
                            <div class="pull-left">
                                所有列表预览(填充示例数据)
                            </div>
                            <div class="widget-icons pull-right">
                                <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a>
                                <a href="#" class="wclose"><i class="icon-remove"></i></a>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <!-- Widget content -->
                        <div class="widget-content">
                            <div class="padd">
                                <div id="allPage">(暂无)</div>

                                <ul class="pagination pull-right" id="pagination">
                                    <li><a href="#">上一页</a></li>
                                    <li><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#">下一页</a></li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <!-- Widget ends -->

                    </div>
                </div>
            </div>
            <!-- all part1 ends -->

            <div class="row">
                <div class="col-md-6">

                    <div class="widget">

                        <div class="widget-head">
                            <div class="pull-left">所有记录列表View代码</div>
                            <div class="widget-icons pull-right">
                                <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a>
                                <a href="#" class="wclose"><i class="icon-remove"></i></a>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="widget-content">
                            <div class="padd">
                    <textarea class="form-control" id="allPageCode" rows="12">	
					</textarea>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-6">

                    <div class="widget">

                        <div class="widget-head">
                            <div class="pull-left">所有记录列表Controller代码</div>
                            <div class="widget-icons pull-right">
                                <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a>
                                <a href="#" class="wclose"><i class="icon-remove"></i></a>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="widget-content">
                            <div class="padd">
                    <textarea class="form-control" id="allCode" rows="12">	
					</textarea>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <!-- all parts ends -->

            <!-- Chats, File upload and Recent Comments -->
            <div class="row">
                <div class="col-md-4">
                    <div class="widget">
                        <!-- Widget title -->
                        <div class="widget-head">
                            <div class="pull-left">新建-效果预览</div>
                            <div class="widget-icons pull-right">
                                <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a>
                                <a href="#" class="wclose"><i class="icon-remove"></i></a>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="widget-content">
                            <div class="padd">
                                <div class="form quick-post"  id="addPage"></div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="widget">
                        <!-- Widget title -->
                        <div class="widget-head">
                            <div class="pull-left">新建-View代码</div>
                            <div class="widget-icons pull-right">
                                <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a>
                                <a href="#" class="wclose"><i class="icon-remove"></i></a>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="widget-content" >
					<textarea class="form-control" id="addPageCode" rows="12">	
					</textarea>
                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="widget">
                        <!-- Widget title -->
                        <div class="widget-head">
                            <div class="pull-left">新建-Controller代码</div>
                            <div class="widget-icons pull-right">
                                <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a>
                                <a href="#" class="wclose"><i class="icon-remove"></i></a>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="widget-content" >
                  <textarea class="form-control" id="addCode" rows="12">	
					</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <!--end add part-->


            <div class="row">
                <div class="col-md-4">
                    <div class="widget">
                        <!-- Widget title -->
                        <div class="widget-head">
                            <div class="pull-left">编辑-效果预览</div>
                            <div class="widget-icons pull-right">
                                <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a>
                                <a href="#" class="wclose"><i class="icon-remove"></i></a>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="widget-content">
                            <div class="padd">
                                <div class="form quick-post"  id="editPage"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="widget">
                        <!-- Widget title -->
                        <div class="widget-head">
                            <div class="pull-left">编辑View代码</div>
                            <div class="widget-icons pull-right">
                                <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a>
                                <a href="#" class="wclose"><i class="icon-remove"></i></a>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="widget-content" >
					<textarea class="form-control" id="editPageCode" rows="12">	
					</textarea>
                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="widget">
                        <!-- Widget title -->
                        <div class="widget-head">
                            <div class="pull-left">编辑-Controller代码</div>
                            <div class="widget-icons pull-right">
                                <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a>
                                <a href="#" class="wclose"><i class="icon-remove"></i></a>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="widget-content" >
                  <textarea class="form-control" id="editCode" rows="12">	
					</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <!--end edit part-->


            <div class="row">
                <div class="col-md-6">
                    <div class="widget">
                        <!-- Widget title -->
                        <div class="widget-head">
                            <div class="pull-left">删除-Controller代码</div>
                            <div class="widget-icons pull-right">
                                <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a>
                                <a href="#" class="wclose"><i class="icon-remove"></i></a>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="widget-content" >
                  <textarea class="form-control" id="deleteCode" rows="12">	
					</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <!--end delete part2-->
        </div>
    </div>

    <!-- Matter ends -->

</div>
<script>
    function createModelFiles(moduleName, selectTableName){
        $.post("<?php echo U('CRUD/createModelFiles');?>", {"moduleName":moduleName,"tableName":selectTableName}, function(data){
//            $('#fileMsg').html(data);
//            alert('sdf');
        });
    }

    $(function(){
        $('#createFilesBtn').click(function() {
            moduleName = $('#moduleName option:selected').val();
            checkedBox = $('#selectTables input:checked');

            selectTableName = [];
            checkedBox.each(function(){
                selectTableName.push($(this).val());
            });

            createFiles(moduleName, selectTableName);
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