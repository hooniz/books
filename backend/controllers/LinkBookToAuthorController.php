<?php

namespace backend\controllers;

use backend\models\LinkBookToAuthor;
use backend\models\LinkBookToAuthorSearch;
use yii\db\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * LinkBookToAuthorController implements the CRUD actions for LinkBookToAuthor model.
 */
class LinkBookToAuthorController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors(): array
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all LinkBookToAuthor models.
     *
     * @return string
     */
    public function actionIndex(): string
    {
        $searchModel = new LinkBookToAuthorSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LinkBookToAuthor model.
     * @param int $book_id Book ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView(int $book_id): string
    {
        return $this->render('view', [
            'model' => $this->findModel($book_id),
        ]);
    }

    /**
     * Creates a new LinkBookToAuthor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|Response
     * @throws Exception
     */
    public function actionCreate(): Response|string
    {
        $model = new LinkBookToAuthor();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'book_id' => $model->book_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing LinkBookToAuthor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $book_id Book ID
     * @return string|Response
     * @throws NotFoundHttpException|Exception if the model cannot be found
     */
    public function actionUpdate(int $book_id): Response|string
    {
        $model = $this->findModel($book_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'book_id' => $model->book_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing LinkBookToAuthor model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $book_id Book ID
     * @return Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete(int $book_id): Response
    {
        $this->findModel($book_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the LinkBookToAuthor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $book_id Book ID
     * @return LinkBookToAuthor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $book_id): LinkBookToAuthor
    {
        if (! is_null($model = LinkBookToAuthor::findOne(['book_id' => $book_id]))) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
