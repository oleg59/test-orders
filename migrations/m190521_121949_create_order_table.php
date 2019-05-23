<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order}}`.
 */
class m190521_121949_create_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'status_id' => $this->integer()->defaultValue(1),
            'payment_id' => $this->integer()->defaultValue(1),
            'delivery_id' => $this->integer()->defaultValue(1),
            'cart' => $this->text()->notNull(),
            'summ' => $this->integer()->defaultValue(0),
            'name' => $this->string()->notNull(),
            'phone' => $this->string()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%order}}');
    }
}
