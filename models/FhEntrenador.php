<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fh_entrenador".
 *
 * @property int $id_entrenador
 * @property int $id_persona
 *
 * @property FhPersona $persona
 */
class FhEntrenador extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fh_entrenador';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_persona','id_tipo_entrenador','estado'], 'required'],
            [['id_persona','id_tipo_entrenador'], 'integer'],
            [['id_persona'], 'unique'],
            [['id_persona'], 'exist', 'skipOnError' => true, 'targetClass' => FhPersona::className(), 'targetAttribute' => ['id_persona' => 'id_Persona']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_entrenador' => 'Id Entrenador',
            'id_persona' => 'Id Persona',
            'id_tipo_entrenador' => 'Tipo Entrenador',
            'estado' => 'Estado',

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersona()
    {
        return $this->hasOne(FhPersona::className(), ['id_Persona' => 'id_persona']);
    }

    public function getIdEntrenador($id_persona)
    {
        $query = (new \yii\db\Query())
            ->select('id_entrenador')
            ->from('fh_entrenador')
            ->where('id_persona=:persona');
        $query->addParams([':persona' => $id_persona]);
        $command = $query->createCommand();
        $row = $command->queryAll();
        return $row[0]['id_entrenador'];
    }

    public function getAllNameEntrenadores()
    {
        $allNameEntrenadores;
        $query = (new \yii\db\Query())
            ->select(["CONCAT(Nombre,' ',Ap_Paterno,' ',Ap_Materno) as nombre",'e.id_entrenador'])
            //->select('p.id_Persona')
            ->from('fh_persona p')
            ->innerjoin('fh_entrenador e','p.id_Persona=e.id_persona')
            ->where('e.estado=1');
        //  Crear un comando. Se puede obtener la consulta SQL actual utilizando $command->sql
        $command = $query->createCommand();

        // Ejecutar el comando:
        $row = $command->queryAll();
        foreach ($row as $key => $persona) {
            $allNameEntrenadores[] = ['label' => $persona['nombre'],
             'value' => $persona['nombre'],'id_entrenador' => $persona['id_entrenador']];
            /*foreach ($persona as $nombre => $value) {
                $allNameEntrenadores[][]=['label' => $nombre,
                    'value' => $value];
                //$allNameEntrenadores[]=$nombre;
            }*/
        }
        return $allNameEntrenadores;
    }

    public function getNombreCompleto($id)
    {
        $query = (new \yii\db\Query())
            ->select(["CONCAT(Nombre,' ',Ap_Paterno,' ',Ap_Materno) as nombre"])
            ->from('fh_persona p')
            ->innerjoin('fh_entrenador e','p.id_Persona=e.id_persona')
            ->where('e.id_entrenador=:id_entrenador')
            ->limit('1');
        $query->addParams([':id_entrenador' => $id]);
        $command = $query->createCommand();
        $row = $command->queryAll();
        
        return $row[0]['nombre'];
    }
}
