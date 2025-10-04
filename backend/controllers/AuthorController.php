<?php

namespace backend\controllers;

use backend\models\Author;
use backend\models\AuthorSearch;
use backend\models\AuthorYearForm;
use backend\models\Subscription;
use Throwable;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\db\StaleObjectException;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * AuthorController implements the CRUD actions for Author model.
 */
class AuthorController extends Controller
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
                'access' => [
                    'class' => AccessControl::class,
                    'only' => ['create', 'update', 'delete', 'index', 'view', 'subscribe', 'unsubscribe'],
                    'rules' => [
                        [
                            'actions' => ['index', 'view', 'subscribe', 'unsubscribe'],
                            'allow' => true,
                            'roles' => ['?', '@'],
                        ],
                        [
                            'actions' => ['create', 'update', 'delete'],
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
            ],
        );
    }

    /**
     * Lists all Author models.
     *
     * @return string
     */
    public function actionIndex(): string
    {
        $searchModel = new AuthorSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Author model
     *
     * @param int $id ID
     *
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView(int $id): string
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Author model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return string|Response
     * @throws Exception
     */
    public function actionCreate(): Response|string
    {
        $model = new Author();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Author model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param int $id ID
     *
     * @return string|Response
     * @throws NotFoundHttpException|Exception if the model cannot be found
     */
    public function actionUpdate(int $id): Response|string
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Author model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete(int $id): Response
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Author model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Author the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id): Author
    {
        if (! is_null($model = Author::findOne(['id' => $id]))) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Subscribe the current user to the author with the given ID.
     *
     * @param mixed $id
     *
     * @return Response
     * @throws Exception
     */
    public function actionSubscribe($id): Response
    {
        $sub = Subscription::getSubscriptionByAuthor($id);

        if (is_null($sub)) {
            $sub = new Subscription();
            $sub->user_id = Yii::$app->user->id ?? -1;
            $sub->author_id = $id;

            $sub->save();

            Yii::$app->session->setFlash('success', 'Вы подписались на автора!');
        } else {
            Yii::$app->session->setFlash('info', 'Вы уже подписаны на этого автора.');
        }

        return $this->redirect(['author/view', 'id' => $id]);
    }

    /**
     * Unsubscribe the current user from the author with the given ID.
     *
     * @param mixed $id
     *
     * @return Response
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function actionUnsubscribe($id): Response
    {
        $sub = Subscription::getSubscriptionByAuthor($id);

        if (! is_null($sub)) {
            $sub->delete();
            Yii::$app->session->setFlash('success', 'Вы отписались от автора.');
        } else {
            Yii::$app->session->setFlash('info', 'Вы не подписаны на этого автора.');
        }

        return $this->redirect(['view', 'id' => $id]);
    }

    /**
     * Displays top authors by number of books published in a given year.
     *
     * @param ?string $year
     *
     * @return string
     */
    public function actionTopAuthors(?string $year = null): string
    {
        $form = new AuthorYearForm();
        $form->load(Yii::$app->request->get());

        $query = Author::getTopAuthorsQuery($form->getYear());

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 25,
            ]
        ]);

        return $this->render(
            'top-authors',
            [
                'dataProvider' => $dataProvider,
                'form' => $form,
            ]
        );
    }
}
