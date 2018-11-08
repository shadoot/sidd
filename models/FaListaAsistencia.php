<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fa_lista_asistencia".
 *
 * @property int $id_lista
 * @property int $id_Alumno
 * @property int $id_actividad_deportiva
 * @property string $dia
 * @property bool $asistencia
 *
 * @property FhAlumno $alumno
 * @property FaActividadDeportiva $actividadDeportiva
 */
class FaListaAsistencia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fa_lista_asistencia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_Alumno', 'id_actividad_deportiva'], 'integer'],
            [['dia'], 'safe'],
            [['asistencia'], 'boolean'],
            [['id_Alumno'], 'exist', 'skipOnError' => true, 'targetClass' => FhAlumno::className(), 'targetAttribute' => ['id_Alumno' => 'id_Alumno']],
            [['id_actividad_deportiva'], 'exist', 'skipOnError' => true, 'targetClass' => FaActividadDeportiva::className(), 'targetAttribute' => ['id_actividad_deportiva' => 'id_actividad_deportiva']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_lista' => 'Id Lista',
            'id_Alumno' => 'Id  Alumno',
            'id_actividad_deportiva' => 'Id Actividad Deportiva',
            'dia' => 'Dia',
            'asistencia' => 'Asistencia',
        ];
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
