<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "articles".
 *
 * @property int $id
 * @property string $title
 * @property string $text
 * @property string $short_text
 * @property string $author
 * @property int $author_id
 * @property int $created_at
 * @property int $updated_at
 */
class Articles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'articles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'text', 'short_text', 'author'], 'required'],
            [['text', 'short_text'], 'string'],
            [['author_id', 'created_at', 'updated_at'], 'integer'],
            [['title', 'author'], 'string', 'max' => 256],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'text' => 'Text',
            'short_text' => 'Short Text',
            'author' => 'Author',
            'author_id' => 'Author ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
