<?php

use yii\db\Migration;

/**
 * Handles the creation of table `team`.
 * Has foreign keys to the tables:
 *
 * - `branch`
 */
class m180106_112412_create_team_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('team', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'branch_id' => $this->integer()->notNull(),
            'image' => $this->string()->notNull(),
            'dcreated' => $this->integer(),

        ]);

        // creates index for column `branch_id`
        $this->createIndex(
            'idx-team-branch_id',
            'team',
            'branch_id'
        );

        // add foreign key for table `branch`
        $this->addForeignKey(
            'fk-team-branch_id',
            'team',
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
            'fk-team-branch_id',
            'team'
        );

        // drops index for column `branch_id`
        $this->dropIndex(
            'idx-team-branch_id',
            'team'
        );

        $this->dropTable('team');
    }
}
