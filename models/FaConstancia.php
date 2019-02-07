<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fa_constancia".
 *
 * @property int $id_constancia
 * @property string $titulo
 * @property string $contenido
 * @property int $activa
 */
class FaConstancia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fa_constancia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titulo', 'contenido', 'activa'], 'required'],
            [['contenido'], 'string'],
            [['activa'], 'integer'],
            [['titulo'], 'string', 'max' => 50],
            [['activa'],'onlyOne','message' => 'Solo puede estar activo uno']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_constancia' => 'Id Constancia',
            'titulo' => 'Titulo',
            'contenido' => 'Contenido',
            'activa' => 'Activa',
        ];
    }
    
    public function onlyOne($attibute,$params){

        if($this->$attibute=='1'){

            $query = (new \yii\db\Query())
            ->select('id_constancia')
            ->from('fa_constancia')
            ->where('activa=1')
            ->limit('1');
            $command = $query->createCommand();
            $row = $command->queryOne();
            //var_dump($row['id_constancia']);
            //var_dump(($this->id_constancia.''));
            //exit();
            if($row['id_constancia']==$this->id_constancia){
                return false;
            }else if(!is_null($row['id_constancia'])){
                $this->addError($attibute,"Ya hay un formato activo");
                return true;
            }else{
                return false;
            }
        }
        return false;
    }
}
