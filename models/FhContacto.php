<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fh_contacto".
 *
 * @property int $id_Contacto
 * @property string $Tel_Fijo
 * @property string $Tel_Movil
 * @property string $e_mail
 * @property int $id_Persona
 */
class FhContacto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fh_contacto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['e_mail', 'id_Persona'], 'required'],
            [['id_Persona'], 'integer'],
            [['Tel_Fijo', 'Tel_Movil'], 'string', 'max' => 15],
            [['e_mail'], 'string', 'max' => 40],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_Contacto' => 'Id  Contacto',
            'Tel_Fijo' => 'Telefono  Fijo',
            'Tel_Movil' => 'Telefono  Movil',
            'e_mail' => 'Correo Electronico',
            'id_Persona' => 'Id  Persona',
        ];
    }
}
