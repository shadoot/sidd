<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fa_actividad_deportiva".
 *
 * @property int $id_actividad_deportiva
 * @property string $nombre
 * @property string $rama
 * @property bool $estado
 * @property int $id_entrenador
 *
 * @property FhEntrenador $entrenador
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
            [['nombre', 'rama'], 'required'],
            [['estado'], 'boolean'],
            [['nombre'], 'string', 'max' => 15],
            [['rama'], 'string', 'max' => 7],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_actividad_deportiva' => 'Actividad Deportiva',
            'nombre' => 'Nombre',
            'rama' => 'Rama',
            'estado' => 'Estado',
        ];
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

    public function getEstado()
    {
        return ($this->estado==1) ? "activo" : "cancelado";
    }

    public function getNombreActividadDeportiva($id)
    {
        $query = (new \yii\db\Query())
            ->select('nombre')
            ->from('fa_actividad_deportiva a')
            ->where('a.id_actividad_deportiva=:id_actividad_deportiva');
        $query->addParams([':id_actividad_deportiva' => $id]);
        $command = $query->createCommand();
        $row = $command->queryAll();
        return $row[0]['nombre'];
    }

    public function getRamaActividad($id)
    {
        $query = (new \yii\db\Query())
            ->select('rama')
            ->from('fa_actividad_deportiva a')
            ->where('a.id_actividad_deportiva=:id_actividad_deportiva');
        $query->addParams([':id_actividad_deportiva' => $id]);
        $command = $query->createCommand();
        $row = $command->queryAll();
        return $row[0]['rama'];
    }
}
