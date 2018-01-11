<?php

use yii\db\Migration;

/**
 * Handles the creation of table `invite`.
 */
class m180109_213348_create_invite_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('invite', [
            'id' => $this->primaryKey(),
            'fio' => $this->string(),
            'email' => $this->string(),
            'date_begin' => $this->string(),
            'invite_code' => $this->string(),
            'status' => $this->integer(),
            'dcreated' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('invite');
    }
}
