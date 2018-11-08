<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fi_inventario".
 *
 * @property int $id_inventario
 * @property int $id_articulo
 * @property int $cantidad
 *
 * @property FiArticulo $articulo
 */
class FiInventario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fi_inventario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_articulo', 'cantidad'], 'integer'],
            [['id_articulo'], 'exist', 'skipOnError' => true, 'targetClass' => FiArticulo::className(), 'targetAttribute' => ['id_articulo' => 'id_articulo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_inventario' => 'Id Inventario',
            'id_articulo' => 'Id Articulo',
            'cantidad' => 'Cantidad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticulo()
    {
        return $this->hasOne(FiArticulo::className(), ['id_articulo' => 'id_articulo']);
    }
}
