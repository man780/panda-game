<?php

use yii\db\Migration;

/**
 * Handles the creation of table `employee_rate`.
 * Has foreign keys to the tables:
 *
 * - `employee`
 */
class m180106_125336_create_employee_rate_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('employee_rate', [
            'id' => $this->primaryKey(),
            'employee_id' => $this->integer()->notNull(),
            'rate' => $this->integer(),
            'current_rate' => $this->integer()->notNull(),
            'global_rate' => $this->integer()->notNull(),
        ]);

        // creates index for column `employee_id`
        $this->createIndex(
            'idx-employee_rate-employee_id',
            'employee_rate',
            'employee_id'
        );

        // add foreign key for table `employee`
        $this->addForeignKey(
            'fk-employee_rate-employee_id',
            'employee_rate',
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
        // drops foreign key for table `employee`
        $this->dropForeignKey(
            'fk-employee_rate-employee_id',
            'employee_rate'
        );

        // drops index for column `employee_id`
        $this->dropIndex(
            'idx-employee_rate-employee_id',
            'employee_rate'
        );

        $this->dropTable('employee_rate');
    }
}
