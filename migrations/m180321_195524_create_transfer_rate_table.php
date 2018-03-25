<?php

use yii\db\Migration;

/**
 * Handles the creation of table `transfer_rate`.
 * Has foreign keys to the tables:
 *
 * - `employee`
 * - `employee`
 */
class m180321_195524_create_transfer_rate_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('transfer_rate', [
            'id' => $this->primaryKey(),
            'from_employee' => $this->integer()->notNull(),
            'to_employee' => $this->integer()->notNull(),
            'created_time' => $this->datetime(),
        ]);

        // creates index for column `from_employee`
        $this->createIndex(
            'idx-transfer_rate-from_employee',
            'transfer_rate',
            'from_employee'
        );

        // add foreign key for table `employee`
        $this->addForeignKey(
            'fk-transfer_rate-from_employee',
            'transfer_rate',
            'from_employee',
            'employee',
            'id',
            'CASCADE'
        );

        // creates index for column `to_employee`
        $this->createIndex(
            'idx-transfer_rate-to_employee',
            'transfer_rate',
            'to_employee'
        );

        // add foreign key for table `employee`
        $this->addForeignKey(
            'fk-transfer_rate-to_employee',
            'transfer_rate',
            'to_employee',
            'employee',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `employee`
        $this->dropForeignKey(
            'fk-transfer_rate-from_employee',
            'transfer_rate'
        );

        // drops index for column `from_employee`
        $this->dropIndex(
            'idx-transfer_rate-from_employee',
            'transfer_rate'
        );

        // drops foreign key for table `employee`
        $this->dropForeignKey(
            'fk-transfer_rate-to_employee',
            'transfer_rate'
        );

        // drops index for column `to_employee`
        $this->dropIndex(
            'idx-transfer_rate-to_employee',
            'transfer_rate'
        );

        $this->dropTable('transfer_rate');
    }
}
