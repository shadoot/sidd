<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fi_prestamo".
 *
 * @property int $id_prestamo
 * @property int $id_Articulo
 * @property int $cantidad
 * @property string $fecha_solicitud
 * @property string $fecha_entrega
 * @property string $concepto
 *
 * @property FiArticulo $articulo
 * @property FiPrestamoActividad[] $fiPrestamoActividads
 * @property FiPrestamoEvento[] $fiPrestamoEventos
 */
class FiPrestamo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fi_prestamo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_Articulo', 'cantidad'], 'integer'],
            [['fecha_solicitud', 'fecha_entrega'], 'safe'],
            [['concepto'], 'string', 'max' => 10],
            [['id_Articulo'], 'exist', 'skipOnError' => true, 'targetClass' => FiArticulo::className(), 'targetAttribute' => ['id_Articulo' => 'id_articulo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_prestamo' => 'Id Prestamo',
            'id_Articulo' => 'Id  Articulo',
            'cantidad' => 'Cantidad',
            'fecha_solicitud' => 'Fecha Solicitud',
            'fecha_entrega' => 'Fecha Entrega',
            'concepto' => 'Concepto',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticulo()
    {
        return $this->hasOne(FiArticulo::className(), ['id_articulo' => 'id_Articulo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiPrestamoActividads()
    {
        return $this->hasMany(FiPrestamoActividad::className(), ['id_prestamo' => 'id_prestamo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiPrestamoEventos()
    {
        return $this->hasMany(FiPrestamoEvento::className(), ['id_prestamo' => 'id_prestamo']);
    }
}
