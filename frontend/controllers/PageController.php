<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2016-04-02 22:48
 */

namespace frontend\controllers;

use Yii;
use common\services\ArticleServiceInterface;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class PageController extends Controller
{

    /**
     * 单页
     *
     * @param string $name
     * @return string
     * @throws \yii\web\NotFoundHttpException
     * @throws \yii\base\InvalidConfigException
     */
    public function actionView($name = '')
    {
        if ($name == '') {
            $name = Yii::$app->getRequest()->getPathInfo();
        }

        /** @var ArticleServiceInterface $service */
        $service = Yii::$app->get(ArticleServiceInterface::ServiceName);
        $model = $service->getArticleSubTitle($name);
        if (empty($model)) {
            throw new NotFoundHttpException('None page named ' . $name);
        }
        $template = "view";
        isset($model->category) && $model->category->template != "" && $template = $model->category->template;
        $model->template != "" && $template = $model->template;
        return $this->render($template, [
            'model' => $model,
        ]);
    }

}