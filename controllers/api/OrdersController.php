<?php

namespace app\controllers\api;

use yii\rest\ActiveController;
use yii\web\Response;

class OrdersController extends ActiveController
{
    public $modelClass = 'app\models\Order';

    /**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
		    [
		        'class' => \yii\filters\ContentNegotiator::className(),
		        'formats' => [
		            'application/json' => Response::FORMAT_JSON,
		        ]
		    ]
		];
	}
} 