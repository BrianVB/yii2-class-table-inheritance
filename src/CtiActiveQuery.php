<?php

namespace bvb\cti;

use yii\db\ActiveQuery;

class CtiActiveQuery extends ActiveQuery
{
    /**
     * {@inheritdoc}
     */
    public function populate($rows)
    {
        $models = parent::populate($rows);

        // --- If the query is asArray apply the attributes we want to inherit from the parent
        // --- to the modelclass using CtiActiveQuery
        if ($this->asArray) {
            foreach($models as &$model){
                foreach($model['parentRelation'] as $attribute => $value){
                    if(in_array($attribute, $this->modelClass::$parentAttributesInherited)){
                        $model[$attribute] = $value;
                    }
                }
            }
        }
        
        return $models;
    }
}
