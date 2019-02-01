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
            [['e_mail'], 'string', 'length' => [7, 40]],
            [['e_mail'],'email'],
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


    public function getContacto($id_persona)
    {
        $query = (new \yii\db\Query())
            ->select('id_Contacto')
            ->from('fh_contacto')
            ->where('id_Persona=:Num_Control');
        $query->addParams([':Num_Control' => $id_persona]);
        $command = $query->createCommand();
        $row = $command->queryAll();
        return $row[0]['id_Contacto'];
    }
}
