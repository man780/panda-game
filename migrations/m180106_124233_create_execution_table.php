<?php

use yii\db\Migration;

/**
 * Handles the creation of table `execution`.
 * Has foreign keys to the tables:
 *
 * - `task`
 * - `employee`
 * - `user`
 */
class m180106_124233_create_execution_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('execution', [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer()->notNull(),
            'employee_id' => $this->integer()->notNull(),
            'execution_time' => $this->integer(),
            'text' => $this->text(),
            'file' => $this->string(),
            'is_executed' => $this->integer(),
            'accepted_user' => $this->integer(),
        ]);

        // creates index for column `task_id`
        $this->createIndex(
            'idx-execution-task_id',
            'execution',
            'task_id'
        );

        // add foreign key for table `task`
        $this->addForeignKey(
            'fk-execution-task_id',
            'execution',
            'task_id',
            'task',
            'id',
            'CASCADE'
        );

        // creates index for column `employee_id`
        $this->createIndex(
            'idx-execution-employee_id',
            'execution',
            'employee_id'
        );

        // add foreign key for table `employee`
        $this->addForeignKey(
            'fk-execution-employee_id',
            'execution',
            'employee_id',
            'employee',
            'id',
            'CASCADE'
        );

        // creates index for column `accepted_user`
        $this->createIndex(
            'idx-execution-accepted_user',
            'execution',
            'accepted_user'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-execution-accepted_user',
            'execution',
            'accepted_user',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `task`
        $this->dropForeignKey(
            'fk-execution-task_id',
            'execution'
        );

        // drops index for column `task_id`
        $this->dropIndex(
            'idx-execution-task_id',
            'execution'
        );

        // drops foreign key for table `employee`
        $this->dropForeignKey(
            'fk-execution-employee_id',
            'execution'
        );

        // drops index for column `employee_id`
        $this->dropIndex(
            'idx-execution-employee_id',
            'execution'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-execution-accepted_user',
            'execution'
        );

        // drops index for column `accepted_user`
        $this->dropIndex(
            'idx-execution-accepted_user',
            'execution'
        );

        $this->dropTable('execution');
    }
}
