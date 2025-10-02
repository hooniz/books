<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\LinkBookToAuthor;

/**
 * LinkBookToAuthorSearch represents the model behind the search form of `backend\models\LinkBookToAuthor`.
 */
class LinkBookToAuthorSearch extends LinkBookToAuthor
{
    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['book_id'], 'integer'],
            [['author_id'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = LinkBookToAuthor::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        // grid filtering conditions
        $query->andFilterWhere([
            'book_id' => $this->book_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'author_id', $this->author_id]);

        return $dataProvider;
    }
}
