<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Task;

/**
 * TaskSearch represents the model behind the search form of `backend\models\Task`.
 */
class TaskSearch extends Task
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['created_at', 'created_by', 'updated_at', 'updated_by', 'name', 'program', 'pid', 'timeOut', 'type', 'start_time', 'info', 'status', 'last_start_time', 'last_finish_time', 'next_start_time', 'run_time', 'is_kill'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Task::find();

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
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'created_at', $this->created_at])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_at', $this->updated_at])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'program', $this->program])
            ->andFilterWhere(['like', 'pid', $this->pid])
            ->andFilterWhere(['like', 'timeOut', $this->timeOut])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'start_time', $this->start_time])
            ->andFilterWhere(['like', 'info', $this->info])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'last_start_time', $this->last_start_time])
            ->andFilterWhere(['like', 'last_finish_time', $this->last_finish_time])
            ->andFilterWhere(['like', 'next_start_time', $this->next_start_time])
            ->andFilterWhere(['like', 'run_time', $this->run_time])
            ->andFilterWhere(['like', 'is_kill', $this->is_kill]);

        return $dataProvider;
    }

    public function getMainProcessId(){

        $cmd = "ps -ef |grep -v grep|grep -v 'sh -c' | grep main/index| awk '{print $2}'";

        exec($cmd,$output);

        return count($output)>0 ? $output[0] : '主进程未运行';
    }
}
