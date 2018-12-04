<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fa_calificacion".
 *
 * @property int $id_calificacion
 * @property int $calificacion
 * @property int $id_lista_registro
 *
 * @property FaListaRegistro $listaRegistro
 */
class FaCalificacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fa_calificacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['calificacion', 'id_lista_registro'], 'integer'],
            [['id_lista_registro'], 'exist', 'skipOnError' => true, 'targetClass' => FaListaRegistroAlumno::className(), 'targetAttribute' => ['id_lista_registro' => 'id_lista_registro']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_calificacion' => 'Id Calificacion',
            'calificacion' => 'Calificacion',
            'id_lista_registro' => 'Id Lista Registro',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getListaRegistro()
    {
        return $this->hasOne(FaListaRegistro::className(), ['id_lista_registro' => 'id_lista_registro']);
    }
}
