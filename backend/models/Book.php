<?php

namespace backend\models;

use backend\components\behaviors\UserEmployeeBehavior;
use Yii;
use yii\base\InvalidConfigException;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Exception;
use yii\web\UploadedFile;

/**
 * This is the model class for table "book".
 *
 * @property int $id
 * @property string $title
 * @property int $year
 * @property string|null $description
 * @property string|null $isbn
 * @property string|null $file_id
 * @property int $created_by
 * @property int $created_at
 * @property int $updated_by
 * @property int $updated_at
 */
class Book extends ActiveRecord
{
    /** @var UploadedFile */
    public $coverFile;
    public $authorIds = [];

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'book';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['description', 'isbn', 'file_id'], 'default', 'value' => null],
            [['title', 'year'], 'required'],
            [['year'], 'integer'],
            [['description'], 'string'],
            [['title', 'file_id'], 'string', 'max' => 255],
            [['isbn'], 'string', 'max' => 20],
            [['coverFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
            [['authorIds'], 'each', 'rule' => ['integer']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'year' => 'Year',
            'description' => 'Description',
            'isbn' => 'Isbn',
            'file_id' => 'File ID',
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

    /**
     * @throws InvalidConfigException
     */
    public function getAuthors(): ActiveQuery
    {
        return $this->hasMany(Author::class, ['id' => 'author_id'])
            ->viaTable('link_book_to_author', ['book_id' => 'id'])->limit(10);
    }

    /**
     * @throws Exception
     */
    public function uploadFile()
    {
        if ($this->coverFile) {
            $filePath = 'uploads/' . uniqid('', true) . '.' . $this->coverFile->extension;
            if ($this->coverFile->saveAs($filePath)) {

                // сохраняем файл в таблицу file
                $file = new File([
                    'name' => $this->coverFile->name,
                    'path' => $filePath,
                    'type' => $this->coverFile->type,
                    'size' => $this->coverFile->size,
                ]);
                if ($file->save()) {
                    $this->file_id = $file->id;
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * @throws Exception
     */
    public function afterSave($insert, $changedAttributes): void
    {
        parent::afterSave($insert, $changedAttributes);

        // обновляем авторов
        LinkBookToAuthor::deleteAll(['book_id' => $this->id]);
        if (!empty($this->authorIds)) {
            foreach ($this->authorIds as $authorId) {
                $ba = new LinkBookToAuthor();
                $ba->book_id = $this->id;
                $ba->author_id = $authorId;
                $ba->save();
            }
        }
    }

    public function getFile(): ActiveQuery
    {
        return $this->hasOne(File::class, ['id' => 'file_id']);
    }

    public function getCoverUrl(): ?string
    {
        return $this->file ? Yii::getAlias('@web/') . $this->file->path : null;
    }

}
