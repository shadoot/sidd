<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fa_lista_registro_actividad_deportiva".
 *
 * @property int $id_lista_registro_actividad_deportiva
 * @property int $id_entrenador
 * @property int $id_actividad_deportiva
 * @property string $fecha
 * @property int $en_curso
 *
 * @property FhEntrenador $entrenador
 * @property FaActividadDeportiva $actividadDeportiva
 */
class FaListaRegistroActividadDeportiva extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fa_lista_registro_actividad_deportiva';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_entrenador', 'id_actividad_deportiva', 'fecha', 'en_curso','id_periodo','id_tipo_entrenador'], 'required'],
            [['id_entrenador', 'id_actividad_deportiva', 'en_curso','id_tipo_entrenador'], 'integer'],
            [['fecha'], 'safe'],
            [['id_entrenador'], 'exist', 'skipOnError' => true, 'targetClass' => FhEntrenador::className(), 'targetAttribute' => ['id_entrenador' => 'id_entrenador']],
            [['id_actividad_deportiva'], 'exist', 'skipOnError' => true, 'targetClass' => FaActividadDeportiva::className(), 'targetAttribute' => ['id_actividad_deportiva' => 'id_actividad_deportiva']],
            [['id_periodo'], 'exist', 'skipOnError' => true, 'targetClass' => FaPeriodo::className(), 'targetAttribute' => ['id_periodo' => 'id_Periodo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_lista_registro_actividad_deportiva' => 'Lista Registro Actividad Deportiva',
            'id_entrenador' => 'Id Entrenador',
            'id_actividad_deportiva' => 'Id Actividad Deportiva',
            'fecha' => 'Fecha',
            'en_curso' => 'En Curso',
            'id_periodo' => 'Id Periodo'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntrenador()
    {
        return $this->hasOne(FhEntrenador::className(), ['id_entrenador' => 'id_entrenador'])->inverseOf('faListaRegistroActividadDeportivas');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActividadDeportiva()
    {
        return $this->hasOne(FaActividadDeportiva::className(), ['id_actividad_deportiva' => 'id_actividad_deportiva']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeriodo()
    {
        return $this->hasOne(FaPeriodo::className(), ['id_periodo' => 'id_Periodo'])->inverseOf('faListaRegistroActividadDeportivas');
    }
}
