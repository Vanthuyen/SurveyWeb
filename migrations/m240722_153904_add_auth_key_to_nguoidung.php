<?php

use yii\db\Migration;

/**
 * Class m240722_153904_add_auth_key_to_nguoidung
 */
class m240722_153904_add_auth_key_to_nguoidung extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%Nguoidung}}', 'authKey', $this->string()->notNull()->defaultValue(''));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // echo "m240722_153904_add_auth_key_to_nguoidung cannot be reverted.\n";

        // return false;
        $this->dropColumn('{{%Nguoidung}}', 'authKey');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240722_153904_add_auth_key_to_nguoidung cannot be reverted.\n";

        return false;
    }
    */
}
