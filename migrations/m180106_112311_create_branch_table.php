<?php

use yii\db\Migration;

/**
 * Handles the creation of table `branch`.
 */
class m180106_112311_create_branch_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('branch', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'image' => $this->string()->notNull(),
            'dcreated' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('branch');
    }
}
