<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Users".
 *
 * @property int $id_user
 * @property string $user_name
 * @property string $password
 * @property string $name
 * @property string $email
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_name', 'password', 'name', 'email'], 'required','message'=>'Không dược bỏ trống'],
            [['user_name'], 'string', 'max' => 30],
            [['password'], 'string', 'max' => 20],
            [['name'], 'string', 'max' => 10],
            [['email'], 'string', 'max' => 50],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_user' => 'Id User',
            'user_name' => 'User Name',
            'password' => 'Password',
            'name' => 'Name',
            'email' => 'Email',
        ];
    }
    public function get_All_users(){
        return Users::find()->all();
    }
    public function get_Users($Uid){

        return Users::findOne($Uid);
        // return Users::find(['id'=>$Uid])->all();
    }

    public function Login($username,$password){
        $line = Users::find()-> where(['user_name'=>$username,'password'=>$password])->count();
        if($line ==1 ){
            return true;
        }else{
            return false;
        }
    }
}
