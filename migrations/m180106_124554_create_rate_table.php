<?php

use yii\db\Migration;

/**
 * Handles the creation of table `rate`.
 * Has foreign keys to the tables:
 *
 * - `task`
 * - `employee`
 */
class m180106_124554_create_rate_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('rate', [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer()->notNull(),
            'employee_id' => $this->integer()->notNull(),
            'rate' => $this->integer(),
        ]);

        // creates index for column `task_id`
        $this->createIndex(
            'idx-rate-task_id',
            'rate',
            'task_id'
        );

        // add foreign key for table `task`
        $this->addForeignKey(
            'fk-rate-task_id',
            'rate',
            'task_id',
            'task',
            'id',
            'CASCADE'
        );

        // creates index for column `employee_id`
        $this->createIndex(
            'idx-rate-employee_id',
            'rate',
            'employee_id'
        );

        // add foreign key for table `employee`
        $this->addForeignKey(
            'fk-rate-employee_id',
            'rate',
            'employee_id',
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
        // drops foreign key for table `task`
        $this->dropForeignKey(
            'fk-rate-task_id',
            'rate'
        );

        // drops index for column `task_id`
        $this->dropIndex(
            'idx-rate-task_id',
            'rate'
        );

        // drops foreign key for table `employee`
        $this->dropForeignKey(
            'fk-rate-employee_id',
            'rate'
        );

        // drops index for column `employee_id`
        $this->dropIndex(
            'idx-rate-employee_id',
            'rate'
        );

        $this->dropTable('rate');
    }
}
