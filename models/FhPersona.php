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
            [['FNacimiento'],'date', 'format'=>'Y-m-d'],
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
            'Ap_Pataterno' => 'Apellido Paterno',
            'Ap_Materno' => 'Apellido Materno',
            'Genero' => 'Genero',
            'ECivil' => 'Estado Civil',
            'FNacimiento' => 'Fecha de Nacimiento',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaActividadDeportivas()
    {
        return $this->hasMany(FaActividadDeportiva::className(), ['id_Persona' => 'id_Persona']);
    }

    public function getAllNameEntrenadores()
    {
        $allNameEntrenadores;
        $query = (new \yii\db\Query())
            ->select(["CONCAT(Nombre,' ',Ap_Pataterno,' ',Ap_Materno) as nombre",'p.id_Persona'])
            //->select('p.id_Persona')
            ->from('fh_persona p')
            ->innerjoin('fh_entrenador e','p.id_Persona=e.id_persona');
        //  Crear un comando. Se puede obtener la consulta SQL actual utilizando $command->sql
        $command = $query->createCommand();

        // Ejecutar el comando:
        $row = $command->queryAll();
        foreach ($row as $key => $persona) {
            $allNameEntrenadores[] = ['label' => $persona['nombre'],
             'value' => $persona['nombre'],'id_Persona' => $persona['id_Persona']];
            /*foreach ($persona as $nombre => $value) {
                $allNameEntrenadores[][]=['label' => $nombre,
                    'value' => $value];
                //$allNameEntrenadores[]=$nombre;
            }*/
        }
        return $allNameEntrenadores;
    }
}
