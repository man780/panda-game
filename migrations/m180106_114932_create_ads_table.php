<?php

use yii\db\Migration;

/**
 * Handles the creation of table `ads`.
 * Has foreign keys to the tables:
 *
 * - `user`
 */
class m180106_114932_create_ads_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('ads', [
            'id' => $this->primaryKey(),
            'full_text' => $this->text(),
            'created_user' => $this->integer()->notNull(),
            'created_time' => $this->integer(),
        ]);

        // creates index for column `created_user`
        $this->createIndex(
            'idx-ads-created_user',
            'ads',
            'created_user'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-ads-created_user',
            'ads',
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
            'fk-ads-created_user',
            'ads'
        );

        // drops index for column `created_user`
        $this->dropIndex(
            'idx-ads-created_user',
            'ads'
        );

        $this->dropTable('ads');
    }
}
