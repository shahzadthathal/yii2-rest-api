<?php
namespace api\modules\v2\models;
use \yii\db\ActiveRecord;
/**
 * Post Model
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class Post extends ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'post';
	}

    /**
     * @inheritdoc
     */
    /*
    public static function primaryKey()
    {
        return ['code'];
    }
    */

    /**
     * Define rules for validation
     */
    public function rules()
    {
        return [
            [['title', 'slug', 'content'], 'required']
        ];
    }
}
