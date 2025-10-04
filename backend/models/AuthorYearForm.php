<?php

namespace backend\models;

use yii\base\Model;

/**
 * AuthorYearForm is a model representing a form with a year field.
 *
 * @property string|null $year The year, defaulting to the current year if not set.
 */
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

    /**
     * Sets the year.
     *
     * @param ?string $year
     *
     * @return void
     */
    public function setYear(?string $year): void
    {
        $this->year = $year;
    }
}
