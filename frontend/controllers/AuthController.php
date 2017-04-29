<?php
namespace frontend\controllers;

use frontend\controllers\base\BaseController;
use Yii;
use yii\db\Query;

class AuthController extends BaseController
{
    public $authManager;

    public $enableCsrfValidation = false;
    /**
     * ---------------------------------------
     * 构造方法
     * ---------------------------------------
     */
    public function init(){
        parent::init();
        $this->authManager = Yii::$app->authManager;
    }

    public function actionIndex(){
        /* 获取角色列表 */
        $roles = Yii::$app->authManager->getRoles();
        return $this->render('index', [
            'roles' => $roles,
        ]);
    }

    /**
     * ---------------------------------------
     * 添加“角色”
     * 注意：角色表的“rule_name”字段必须为“NULL”，不然会出错。
     *      详情见“yii\rbac\BaseManager”的203行if($item->ruleName === null){return true;}
     * ---------------------------------------
     */
    public function actionAdd(){

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post('param');
            /* 创建角色 */
            $role = Yii::$app->authManager->createRole($data['name']);
            $role->type = 1;
            $role->description = $data['description'];
            if (Yii::$app->authManager->add($role)) {
                return $this->redirect(['auth/index']);
            }

        }

        return $this->render('add');
    }

    /**
     * ---------------------------------------
     * 编辑“角色”
     * 注意：角色表的“rule_name”字段必须为“NULL”，不然会出错。
     *      详情见“yii\rbac\BaseManager”的203行if($item->ruleName === null){return true;}
     * ---------------------------------------
     */
    public function actionEdit(){

        /* 获取角色信息 */
        $item_name = Yii::$app->request->get('role');
        $role = Yii::$app->authManager->getRole($item_name);

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post('param');
            $role->name = $data['name'];
            $role->description = $data['description'];
            if (Yii::$app->authManager-> update($item_name, $role)) {
                return $this->redirect(['auth/index']);
            }

        }

        return $this->render('edit',[
            'role' => $role,
        ]);
    }

    /**
     * ---------------------------------------
     * 删除“角色”
     * 同时会删除auth_assignment、auth_item_child、auth_item中关于$role的内容
     * @param string $role 角色名称
     * ---------------------------------------
     */
    public function actionDelete($role){
        $role = Yii::$app->authManager->getRole($role);
        if (Yii::$app->authManager->remove($role)) {
            return $this->redirect(['auth/index']);
        }
    }

    /**
     * ---------------------------------------
     * 角色授权
     * ---------------------------------------
     */
    public function actionAuth($role){

        /* 提交后 */
        if (Yii::$app->request->isPost) {
            $rules = Yii::$app->request->post('rules');
            $roles = Yii::$app->request->post('roles');
            /* 判断角色是否存在 */
            if (!$parent = Yii::$app->authManager->getRole($role)) {
                //$this->error('角色不存在');
            }
            /* 删除角色所有child */
            Yii::$app->authManager->removeChildren($parent);

            if (is_array($rules)) {
                foreach ($rules as $rule) {
                    //$parent = $auth->createRole($items['role']);
                    $child = Yii::$app->authManager->getPermission($rule);
                    Yii::$app->authManager->addChild($parent, $child);
                }
            }
            if (is_array($roles)) {
                foreach ($roles as $role) {
                    $child = Yii::$app->authManager->getRole($role);
                    Yii::$app->authManager->addChild($parent, $child);
                }
            }
            return $this->redirect(['auth/index']);
        }

        $node_list  = (new Query())
            ->select(['name','description','type'])
            ->from('auth_item')
            ->all();

        $auth_rules = Yii::$app->authManager->getChildren($role);
        $auth_rules = array_keys($auth_rules);


        return $this->render('auth',[
            'node_list' => $node_list,
            'auth_rules' => $auth_rules,
            'role' => $role,
        ]);
    }

    /**
     * ---------------------------------------
     * 授权用户列表
     * ---------------------------------------
     */
    public function actionUser($role){

        $uids = Yii::$app->authManager->getUserIdsByRole($role);

        $users = (new Query())
            ->select(['username','truename','department'])
            ->from('user')
            ->where(['id' => $uids])
            ->all();

        return $this->render('user',[
            'users' => $users,
        ]);
    }
}