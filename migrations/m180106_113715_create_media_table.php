<?php

use yii\db\Migration;

/**
 * Handles the creation of table `media`.
 * Has foreign keys to the tables:
 *
 * - `employee`
 */
class m180106_113715_create_media_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('media', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'employee_id' => $this->integer()->notNull(),
            'created_time' => $this->integer(),
        ]);

        // creates index for column `employee_id`
        $this->createIndex(
            'idx-media-employee_id',
            'media',
            'employee_id'
        );

        // add foreign key for table `employee`
        $this->addForeignKey(
            'fk-media-employee_id',
            'media',
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
            'fk-media-employee_id',
            'media'
        );

        // drops index for column `employee_id`
        $this->dropIndex(
            'idx-media-employee_id',
            'media'
        );

        $this->dropTable('media');
    }
}
