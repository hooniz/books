<?php

namespace backend\models;

use yii\base\Model;

class AuthorYearForm extends Model
{
    public $year;

    public function rules(): array
    {
        return [
            ['year', 'safe'],
        ];
    }

    /**
     * Gets the year, defaulting to the current year if not set.
     *
     * @return string|null
     */
    public function getYear(): ?string
    {
        return $this->year ?? date('Y');
    }
}
