<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fi_articulo".
 *
 * @property int $id_articulo
 * @property string $nombre
 * @property string $descripcion
 *
 * @property FiInventario[] $fiInventarios
 * @property FiPrestamo[] $fiPrestamos
 */
class FiArticulo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fi_articulo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre','descripcion'],'required'],
            [['nombre'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_articulo' => 'Id Articulo',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiInventarios()
    {
        return $this->hasMany(FiInventario::className(), ['id_articulo' => 'id_articulo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiPrestamos()
    {
        return $this->hasMany(FiPrestamo::className(), ['id_Articulo' => 'id_articulo']);
    }
}
