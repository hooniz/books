<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book}}`.
 */
class m251002_082149_create_book_table extends Migration
{
    private const string TABLE = '{{%book}}';

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
                'title' => $this->string()->notNull(),
                'year' => $this->integer(4)->notNull(),
                'description' => $this->text(),
                'isbn' => $this->string(20),
                'file_id' => $this->string(255),
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
