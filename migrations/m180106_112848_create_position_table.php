<?php

use yii\db\Migration;

/**
 * Handles the creation of table `position`.
 * Has foreign keys to the tables:
 *
 * - `branch`
 */
class m180106_112848_create_position_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('position', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'branch_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `branch_id`
        $this->createIndex(
            'idx-position-branch_id',
            'position',
            'branch_id'
        );

        // add foreign key for table `branch`
        $this->addForeignKey(
            'fk-position-branch_id',
            'position',
            'branch_id',
            'branch',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `branch`
        $this->dropForeignKey(
            'fk-position-branch_id',
            'position'
        );

        // drops index for column `branch_id`
        $this->dropIndex(
            'idx-position-branch_id',
            'position'
        );

        $this->dropTable('position');
    }
}
