<?php

use yii\db\Migration;

/**
 * Handles the creation of table `employee`.
 * Has foreign keys to the tables:
 *
 * - `user`
 * - `team`
 * - `branch`
 * - `position`
 * - `roles`
 */
class m180106_113447_create_employee_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('employee', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'fname' => $this->string()->notNull(),
            'oname' => $this->string(),
            'about' => $this->text(),
            'avatar' => $this->string(),
            'phone' => $this->string(),
            'email' => $this->string(),
            'skype' => $this->string(),
            'birthday' => $this->integer(),
            'team_id' => $this->integer()->notNull(),
            'branch_id' => $this->integer()->notNull(),
            'position_id' => $this->integer()->notNull(),
            'role_id' => $this->integer()->notNull(),
            'join_date' => $this->integer(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-employee-user_id',
            'employee',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-employee-user_id',
            'employee',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `team_id`
        $this->createIndex(
            'idx-employee-team_id',
            'employee',
            'team_id'
        );

        // add foreign key for table `team`
        $this->addForeignKey(
            'fk-employee-team_id',
            'employee',
            'team_id',
            'team',
            'id',
            'CASCADE'
        );

        // creates index for column `branch_id`
        $this->createIndex(
            'idx-employee-branch_id',
            'employee',
            'branch_id'
        );

        // add foreign key for table `branch`
        $this->addForeignKey(
            'fk-employee-branch_id',
            'employee',
            'branch_id',
            'branch',
            'id',
            'CASCADE'
        );

        // creates index for column `position_id`
        $this->createIndex(
            'idx-employee-position_id',
            'employee',
            'position_id'
        );

        // add foreign key for table `position`
        $this->addForeignKey(
            'fk-employee-position_id',
            'employee',
            'position_id',
            'position',
            'id',
            'CASCADE'
        );

        // creates index for column `role_id`
        $this->createIndex(
            'idx-employee-role_id',
            'employee',
            'role_id'
        );

        // add foreign key for table `roles`
        $this->addForeignKey(
            'fk-employee-role_id',
            'employee',
            'role_id',
            'roles',
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
            'fk-employee-user_id',
            'employee'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-employee-user_id',
            'employee'
        );

        // drops foreign key for table `team`
        $this->dropForeignKey(
            'fk-employee-team_id',
            'employee'
        );

        // drops index for column `team_id`
        $this->dropIndex(
            'idx-employee-team_id',
            'employee'
        );

        // drops foreign key for table `branch`
        $this->dropForeignKey(
            'fk-employee-branch_id',
            'employee'
        );

        // drops index for column `branch_id`
        $this->dropIndex(
            'idx-employee-branch_id',
            'employee'
        );

        // drops foreign key for table `position`
        $this->dropForeignKey(
            'fk-employee-position_id',
            'employee'
        );

        // drops index for column `position_id`
        $this->dropIndex(
            'idx-employee-position_id',
            'employee'
        );

        // drops foreign key for table `roles`
        $this->dropForeignKey(
            'fk-employee-role_id',
            'employee'
        );

        // drops index for column `role_id`
        $this->dropIndex(
            'idx-employee-role_id',
            'employee'
        );

        $this->dropTable('employee');
    }
}
