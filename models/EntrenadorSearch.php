<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FhEntrenador;
use yii\data\SqlDataProvider;

/**
 * EntrenadorSearch represents the model behind the search form of `app\models\FhEntrenador`.
 */
class EntrenadorSearch extends FhEntrenador
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_entrenador', 'estado', 'id_tipo_entrenador'], 'integer'],
            [['id_persona'],'string'],
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
        $query = FhEntrenador::find()->joinWith(['persona','tipoEntrenador','listaRegistroActividadDeportivas']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        $dataProvider->sort->attributes['id_persona']=[
            'asc' => ['fh_persona.Ap_Paterno' => SORT_ASC,
                'fh_persona.Ap_Materno' => SORT_ASC,
                'fh_persona.Nombre' => SORT_ASC],
            'desc' => ['fh_persona.Ap_Paterno' => SORT_DESC,
                'fh_persona.Ap_Materno' => SORT_DESC,
                'fh_persona.Nombre' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['id_tipo_entrenador']=[
            'asc' => ['fh_tipo_entrenador.tipo' => SORT_ASC],
            'desc' => ['fh_tipo_entrenador.tipo' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['estado']=[
            'asc' => ['estado' => SORT_DESC],
            'desc' => ['estado' => SORT_ASC],
        ];
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_entrenador' => $this->id_entrenador,
            'estado' => $this->estado,
            //'id_tipo_entrenador' => $this->id_tipo_entrenador,
            //'id_persona' => $this->id_persona,
            
        ]);

        $query->andFilterWhere(['like',"CONCAT(fh_persona.Ap_Paterno,' ',fh_persona.Ap_Materno,' ',fh_persona.Nombre)",$this->id_persona]);
        $query->andFilterWhere(['=','fh_tipo_entrenador.id_tipo_entrenador',$this->id_tipo_entrenador]);

        return $dataProvider;
    }

    /*public function search($params)
    {
        $query = (new \yii\db\Query())
            ->select(['id_entrenador','p.id_Persona',
                "CONCAT(Nombre,' ',Ap_Paterno,' ',Ap_Materno) AS 'Nombre Completo'",
                'Tel_Movil AS Celular','(e_mail) as "Correo Electrónico"',//(-_-) porque lo acepto solo con ()
                'e.estado','t.tipo'])
            ->from('fh_entrenador e')
            ->innerjoin('fh_persona p','e.id_persona = p.id_Persona')
            ->innerjoin('fh_contacto c','p.id_Persona = c.id_Persona')
            ->innerjoin('fh_tipo_entrenador t','t.id_tipo_entrenador = e.id_tipo_entrenador');
        $command = $query->createCommand();

        $provider=new SqlDataProvider([
            'sql' => $command->sql,
            'key' => 'id_entrenador',
        ]);

        $provider->sort->attributes['tipo']=[
            'asc' => ['estado' => SORT_ASC],
            'desc' => ['estado' => SORT_DESC],
        ];
        //var_dump($params);
        //exit();
        $this->load($params);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');

            return $provider;
        }

        $query->andFilterWhere([
            'id_entrenador' => $this->id_entrenador,
            'estado' => $this->estado,
            'id_tipo_entrenador' => $this->id_tipo_entrenador,
            'id_persona' => $this->id_persona,
            //'tipo' => $this->id_tipo_entrenador,
        ]);
        //$query->andFilterWhere(['=','tipo', $this->tipo]);

        $command=$query->createCommand();
        //var_dump($command->sql);
        //exit();
        return $provider;
    }*/
}
