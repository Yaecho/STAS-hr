<?php
namespace frontend\models;

use common\models\SignTableModel;
use yii\base\Model;

class SignTableForm extends Model
{

    public static function getList($cond1, $curPage = 1,$pageSize = 5, $orderBy = ['id' => SORT_DESC])
    {
        $model = new SignTableModel();
        //查询语句
        $select = ['id', 'rid', 'department', 'time'];
        $query = $model->find()
            ->select($select)
            ->where($cond1)
            ->with('resume')
            ->orderBy($orderBy);
        //获取分页数据
        $res = $model->getPages($query, $curPage, $pageSize);

        return $res;

    }
}