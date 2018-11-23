<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fa_actividad_deportiva".
 *
 * @property int $id_actividad_deportiva
 * @property string $nombre
 * @property int $id_Persona
 * @property int $id_Periodo
 *
 * @property FhPersona $persona
 * @property FaPeriodo $periodo
 * @property FaListaAsistencia[] $faListaAsistencias
 * @property FaListaRegistro[] $faListaRegistros
 * @property FiPrestamoActividad[] $fiPrestamoActividads
 */
class FaActividadDeportiva extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fa_actividad_deportiva';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_entrenador'], 'integer'],
            [['nombre'], 'string', 'max' => 15],
            [['id_entrenador'],'required'],
            [['id_entrenador'], 'exist', 'skipOnError' => true, 'targetClass' => FhPersona::className(), 'targetAttribute' => ['id_Persona' => 'id_Persona']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_actividad_deportiva' => 'Id Actividad Deportiva',
            'nombre' => 'Nombre de la Actividad Deportiva',
            'id_entrenador' => 'Entrenador',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntrenador()
    {
        return $this->hasOne(FhEntrenador::className(), ['id_entrenador' => 'id_entrenador']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaListaAsistencias()
    {
        return $this->hasMany(FaListaAsistencia::className(), ['id_actividad_deportiva' => 'id_actividad_deportiva']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaListaRegistros()
    {
        return $this->hasMany(FaListaRegistro::className(), ['id_actividad_deportiva' => 'id_actividad_deportiva']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiPrestamoActividads()
    {
        return $this->hasMany(FiPrestamoActividad::className(), ['id_actividad_deportiva' => 'id_actividad_deportiva']);
    }
}
