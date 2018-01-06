<?php

use yii\db\Migration;

/**
 * Handles the creation of table `task`.
 * Has foreign keys to the tables:
 *
 * - `employee`
 */
class m180106_120006_create_task_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('task', [
            'id' => $this->primaryKey(),
            'text' => $this->text()->notNull(),
            'deadline' => $this->integer(),
            'reward' => $this->integer()->notNull(),
            'created_user' => $this->integer()->notNull(),
            'created_time' => $this->integer(),
        ]);

        // creates index for column `created_user`
        $this->createIndex(
            'idx-task-created_user',
            'task',
            'created_user'
        );

        // add foreign key for table `employee`
        $this->addForeignKey(
            'fk-task-created_user',
            'task',
            'created_user',
            'employee',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `employee`
        $this->dropForeignKey(
            'fk-task-created_user',
            'task'
        );

        // drops index for column `created_user`
        $this->dropIndex(
            'idx-task-created_user',
            'task'
        );

        $this->dropTable('task');
    }
}
