<?php

use yii\db\Migration;

/**
 * Handles the creation of table `task_employee`.
 * Has foreign keys to the tables:
 *
 * - `task`
 * - `employee`
 */
class m180106_121334_create_junction_table_for_task_and_employee_tables extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('task_employee', [
            'task_id' => $this->integer(),
            'employee_id' => $this->integer(),
            'created_at' => $this->integer(),
            'status' => $this->integer(),
            'PRIMARY KEY(task_id, employee_id)',
        ]);

        // creates index for column `task_id`
        $this->createIndex(
            'idx-task_employee-task_id',
            'task_employee',
            'task_id'
        );

        // add foreign key for table `task`
        $this->addForeignKey(
            'fk-task_employee-task_id',
            'task_employee',
            'task_id',
            'task',
            'id',
            'CASCADE'
        );

        // creates index for column `employee_id`
        $this->createIndex(
            'idx-task_employee-employee_id',
            'task_employee',
            'employee_id'
        );

        // add foreign key for table `employee`
        $this->addForeignKey(
            'fk-task_employee-employee_id',
            'task_employee',
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
            'fk-task_employee-task_id',
            'task_employee'
        );

        // drops index for column `task_id`
        $this->dropIndex(
            'idx-task_employee-task_id',
            'task_employee'
        );

        // drops foreign key for table `employee`
        $this->dropForeignKey(
            'fk-task_employee-employee_id',
            'task_employee'
        );

        // drops index for column `employee_id`
        $this->dropIndex(
            'idx-task_employee-employee_id',
            'task_employee'
        );

        $this->dropTable('task_employee');
    }
}
