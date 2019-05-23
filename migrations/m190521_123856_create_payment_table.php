<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%payment}}`.
 */
class m190521_123856_create_payment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%payment}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
        ]);

        $this->insert('{{%payment}}', [
            'title' => 'Банковская карта'
        ]);
        $this->insert('{{%payment}}', [
            'title' => 'Яндекс деньги'
        ]);
        $this->insert('{{%payment}}', [
            'title' => 'Наличные'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%payment}}');
    }
}
