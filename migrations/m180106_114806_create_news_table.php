<?php

use yii\db\Migration;

/**
 * Handles the creation of table `news`.
 * Has foreign keys to the tables:
 *
 * - `user`
 */
class m180106_114806_create_news_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('news', [
            'id' => $this->primaryKey(),
            'image' => $this->string(),
            'title' => $this->string()->notNull(),
            'description' => $this->string(),
            'full_text' => $this->text(),
            'created_user' => $this->integer()->notNull(),
            'created_time' => $this->integer(),
        ]);

        // creates index for column `created_user`
        $this->createIndex(
            'idx-news-created_user',
            'news',
            'created_user'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-news-created_user',
            'news',
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
            'fk-news-created_user',
            'news'
        );

        // drops index for column `created_user`
        $this->dropIndex(
            'idx-news-created_user',
            'news'
        );

        $this->dropTable('news');
    }
}
