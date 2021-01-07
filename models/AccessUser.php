<?php


namespace app\models;
use yii\base\Model;

class AccessUser extends Model
{


    public function resetStatus($token)
    {
        $user = User::find()->where(['auth_key' => $token])->one();
        if (!empty($user)) {
            $user->status = USER::STATUS_ACTIVE;
            $user->save();
            return true;
        }
        else return false;
    }



}