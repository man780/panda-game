<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product`.
 * Has foreign keys to the tables:
 *
 * - `user`
 */
class m180106_120457_create_product_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'cost' => $this->integer()->notNull(),
            'quantity' => $this->integer()->notNull(),
            'quantity_max' => $this->integer()->notNull(),
            'is_team' => $this->integer(),
            'image' => $this->string(),
            'created_user' => $this->integer()->notNull(),
            'created_time' => $this->integer(),
        ]);

        // creates index for column `created_user`
        $this->createIndex(
            'idx-product-created_user',
            'product',
            'created_user'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-product-created_user',
            'product',
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
            'fk-product-created_user',
            'product'
        );

        // drops index for column `created_user`
        $this->dropIndex(
            'idx-product-created_user',
            'product'
        );

        $this->dropTable('product');
    }
}
