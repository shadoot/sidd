<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fh_entrenador".
 *
 * @property int $id_entrenador
 * @property int $id_persona
 *
 * @property FhPersona $persona
 */
class FhEntrenador extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fh_entrenador';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_persona'], 'required'],
            [['id_persona'], 'integer'],
            [['id_persona'], 'unique'],
            [['id_persona'], 'exist', 'skipOnError' => true, 'targetClass' => FhPersona::className(), 'targetAttribute' => ['id_persona' => 'id_Persona']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_entrenador' => 'Id Entrenador',
            'id_persona' => 'Id Persona',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersona()
    {
        return $this->hasOne(FhPersona::className(), ['id_Persona' => 'id_persona']);
    }
}
