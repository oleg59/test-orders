<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%status}}`.
 */
class m190521_123839_create_status_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%status}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
        ]);

        $this->insert('{{%status}}', [
            'title' => 'Принят'
        ]);
        $this->insert('{{%status}}', [
            'title' => 'Отправлен'
        ]);
        $this->insert('{{%status}}', [
            'title' => 'Выдан'
        ]);
        $this->insert('{{%status}}', [
            'title' => 'Возврат'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%status}}');
    }
}
