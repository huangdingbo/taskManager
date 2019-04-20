<?php

namespace backend\models;

use common\models\ToolModel;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "t_task".
 *
 * @property int $id
 * @property string $created_at 创建时间
 * @property string $created_by 创建人
 * @property string $updated_at 修改时间
 * @property string $updated_by 修改人
 * @property string $name 任务名称
 * @property string $program 执行程序
 * @property string $pid pid
 * @property string $timeOut 执行超时时间（单位秒）
 * @property string $type 任务类型（1一次执行2间隔执行3指定时间执行单次执行4指定时间永久执行）
 * @property string $start_time 任务开始时间
 * @property string $info 任务信息
 * @property string $status 任务状态(0未开始1正在执行2执行成功3执行失败)
 * @property string $last_start_time 上次开始执行时间
 * @property string $last_finish_time 上次结束执行时间
 * @property string $next_start_time 下次开始执行时间
 * @property string $run_time 任务运行时间
 * @property string $is_kill 进程是否杀死（0否1是）
 */
class Task extends ActiveRecord
{
    const NOT_RUNNING = '0'; //状态为未开始
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_task';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'program', 'timeOut', 'type', 'start_time'], 'required'],
            [['created_at', 'updated_at', 'type', 'start_time', 'status', 'last_start_time', 'last_finish_time', 'next_start_time', 'run_time'], 'string', 'max' => 50],
            [['created_by', 'updated_by'], 'string', 'max' => 100],
            [['name', 'program', 'info'], 'string', 'max' => 500],
            [['pid', 'timeOut'], 'string', 'max' => 20],
            [['is_kill'], 'string', 'max' => 2],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => '创建时间',
            'created_by' => '创建人',
            'updated_at' => '修改时间',
            'updated_by' => '修改人',
            'name' => '任务名称',
            'program' => '执行程序',
            'pid' => 'Pid',
            'timeOut' => '执行超时时间',
            'type' => '任务类型',
            'start_time' => '任务开始时间',
            'info' => '任务信息',
            'status' => '任务状态',
            'last_start_time' => '上次开始执行时间',
            'last_finish_time' => '上次结束执行时间',
            'next_start_time' => '下次开始执行时间',
            'is_kill' => '进程是否杀死',
            'run_time' => '任务运行时间',
        ];
    }

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert)){
            if($insert){
                $this->created_at = date('Y-m-d H:i:s',time());
                $this->updated_at = date('Y-m-d H:i:s',time());
                $this->created_by = Task::getIP();
                $this->updated_by = Task::getIP();
            }else{
                $this->updated_at = date('Y-m-d H:i:s',time());
                $this->updated_by = Task::getIP();
                $this->status = self::NOT_RUNNING;
                $this->last_start_time = null;
                $this->last_finish_time = null;
                $this->run_time = null;
                $this->next_start_time = null;
                $this->is_kill = '0';
            }
            return true;
        }else{
            return false;
        }
    }

}
