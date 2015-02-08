<?php
namespace Tph\Controller;
use Think\Controller;
class IndexController extends Controller {

    public function index(){
        $this->assign('tableNameList', getTableNameList());
        $this->assign('moduleNameList', getModuleNameList());
        $this->assign('dbNameList', getDbNameList());
        //        $this->assign('selectTableName',)
        $this->assign('db_prefix', C('DB_PREFIX'));
//

        $this->validation = (D('Home/Y')->getValidation());
//        var_dump($this->validation);
//        exit;
        $this->display();
    }

    /**
     * 只生成model
     */
    public function createModelFilesAction() {
        $tableNames = (array)I('tableName');
        $moduleName = I('moduleName');

        foreach($tableNames as $tableName) {
            \Think\Build::buildModel($moduleName, ucfirst(parse_name($tableName, 1)));
        }
    }


    /**
     * 根据数据库获取表列表
     */
    public function getTablesAction() {
        $this->ajaxReturn(getTableNameList(I('dbName')), 'JSON');
    }
}