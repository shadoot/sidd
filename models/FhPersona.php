<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fh_persona".
 *
 * @property int $id_Persona
 * @property string $Nombre
 * @property string $Ap_Pataterno
 * @property string $Ap_Materno
 * @property string $Genero
 * @property string $ECivil
 * @property string $FNacimiento
 *
 * @property FaActividadDeportiva[] $faActividadDeportivas
 */
class FhPersona extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fh_persona';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Nombre', 'Ap_Pataterno', 'Ap_Materno', 'Genero', 'ECivil', 'FNacimiento'], 'required'],
            [['FNacimiento'], 'safe'],
            [['Nombre'], 'string', 'max' => 45],
            [['Ap_Pataterno', 'Ap_Materno'], 'string', 'max' => 30],
            [['Genero'], 'string', 'max' => 10],
            [['ECivil'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_Persona' => 'Id  Persona',
            'Nombre' => 'Nombre',
            'Ap_Pataterno' => 'Ap  Pataterno',
            'Ap_Materno' => 'Ap  Materno',
            'Genero' => 'Genero',
            'ECivil' => 'Ecivil',
            'FNacimiento' => 'Fnacimiento',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaActividadDeportivas()
    {
        return $this->hasMany(FaActividadDeportiva::className(), ['id_Persona' => 'id_Persona']);
    }
}
