<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

use yii\helpers\ArrayHelper;


/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $name
 * @property integer $sort_order
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Post[] $posts
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }


    public function behaviors()
         {
             return [
                
                 'timestamp' => [
                     'class' => 'yii\behaviors\TimestampBehavior',
                     'attributes' => [
                         ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                         ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                     ],
                 ],
             ];
         }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'sort_order'], 'required'],
            [['sort_order', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'sort_order' => Yii::t('app', 'Sort Order'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['category_id' => 'id']);
    }


    public function getCategoryDropdown(){
        $model = self::find()->select('id,name')->orderBy('sort_order asc')->all();
        $listData = ArrayHelper::map($model, 'id', 'name');
        return $listData;
    }

}
