<?php

use yii\db\Migration;

/**
 * Handles the creation of table `achievements`.
 * Has foreign keys to the tables:
 *
 * - `user`
 */
class m180106_114355_create_achievements_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('achievements', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'reward' => $this->integer()->notNull(),
            'status_achievement' => $this->string()->notNull(),
            'image' => $this->string(),
            'created_user' => $this->integer()->notNull(),
            'created_time' => $this->integer(),
        ]);

        // creates index for column `created_user`
        $this->createIndex(
            'idx-achievements-created_user',
            'achievements',
            'created_user'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-achievements-created_user',
            'achievements',
            'created_user',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-achievements-created_user',
            'achievements'
        );

        // drops index for column `created_user`
        $this->dropIndex(
            'idx-achievements-created_user',
            'achievements'
        );

        $this->dropTable('achievements');
    }
}
