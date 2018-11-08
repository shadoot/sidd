<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fi_prestamo_actividad".
 *
 * @property int $id_prestamo_actividad
 * @property int $id_prestamo
 * @property int $id_actividad_deportiva
 *
 * @property FiPrestamo $prestamo
 * @property FaActividadDeportiva $actividadDeportiva
 */
class FiPrestamoActividad extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fi_prestamo_actividad';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_prestamo', 'id_actividad_deportiva'], 'integer'],
            [['id_prestamo'], 'exist', 'skipOnError' => true, 'targetClass' => FiPrestamo::className(), 'targetAttribute' => ['id_prestamo' => 'id_prestamo']],
            [['id_actividad_deportiva'], 'exist', 'skipOnError' => true, 'targetClass' => FaActividadDeportiva::className(), 'targetAttribute' => ['id_actividad_deportiva' => 'id_actividad_deportiva']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_prestamo_actividad' => 'Id Prestamo Actividad',
            'id_prestamo' => 'Id Prestamo',
            'id_actividad_deportiva' => 'Id Actividad Deportiva',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrestamo()
    {
        return $this->hasOne(FiPrestamo::className(), ['id_prestamo' => 'id_prestamo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActividadDeportiva()
    {
        return $this->hasOne(FaActividadDeportiva::className(), ['id_actividad_deportiva' => 'id_actividad_deportiva']);
    }
}
