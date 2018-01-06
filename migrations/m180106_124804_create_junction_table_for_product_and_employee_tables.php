<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product_employee`.
 * Has foreign keys to the tables:
 *
 * - `product`
 * - `employee`
 */
class m180106_124804_create_junction_table_for_product_and_employee_tables extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('product_employee', [
            'product_id' => $this->integer(),
            'employee_id' => $this->integer(),
            'created_at' => $this->integer(),
            'PRIMARY KEY(product_id, employee_id)',
        ]);

        // creates index for column `product_id`
        $this->createIndex(
            'idx-product_employee-product_id',
            'product_employee',
            'product_id'
        );

        // add foreign key for table `product`
        $this->addForeignKey(
            'fk-product_employee-product_id',
            'product_employee',
            'product_id',
            'product',
            'id',
            'CASCADE'
        );

        // creates index for column `employee_id`
        $this->createIndex(
            'idx-product_employee-employee_id',
            'product_employee',
            'employee_id'
        );

        // add foreign key for table `employee`
        $this->addForeignKey(
            'fk-product_employee-employee_id',
            'product_employee',
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
            'fk-product_employee-product_id',
            'product_employee'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            'idx-product_employee-product_id',
            'product_employee'
        );

        // drops foreign key for table `employee`
        $this->dropForeignKey(
            'fk-product_employee-employee_id',
            'product_employee'
        );

        // drops index for column `employee_id`
        $this->dropIndex(
            'idx-product_employee-employee_id',
            'product_employee'
        );

        $this->dropTable('product_employee');
    }
}
