<?php

namespace app\models;

use yii\base\Model;


/**
 * Class SetPageGroupForm
 * @package app\models
 *
 * @property $projects
 * @property $domains
 * @property $groups
 * @property $pages
 */

class SetPageGroupForm extends Model{
    public $projects;
    public $domains;
    public $groups;
    public $pages;

    public function rules()
    {
        $rules = [
            [['projects', 'domains', 'groups', 'pages'], 'required'],
            [['projects', 'domains', 'groups', 'pages'], 'safe']
        ];
        return array_merge(parent::rules(), $rules);
    }

    public function attributeLabels()
    {
        return [
            'projects' => \Yii::t('app', 'Projects'),
            'domains' => \Yii::t('app', 'Domains'),
            'groups' => \Yii::t('app', 'Groups'),
            'pages' => \Yii::t('app', 'Pages'),
        ];
    }

    public function save(){
        $page_groups = array();
        foreach ($this->pages as $page){
            $page_group = new PageGroup(['page_id' => $page, 'group_id' => $this->groups[0]]);
            if(is_null(PageGroup::find()->where(['page_id' => $page, 'group_id' => $this->groups[0]])->one())){
                $page_group->save();
            }
        }
    }
}