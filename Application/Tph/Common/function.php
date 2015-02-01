<?php

//获取表名列表
function getTableNameList($dbName){
    // 实例化一个model对象 没有对应任何数据表
    $Model = M();
    $result = Array();
    $tempArray = $Model->query(
        "select table_name from information_schema.tables where table_schema='".$dbName."' and table_type='base table'"
    );

    foreach($tempArray as $temp){
        $result[] = $temp['table_name'];
    }
    return $result;
}

// 获取数据库列表
function getDbNameList() {
    $Model = M();
    $result = Array();
    $tempArray = $Model->query(
        "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA"
    );

    foreach($tempArray as $temp){
        if (in_array($temp['schema_name'], ['information_schema', 'employees'], ['mysql'], 'performance_schema')) continue;
        $result[] = $temp['schema_name'];
    }
    return $result;
}

//读取项目目录下的文件夹，供用户选择哪个才是module目录
function getModuleNameList(){
    $notModuleDirs = ['Common', 'Runtime', 'Tph'];
    $dirs = array();
    try {
        // spl标准库的目录遍历
        $dir = new \DirectoryIterator(APP_PATH);
    } catch (Exception $e) {
        throw new Exception(APP_PATH . ' is not readable');
    }
    foreach($dir as $file) {
        if($file->isDot()) continue;
        if($file->isFile()) continue;
        $dirs[] = $file->getFileName();
    }
    // 返回两个数组的差集
    $dirs = array_diff($dirs, $notModuleDirs); //var_dump($dirs);
    return $dirs;
}

