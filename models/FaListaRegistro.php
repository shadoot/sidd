<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fa_lista_registro".
 *
 * @property int $id_lista_registro
 * @property int $id_Alumno
 * @property int $id_actividad_deportiva
 * @property string $fecha_registro
 *
 * @property FaCalificacion[] $faCalificacions
 * @property FhAlumno $alumno
 * @property FaActividadDeportiva $actividadDeportiva
 */
class FaListaRegistro extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fa_lista_registro';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_Alumno', 'id_actividad_deportiva'], 'integer'],
            [['fecha_registro'], 'safe'],
            [['id_Alumno'], 'exist', 'skipOnError' => true, 'targetClass' => FhAlumno::className(), 'targetAttribute' => ['id_Alumno' => 'id_Alumno']],
            [['id_actividad_deportiva'], 'exist', 'skipOnError' => true, 'targetClass' => FaActividadDeportiva::className(), 'targetAttribute' => ['id_actividad_deportiva' => 'id_actividad_deportiva']],
            [['id_Alumno'],'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_lista_registro' => 'Id Lista Registro',
            'id_Alumno' => 'Alumno',
            'id_actividad_deportiva' => 'Actividad Deportiva',
            'fecha_registro' => 'Fecha Registro',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaCalificacions()
    {
        return $this->hasMany(FaCalificacion::className(), ['id_lista_registro' => 'id_lista_registro']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlumno()
    {
        return $this->hasOne(FhAlumno::className(), ['id_Alumno' => 'id_Alumno']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActividadDeportiva()
    {
        return $this->hasOne(FaActividadDeportiva::className(), ['id_actividad_deportiva' => 'id_actividad_deportiva']);
    }
}
