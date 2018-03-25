<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product_employee`.
 * Has foreign keys to the tables:
 *
 * - `product`
 * - `employee`
 */
class m180106_124805_create_junction_table_for_achievements_and_employee_tables extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('achievements_employee', [
            'achievement_id' => $this->integer(),
            'employee_id' => $this->integer(),
            'created_at' => $this->integer(),
            'PRIMARY KEY(achievement_id, employee_id)',
        ]);

        // creates index for column `product_id`
        $this->createIndex(
            'idx-achievements_employee-achievement_id',
            'achievements_employee',
            'achievement_id'
        );

        // add foreign key for table `product`
        $this->addForeignKey(
            'fk-achievements_employee-achievement_id',
            'achievements_employee',
            'achievement_id',
            'achievements',
            'id',
            'CASCADE'
        );

        // creates index for column `employee_id`
        $this->createIndex(
            'idx-achievements_employee-employee_id',
            'achievements_employee',
            'employee_id'
        );

        // add foreign key for table `employee`
        $this->addForeignKey(
            'fk-achievements_employee-employee_id',
            'achievements_employee',
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
        // drops foreign key for table `product`
        $this->dropForeignKey(
            'fk-achievements_employee-product_id',
            'achievements_employee'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            'idx-achievements_employee-product_id',
            'achievements_employee'
        );

        // drops foreign key for table `employee`
        $this->dropForeignKey(
            'fk-achievements_employee-employee_id',
            'achievements_employee'
        );

        // drops index for column `employee_id`
        $this->dropIndex(
            'idx-achievements_employee-employee_id',
            'achievements_employee'
        );

        $this->dropTable('achievements_employee');
    }
}
