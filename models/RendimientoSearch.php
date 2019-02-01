<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FaRendimiento;
use yii\data\SqlDataProvider;

/**
 * RendimientoSearch represents the model behind the search form of `app\models\FaRendimiento`.
 */
class RendimientoSearch extends FaRendimiento
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_rendimiento', 'puntuacion', 'id_lista_registro_alumno'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = FaRendimiento::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_rendimiento' => $this->id_rendimiento,
            'puntuacion' => $this->puntuacion,
            'id_lista_registro_alumno' => $this->id_lista_registro_alumno,
        ]);

        return $dataProvider;
    }

    public function searchSqlProvider($id)
    {   
        $query = (new \yii\db\Query())
        ->select(['id_rendimiento','lra.id_lista_registro','puntuacion'])
        ->from('fa_lista_registro_alumno lra')
        ->innerjoin('fa_lista_registro_actividad_deportiva lrad','lrad.id_lista_registro_actividad_deportiva = lra.id_lista_registro_actividad_deportiva')
        ->innerjoin('fh_alumno a','lra.id_Alumno = a.id_Alumno')
        ->innerjoin('fh_persona p','p.id_Persona = a.id_Persona')
        ->leftjoin('fa_rendimiento r','r.id_lista_registro_alumno = lra.id_lista_registro')
        ->where('lrad.id_lista_registro_actividad_deportiva=:id');
        //$query->addParams(':id' => $id);

        $command = $query->createCommand();

        $provider=new SqlDataProvider([
            'sql'=>$command->sql,
            'params' => [':id' => $id],
        ]);

        return $provider;
    }
}
