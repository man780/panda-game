<?php

use yii\db\Migration;

/**
 * Handles the creation of table `documents`.
 * Has foreign keys to the tables:
 *
 * - `employee`
 */
class m180106_115419_create_documents_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('documents', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'file_name' => $this->string(),
            'employee_id' => $this->integer()->notNull(),
            'created_time' => $this->integer(),
        ]);

        // creates index for column `employee_id`
        $this->createIndex(
            'idx-documents-employee_id',
            'documents',
            'employee_id'
        );

        // add foreign key for table `employee`
        $this->addForeignKey(
            'fk-documents-employee_id',
            'documents',
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
            'fk-documents-employee_id',
            'documents'
        );

        // drops index for column `employee_id`
        $this->dropIndex(
            'idx-documents-employee_id',
            'documents'
        );

        $this->dropTable('documents');
    }
}
