<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fa_carrera".
 *
 * @property int $id_Carrera
 * @property string $Clave
 * @property string $Nombre
 *
 * @property FhAlumno[] $fhAlumnos
 */
class FaCarrera extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fa_carrera';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_Carrera'], 'required'],
            [['id_Carrera'], 'integer'],
            [['Clave'], 'string', 'max' => 10],
            [['Nombre'], 'string', 'max' => 60],
            [['id_Carrera'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_Carrera' => 'Id  Carrera',
            'Clave' => 'Clave',
            'Nombre' => 'Nombre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFhAlumnos()
    {
        return $this->hasMany(FhAlumno::className(), ['id_Carrera' => 'id_Carrera'])->inverseOf('carrera');
    }
}
