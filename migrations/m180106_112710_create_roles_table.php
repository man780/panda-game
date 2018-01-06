<?php

use yii\db\Migration;

/**
 * Handles the creation of table `roles`.
 */
class m180106_112710_create_roles_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('roles', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'priority' => $this->integer()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('roles');
    }
}
