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
 * @property FhPersona $persona
 * @property FaCarrera $carrera
 * @property FaSemestre $semestre
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
            [['Num_Control', 'id_Persona', 'id_Carrera', 'id_Semestre'], 'integer'],
            [['Estado'], 'string', 'max' => 12],
            [['Num_Control'], 'unique'],
            [['id_Persona'], 'exist', 'skipOnError' => true, 'targetClass' => FhPersona::className(), 'targetAttribute' => ['id_Persona' => 'id_Persona']],
            [['id_Carrera'], 'exist', 'skipOnError' => true, 'targetClass' => FaCarrera::className(), 'targetAttribute' => ['id_Carrera' => 'id_Carrera']],
            [['id_Semestre'], 'exist', 'skipOnError' => true, 'targetClass' => FaSemestre::className(), 'targetAttribute' => ['id_Semestre' => 'id_Semestre']],
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
    public function getPersona()
    {
        return $this->hasOne(FhPersona::className(), ['id_Persona' => 'id_Persona']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarrera()
    {
        return $this->hasOne(FaCarrera::className(), ['id_Carrera' => 'id_Carrera'])->inverseOf('fhAlumnos');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSemestre()
    {
        return $this->hasOne(FaSemestre::className(), ['id_Semestre' => 'id_Semestre'])->inverseOf('fhAlumnos');
    }

    public function getAllNumeroControl()
    {
        $allNumeroControl;
        $query = (new \yii\db\Query())
            ->select(["Num_Control as numero,CONCAT(p.Nombre,' ',Ap_Pataterno,' ',Ap_Materno) as nombre, c.Nombre as carrera"])
            ->from('fh_alumno a')
            ->innerjoin('fh_persona p','a.id_Persona=p.id_Persona')
            ->innerjoin('fa_carrera c','a.id_Carrera=c.id_Carrera');
        //  Crear un comando. Se puede obtener la consulta SQL actual utilizando $command->sql
        $command = $query->createCommand();

        // Ejecutar el comando:
        $row = $command->queryAll();
        foreach ($row as $key => $alumno) {
            $allNumeroControl[]=['label' => $alumno['numero'],
             'value' => $alumno['numero'],'nombre' => $alumno['nombre'],
             'carrera' => $alumno['carrera']];
        }
        return $allNumeroControl;
    }
}
