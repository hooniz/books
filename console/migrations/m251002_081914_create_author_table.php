<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%author}}`.
 */
class m251002_081914_create_author_table extends Migration
{
    private const string TABLE = '{{%author}}';

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
                'first_name' => $this->string(50)->notNull(),
                'last_name' => $this->string(50)->notNull(),
                'middle_name' => $this->string(50)->notNull(),
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
