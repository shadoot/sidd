<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fa_lista_registro_alumno".
 *
 * @property int $id_lista_registro
 * @property int $id_Alumno
 * @property int $id_actividad_deportiva
 * @property string $fecha_registro
 *
 * @property FaCalificacion[] $faCalificacions
 * @property FhAlumno $alumno
 * @property FaActividadDeportiva $actividadDeportiva
 */
class FaListaRegistroAlumno extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fa_lista_registro_alumno';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_Alumno', 'id_lista_registro_actividad_deportiva'], 'integer'],
            [['fecha_registro'], 'safe'],
            [['id_Alumno'], 'exist', 'skipOnError' => true, 'targetClass' => FhAlumno::className(), 'targetAttribute' => ['id_Alumno' => 'id_Alumno']],
            [['id_lista_registro_actividad_deportiva'], 'exist', 'skipOnError' => true, 'targetClass' => FaListaRegistroActividadDeportiva::className(), 'targetAttribute' => ['id_lista_registro_actividad_deportiva' => 'id_lista_registro_actividad_deportiva']],
            [['id_Alumno'],'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_lista_registro' => 'Id Lista Registro',
            'id_Alumno' => 'Alumno',
            'id_lista_registro_actividad_deportiva' => 'Actividad Deportiva',
            'fecha_registro' => 'Fecha Registro',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaCalificacions()
    {
        return $this->hasMany(FaCalificacion::className(), ['id_lista_registro' => 'id_lista_registro']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlumno()
    {
        return $this->hasOne(FhAlumno::className(), ['id_Alumno' => 'id_Alumno']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getListaRegistroActividadDeportiva()
    {
        return $this->hasOne(FaListaRegistroActividadDeportiva::className(), ['id_lista_registro_actividad_deportiva' => 'id_lista_registro_actividad_deportiva']);
    }

    public function getActividadDeportivaEnCurso()
    {
         $query = (new \yii\db\Query())
            ->select(['id_lista_registro_actividad_deportiva id_lrad',
                    'nombre'])
            ->from('fa_lista_registro_actividad_deportiva r')
            ->innerjoin('fa_actividad_deportiva a',
                'r.id_actividad_deportiva=a.id_actividad_deportiva')
            ->where('r.en_curso=:curso');
            $query->addParams([':curso' => 1]);
        $command = $query->createCommand();
        $row = $command->queryAll();
        return $row;
    }
}
