<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fa_periodo".
 *
 * @property int $id_Periodo
 * @property string $Periodo
 * @property int $Año
 *
 * @property FaActividadDeportiva[] $faActividadDeportivas
 */
class FaPeriodo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fa_periodo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_Periodo'], 'required'],
            [['id_Periodo', 'Año'], 'integer'],
            [['Periodo'], 'string', 'max' => 20],
            [['id_Periodo'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_Periodo' => 'Id  Periodo',
            'Periodo' => 'Periodo',
            'Año' => 'Año',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaActividadDeportivas()
    {
        return $this->hasMany(FaActividadDeportiva::className(), ['id_Periodo' => 'id_Periodo']);
    }

    public function getPeriodo()
    {
        $query = (new \yii\db\Query())
            ->select(['id_Periodo',"CONCAT(Periodo,' --> ',Año) as Periodo"])
            ->from('fa_periodo');
        $command = $query->createCommand();
        $row = $command->queryAll();
        return $row;
    }

    public function getPeriodoByID($id){
        //$periodo='';
        $query = (new \yii\db\Query())
            ->select(["CONCAT(Periodo,' -- ',Año) as periodo"])
            ->from('fa_periodo p')
            
            ->where('p.id_Periodo=:id')
            ->limit(1)
            ->addParams([':id' => $id]);
        $command = $query->createCommand();
        $row = $command->queryAll();

        return $row[0]['periodo'];
    }
}
