<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fh_tipo_entrenador".
 *
 * @property int $id_tipo_entrenador
 * @property string $tipo
 *
 * @property FaListaRegistroActividadDeportiva[] $faListaRegistroActividadDeportivas
 * @property FhEntrenador[] $fhEntrenadors
 */
class FhTipoEntrenador extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fh_tipo_entrenador';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo'], 'required'],
            [['tipo'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_tipo_entrenador' => 'Id Tipo Entrenador',
            'tipo' => 'Tipo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaListaRegistroActividadDeportivas()
    {
        return $this->hasMany(FaListaRegistroActividadDeportiva::className(), ['id_tipo_entrenador' => 'id_tipo_entrenador'])->inverseOf('tipoEntrenador');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFhEntrenadors()
    {
        return $this->hasMany(FhEntrenador::className(), ['id_tipo_entrenador' => 'id_tipo_entrenador'])->inverseOf('tipoEntrenador');
    }
}
