<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%converts}}`.
 */
class m200923_144556_create_converts_table extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'pgsql') {
//            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('converts', [
            'id' => $this->primaryKey(),
            'user_id' => $this->string()->notNull(),
            'name_out' => $this->string(50)->notNull(),
            'adress_out' => $this->string()->notNull(),
            'index_out' => $this->integer()->notNull(),
            'name_in' => $this->string(32)->notNull(),
            'adress_in' => $this->string()->notNull(),
            'index_in' => $this->integer()->notNull(),
            'num_convert' => $this->integer()->notNull(),
            'img_convert' => $this->text(),
            'letter' => $this->text(),
            'link' => $this->text()->notNull(),
            'src' => $this->text(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('converts');
    }
}
