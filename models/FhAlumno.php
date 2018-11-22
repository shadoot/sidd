<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fh_alumno".
 *
 * @property int $id_Alumno
 * @property int $Num_Control
 * @property string $Estado
 * @property int $id_Persona
 * @property int $id_Carrera
 * @property int $id_Semestre
 *
 * @property FaListaAsistencia[] $faListaAsistencias
 * @property FaListaRegistro[] $faListaRegistros
 */
class FhAlumno extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fh_alumno';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_Alumno'], 'required'],
            [['id_Alumno', 'Num_Control', 'id_Persona', 'id_Carrera', 'id_Semestre'], 'integer'],
            [['Estado'], 'string', 'max' => 12],
            [['id_Alumno'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_Alumno' => 'Id  Alumno',
            'Num_Control' => 'Num  Control',
            'Estado' => 'Estado',
            'id_Persona' => 'Id  Persona',
            'id_Carrera' => 'Id  Carrera',
            'id_Semestre' => 'Id  Semestre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaListaAsistencias()
    {
        return $this->hasMany(FaListaAsistencia::className(), ['id_Alumno' => 'id_Alumno']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaListaRegistros()
    {
        return $this->hasMany(FaListaRegistro::className(), ['id_Alumno' => 'id_Alumno']);
    }

    public function getAllNumeroControl()
    {
        $allNumeroControl;
        $query = (new \yii\db\Query())
            ->select('Num_Control')
            ->from('fh_alumno');
        //  Crear un comando. Se puede obtener la consulta SQL actual utilizando $command->sql
        $command = $query->createCommand();

        // Ejecutar el comando:
        $row = $command->queryAll();
        foreach ($row as $key => $alumno) {
            foreach ($alumno as $control => $value) {
                $allNumeroControl[]=$value;
            }
        }
        return $allNumeroControl;
    }
}
