<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fa_evento_anexo".
 *
 * @property int $id_evento_anexo
 * @property string $imagen
 * @property string $descripcion
 * @property int $id_evento
 *
 * @property FaEvento $evento
 */
class FaEventoAnexo extends \yii\db\ActiveRecord
{
    public $image;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fa_evento_anexo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_evento'], 'required'],
            [['id_evento_anexo', 'id_evento'], 'integer'],
            [['descripcion'], 'string'],
            [['image'], 'safe'],
            [['image'], 'file', 'extensions'=>'jpg, gif, png'],
            [['image'], 'file', 'maxSize'=>'100000'],
            [['imagen'], 'string', 'max' => 255],
            [['id_evento_anexo'], 'unique'],
            [['id_evento'], 'exist', 'skipOnError' => true, 'targetClass' => FaEvento::className(), 'targetAttribute' => ['id_evento' => 'id_Evento']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_evento_anexo' => 'Id Evento Anexo',
            'imagen' => 'Imagen',
            'descripcion' => 'Descripcion',
            'id_evento' => 'Id Evento',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvento()
    {
        return $this->hasOne(FaEvento::className(), ['id_Evento' => 'id_evento']);
    }
}
