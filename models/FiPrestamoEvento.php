<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fi_prestamo_evento".
 *
 * @property int $id_prestamo_evento
 * @property int $id_prestamo
 * @property int $id_evento
 *
 * @property FiPrestamo $prestamo
 * @property FaEvento $evento
 */
class FiPrestamoEvento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fi_prestamo_evento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_prestamo', 'id_evento'], 'integer'],
            [['id_prestamo'], 'exist', 'skipOnError' => true, 'targetClass' => FiPrestamo::className(), 'targetAttribute' => ['id_prestamo' => 'id_prestamo']],
            [['id_evento'], 'exist', 'skipOnError' => true, 'targetClass' => FaEvento::className(), 'targetAttribute' => ['id_evento' => 'id_Evento']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_prestamo_evento' => 'Id Prestamo Evento',
            'id_prestamo' => 'Id Prestamo',
            'id_evento' => 'Id Evento',
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
    public function getEvento()
    {
        return $this->hasOne(FaEvento::className(), ['id_Evento' => 'id_evento']);
    }
}
