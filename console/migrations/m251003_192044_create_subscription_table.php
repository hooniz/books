<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%subscription}}`.
 */
class m251003_192044_create_subscription_table extends Migration
{
    private const string TABLE = '{{%subscription}}';

    /**
     * Safe up
     *
     * @return void
     */
    public function safeUp(): void
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE=utf8mb4_unicode_520_ci ENGINE=InnoDB';
        }

        $this->createTable(
            self::TABLE,
            [
                'id' => $this->primaryKey(),
                'user_id' => $this->integer()->notNull(),
                'author_id' => $this->integer()->notNull(),
                'created_by' => $this->integer()->notNull(),
                'created_at' => $this->integer()->notNull(),
                'updated_by' => $this->integer()->notNull(),
                'updated_at' => $this->integer()->notNull(),
            ],
            $tableOptions
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropTable(self::TABLE);
    }
}
