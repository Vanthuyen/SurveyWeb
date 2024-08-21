<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "Nguoidung".
 *
 * @property int $Userid
 * @property string $Username
 * @property string $Password
 * @property int $isAdmin
 */
class Nguoidung extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Nguoidung';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Username', 'Password'], 'required'],
            [['isAdmin'], 'integer'],
            [['Username'], 'string', 'max' => 50],
            [['Password'], 'string', 'max' => 255],
            [['Username'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Userid' => 'Userid',
            'Username' => 'Username',
            'Password' => 'Password',
            'isAdmin' => 'Is Admin',
        ];
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    public static function findByUsername($Username)
    {
        return static::findOne(['Username' => $Username]);
    }

    public function getId()
    {
        return $this->Userid;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->Password);
    }

    // Override beforeSave to hash the password before saving to the database
    // public function beforeSave($insert)
    // {
    //     if (parent::beforeSave($insert)) {
    //         if ($this->isNewRecord || $this->isAttributeChanged('Password')) {
    //             $this->Password = Yii::$app->security->generatePasswordHash($this->Password);
    //         }
    //         return true;
    //     }
    //     return false;
    // }
}
