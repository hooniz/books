<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%file}}`.
 */
class m251002_082608_create_file_table extends Migration
{
    private const string TABLE = '{{%file}}';

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
                'name' => $this->string(255)->notNull(),
                'path' => $this->string(255)->notNull(),
                'type' => $this->string(50),
                'size' => $this->integer(),
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
