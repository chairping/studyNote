<?php

namespace Tph\Controller;
use Think\Controller;

class CRUDController extends Controller {
    public function curdAction() {
        $this->assign('tableNameList', getTableNameList());
        $this->assign('moduleNameList', getModuleNameList());
//        $this->assign('selectTableName',)
        $this->assign('db_prefix', C('DB_PREFIX'));
        $this->display();
    }

    public function getPageAction($tableName) {
        $Model = M($tableName);
        $map = ['status' => 1];
        $count = $Model->where($map)->count();
        $page = new \Tph\Common\Util\Page($count, 25);
        $show = $page->show();

        $list = $Model->where($map)->order('create_time')->limit($page->firstRow . ',' . $page->listRows)->select();
        $this->assign('list', $list);
        $this->assign('page', $show);
    }

    /**
     * 只生成model
     */
    public function createModelFilesAction() {
        $tableNames = (array)I('tableName');
        $moduleName = I('moduleName');

        foreach($tableNames as $tableName) {
            \Think\Build::buildModel($moduleName, $tableName);
        }
//        $controllerPath = APP_PATH .
//        foreach ($tableName) {
//
//        }

    }

}