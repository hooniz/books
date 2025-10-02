<?php

namespace backend\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "link_book_to_author".
 *
 * @property int $book_id
 * @property string $author_id
 * @property int $created_by
 * @property int $created_at
 * @property int $updated_by
 * @property int $updated_at
 */
class LinkBookToAuthor extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'link_book_to_author';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author_id'], 'required'],
            [['created_by', ], 'integer'],
            [['author_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'book_id' => 'Book ID',
            'author_id' => 'Author ID',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function behaviors(): array
    {
        return [
            TimestampBehavior::class,
            [
                'class' => BlameableBehavior::class,
                'defaultValue' => -1
            ],
        ];
    }
}
