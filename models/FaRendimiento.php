<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fa_rendimiento".
 *
 * @property int $id_rendimiento
 * @property int $puntuacion
 * @property int $id_lista_registro_alumno
 *
 * @property FaListaRegistroAlumno $listaRegistroAlumno
 */
class FaRendimiento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fa_rendimiento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['puntuacion', 'id_lista_registro_alumno'], 'required'],
            [['puntuacion', 'id_lista_registro_alumno'], 'integer'],
            [['id_lista_registro_alumno'], 'exist', 'skipOnError' => true, 'targetClass' => FaListaRegistroAlumno::className(), 'targetAttribute' => ['id_lista_registro_alumno' => 'id_lista_registro']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_rendimiento' => 'Id Rendimiento',
            'puntuacion' => 'Puntuacion',
            'id_lista_registro_alumno' => 'Id Lista Registro Alumno',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getListaRegistroAlumno()
    {
        return $this->hasOne(FaListaRegistroAlumno::className(), ['id_lista_registro' => 'id_lista_registro_alumno']);
    }
}
