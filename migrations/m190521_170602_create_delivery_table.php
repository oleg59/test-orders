<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%delivery}}`.
 */
class m190521_170602_create_delivery_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%delivery}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
        ]);

        $this->insert('{{%delivery}}', [
            'title' => 'Курьер'
        ]);
        $this->insert('{{%delivery}}', [
            'title' => 'Почта'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%delivery}}');
    }
}
