<?php

namespace backend\models;

use yii\base\InvalidConfigException;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "author".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $middle_name
 * @property int $created_by
 * @property int $created_at
 * @property int $updated_by
 * @property int $updated_at
 * @property-read ?Book $books
 * @property-read ?string $fullName
 * @property-read int|null $subscribersCount
 * @property-read ActiveQuery $subscriptions
 */
class Author extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'author';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['first_name', 'last_name', 'middle_name', 'created_by'], 'required'],
            [['created_by'], 'integer'],
            [['first_name', 'last_name', 'middle_name'], 'string', 'max' => 50],
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

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'middle_name' => 'Middle Name',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Books]].
     *
     * @throws InvalidConfigException
     */
    public function getBooks(): ActiveQuery|null|Book
    {
        return $this->hasMany(Book::class, ['id' => 'book_id'])
            ->viaTable('link_book_to_author', ['author_id' => 'id']);
    }

    /**
     * Returns the author's full name in the format "Last Name First Name Middle Name".
     *
     * @return string
     */
    public function getFullName(): string
    {
        return sprintf("%s %s%s",
            $this->last_name,
            $this->first_name, $this->middle_name ? ' ' . $this->middle_name : ''
        );
    }

    /**
     * Gets query for [[Subscriptions]].
     *
     * @return ActiveQuery
     */
    public function getSubscriptions(): ActiveQuery
    {
        return $this->hasMany(Subscription::class, ['author_id' => 'id']);
    }

    /**
     * Returns the count of subscribers for the author.
     *
     * @return bool|int|string|null
     */
    public function getSubscribersCount(): bool|int|string|null
    {
        return $this->getSubscriptions()->count();
    }
}
