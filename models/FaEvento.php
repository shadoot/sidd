<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fa_evento".
 *
 * @property int $id_Evento
 * @property string $Nombre
 * @property string $Fecha
 * @property string $Lugar
 * @property string $Descripcion
 * @property string $Hr_Evento
 *
 * @property FiPrestamoEvento[] $fiPrestamoEventos
 */
class FaEvento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fa_evento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_Evento'], 'required'],
            [['id_Evento'], 'integer'],
            [['Fecha', 'Hr_Evento'], 'safe'],
            [['Nombre', 'Lugar'], 'string', 'max' => 45],
            [['Descripcion'], 'string', 'max' => 70],
            [['id_Evento'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_Evento' => 'Id  Evento',
            'Nombre' => 'Nombre',
            'Fecha' => 'Fecha',
            'Lugar' => 'Lugar',
            'Descripcion' => 'Descripcion',
            'Hr_Evento' => 'Hr  Evento',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiPrestamoEventos()
    {
        return $this->hasMany(FiPrestamoEvento::className(), ['id_evento' => 'id_Evento']);
    }
}
