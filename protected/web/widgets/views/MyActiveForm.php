<?php
/**
 * Класс для быстрого построения форм от модели,
 * полностью заменяющий простыню кода после генерации crud формы
 *
 * Пример:
 * <code>
 * $form = $this->beginWidget('MyActiveForm', array(
 *     'id' => 'objects-form',
 *     'enableAjaxValidation' => false,
 * ));
 *
 * echo $form->beginForm();
 * echo $form->errorSummary($model);
 *
 * echo $form->beginField();
 * echo $form->renderField($model, 'title');
 * echo $form->endField();
 *
 * echo $form->buttons($model);
 * echo $form->endForm();
 *
 * $this->endWidget();
 * </code>
 *
 * @package system/forms
 * @author Dmitriy Neshin
 */
class MyActiveForm extends CActiveForm
{
	public $beginDivStyle;
	public $beginDivClass = 'form';
	
    public function init()
    {
        if (!isset($this->htmlOptions['onSubmit'])) {
            $this->htmlOptions['onSubmit'] = 'js:$("input[type=submit]").attr("disabled", true); return true;';
        }
        parent::init();
    }

    public function renderField($model, $field)
    {
        $model_reflection = new ReflectionClass($model);
        if ($model_reflection->hasProperty($field)) {
            return $this->myTextField($model, $field);
        }
        return $this->generateField($model, $field);
    }

    public function renderFileField($model, $field)
    {
        return $this->generateFile($model, $field);
    }

    public function renderAutoCompleteField($model, $field, $sourceUrl)
    {
        return $this->myAutoCompleteField($model, $field, $sourceUrl);
    }

    protected function generateField($model, $field)
    {
        if (isset($model->getMetaData()->columns[$field]) && !$model->getMetaData()->columns[$field]->isForeignKey) {
            $model_field = $model->getMetaData()->columns[$field];
        } else if (isset($model->getMetaData()->relations[$field])) {
            $model_field = $model->getMetaData()->relations[$field];
        }

        if (!isset($model_field)) {
            throw new CException(
                '"' . $field . '" не найден в модели "' . get_class($model) . '" либо является primary/foreign ключом'
            );
        }
        switch (get_class($model_field)) {
            case 'CManyManyRelation':
                $return = $this->myListBox($model, $model_field->name);
                break;

            case 'CBelongsToRelation':
                $return = $this->myDropDownList($model, $model_field->name);
                break;

            case 'CHasOneRelation':
                throw new CException('CHasOneRelation не реализован');
                break;

            case 'CHasManyRelation':
                throw new CException('CHasManyRelation не реализован');
                break;

            default:
                switch ($model_field->type) {
                    case 'boolean':
                        $return = $this->myCheckBox($model, $model_field->name);
                        break;

                    default:
                        if ($model->isAttributeEnumerable($model_field->name)) {
                            $return = $this->myDropDownList($model, $model_field->name);
                        }

                        foreach ($model->getValidators($model_field->name) as $validator) {
                            if ($validator instanceof CFileValidator) {
                                $return = $this->myFileField($model, $model_field->name);
                            }
                        }

                        if (!isset($return)) {
                            switch ($model_field->dbType) {
                                case 'text':
                                    $return = $this->myTextArea($model, $model_field->name);
                                    break;

                                case 'date':
                                    $return = $this->myDateField($model, $model_field->name);
                                    break;

                                case 'timestamp':
                                    $return = $this->myDateTimeField($model, $model_field->name);
                                    break;

                                case 'time without time zone':
                                    $return = $this->myDateTimeField($model, $model_field->name, true);
                                    break;

                                case 'timestamp without time zone':
                                    $return = $this->myDateTimeField($model, $model_field->name);
                                    break;

                                default:
                                    $return = $this->myTextField($model, $model_field->name);
                                    break;
                            }
                        }
                        break;
                }
                break;
        }

        return $return;
    }

    public function fullRenderField($model, $field){
        echo $this->beginField();
        echo $this->renderField($model, $field);
        echo $this->endField();
    }

    protected function generateFile($model, $field)
    {
        $return = $this->myFileField($model, $field);

        return $return;
    }

    protected function myTextField($model, $field)
    {
        if (isset($model->getMetaData()->columns[$field])) {
            $model_column_md = $model->getMetaData()->columns[$field];
            switch ($model_column_md->type) {
                case 'string':
                    if ($model_column_md->size > 60) {
                        $_size = 60;
                    } else if ($model_column_md->size < 3) {
                        $_size = 3;
                    } else {
                        $_size = $model_column_md->size;
                    }
                    $_maxlength = $model_column_md->size;
                    break;

                case 'integer':
                case 'double':
                    $_size = 6;
                    $_maxlength = 100;
                    break;
            }
        } else {
            $_size = 60;
            $_maxlength = 100;
        }

        $html = $this->labelEx($model, $field);
        $html .= $this->textField($model, $field, array('size' => $_size, 'maxlength' => $_maxlength));
        $html .= $this->error($model, $field);

        return $html;
    }

    protected function myDateField($model, $field)
    {
        $html = $this->labelEx($model, $field);
        $html .= $this->widget('application.zii.widgets.jui.MyJuiDatePicker',
            array('model' => $model, 'attribute' => $field), true);
        $html .= $this->error($model, $field);
        return $html;
    }

    protected function myDateTimeField($model, $field, $timePickerOnly = false)
    {
        $html = $this->labelEx($model, $field);
        $html .= $this->widget('application.zii.widgets.jui.MyJuiDateTimePicker', array(
            'model' => $model,
            'attribute' => $field,
            'timePickerOnly' => $timePickerOnly,
            'options' => array(
                'hourGrid' => 4,
                'timeFormat' => 'hh:mm:ss',
                'dateFormat' => 'dd.mm.yy',
            ),
        ), true);
        $html .= $this->error($model, $field);
        return $html;
    }

    protected function myTextArea($model, $field, $htmlOptions = array())
    {
        $html = $this->labelEx($model, $field);
        $html .= $this->textArea($model, $field, CMap::mergeArray(array('cols' => 60, 'rows' => 10), $htmlOptions));
        $html .= $this->error($model, $field);
        return $html;
    }

    public function myCheckBox($model, $field)
    {
        $html = $this->labelEx($model, $field);
        $html .= $this->checkBox($model, $field);
        $html .= $this->error($model, $field);
        return $html;
    }

    protected function myReverseCheckBox($model, $field)
    {
        $html = $this->checkBox($model, $field);
        $html .= $this->labelEx($model, $field);
        $html .= $this->error($model, $field);
        return $html;
    }

    protected function myListBox($model, $field, $group = '', $data = null)
    {
        $relation_class_name = $model->getMetaData()->relations[$field]->className;
        if ($data === null) {
            $data = CHtml::listData(
                $relation_class_name::model()->findAll(),
                $relation_class_name::model()->getTableSchema()->primaryKey,
                'toString',
                $group
            );
        }

        $html = $this->labelEx($model, $field);
        $html .= $this->widget('application.zii.widgets.jui.MyMultiSelect', array(
            'model' => $model,
            'attribute' => $field,
            'data' => $data,
            'htmlOptions' => array('class' => 'multiselect')
        ), true);
        $html .= $this->error($model, $field);

        return $html;
    }

    public function restaurantsListBox($model, $field, $group = '', $data = null)
    {
        $relation_class_name = $model->getMetaData()->relations[$field]->className;
        if ($data === null) {
            if (!empty($model->type_id))
                $data = CHtml::listData(
                    $relation_class_name::model()->findAll('parent_restaurant_id is null AND (is_independent is NULL OR is_independent NOT LIKE 1) AND type_id = ' . $model->type_id),
                    $relation_class_name::model()->getTableSchema()->primaryKey,
                    'toString',
                    $group
                );
            else
                $data = CHtml::listData(
                    $relation_class_name::model()->findAll('parent_restaurant_id is null AND (is_independent is NULL OR is_independent NOT LIKE 1)'),
                    $relation_class_name::model()->getTableSchema()->primaryKey,
                    'toString',
                    $group
                );
        }

        $html = $this->labelEx($model, $field);
        $html .= $this->widget('application.zii.widgets.jui.MyMultiSelect', array(
            'model' => $model,
            'attribute' => $field,
            'data' => $data,
            'htmlOptions' => array('class' => 'multiselect')
        ), true);
        $html .= $this->error($model, $field);

        return $html;
    }

    protected function myListBoxWithCount($model, $field, $group = '', $data = null)
    {
        $relation_class_name = $model->getMetaData()->relations[$field]->className;
        if ($data === null) {
            $data = CHtml::listData(
                isset($model->restaurant) ? $model->restaurant->products() : $relation_class_name::model()->findAll(),
                $relation_class_name::model()->getTableSchema()->primaryKey,
                'toString',
                $group
            );
        }

        $html = $this->labelEx($model, $field);
        $html .= '<div id="products-widget">';
        $html .= $this->widget('application.zii.widgets.jui.MyMultiSelectWithCount', array(
            'model' => $model,
            'attribute' => $field,
            'data' => $data,
            'htmlOptions' => array('class' => 'multiselect')
        ), true);
        $html .= '</div>';
        $html .= $this->error($model, $field);

        return $html;
    }
	
    protected function myColorPickerField($model, $field, $hidden = false, $options = array(), $htmlOptions = array())
    {
        $html = $this->labelEx($model, $field);
        $html .= $this->widget('ext.SMiniColors.SActiveColorPicker', array(
			'model' => $model,
			'attribute' => $field,
			'hidden' => $hidden, // defaults to false - can be set to hide the textarea with the hex
			'options' => $options, // jQuery plugin options
			'htmlOptions' => $htmlOptions, // html attributes
		), true);
        $html .= $this->error($model, $field);
        return $html;
    }

    public function StockMenuWithSpecPrice($model, $field, $data = null)
    {
        if ($data === null) {
            $data = CHtml::listData(MenuModel::model()->findAll(),'id','name_price');
        }

        $html = $this->labelEx($model, $field);
        $html .= '<div id="products-widget">';
        $html .= $this->widget('application.zii.widgets.jui.MyMultiSelectWithCount', array(
            'model' => $model,
            'attribute' => $field,
            'data' => $data,
            'htmlOptions' => array('class' => 'multiselect')
        ), true);
        $html .= '</div>';
        $html .= $this->error($model, $field);

        return $html;
    }

    protected function goodListWithPrice($model, $field, $group = '', $data = null)
    {
        $relation_class_name = $model->getMetaData()->relations[$field]->className;
        if ($data === null) {
            $data = CHtml::listData(
                isset($model->restaurant) ? $model->restaurant->products() : $relation_class_name::model()->findAll(),
                $relation_class_name::model()->getTableSchema()->primaryKey,
                'toString',
                $group
            );
        }

        $html = $this->labelEx($model, $field);
        $html .= '<div id="products-widget">';
        $html .= $this->widget('application.zii.widgets.jui.MyMultiSelectWithCount', array(
            'model' => $model,
            'attribute' => $field,
            'data' => $data,
            'htmlOptions' => array('class' => 'multiselect')
        ), true);
        $html .= '</div>';
        $html .= $this->error($model, $field);

        return $html;
    }

    protected function myDropDownList($model, $field)
    {
        if ($model->isAttributeEnumerable($field)) {
            $field_name = $field;
            $data = $model->getAttributeEnums($field);
        } else {
            $class_name = $model->getMetaData()->relations[$field]->className;
            $field_name = $model->getMetaData()->relations[$field]->foreignKey;
            $data = CHtml::listData(
                $class_name::model()->findAll(),
                $class_name::model()->getTableSchema()->primaryKey,
                'toString'
            );
        }

        if (!isset($data)) {
            throw new CException(
                'Класс MyActiveForm не нашел данных для аттрибута "' . $field . '" в модели "' . get_class($model) . '"'
            );
        }

        $html = $this->labelEx($model, $field_name);
        $html .= $this->dropDownList(
            $model,
            $field_name,
            $data,
            array('prompt' => '---')
        );
        $html .= $this->error($model, $field_name);

        return $html;
    }

    public function myRadioList($model, $field)
    {
        if ($model->isAttributeEnumerable($field)) {
            $field_name = $field;
            $data = $model->getAttributeEnums($field);
        } else {
            $class_name = $model->getMetaData()->relations[$field]->className;
            $field_name = $model->getMetaData()->relations[$field]->foreignKey;
            $data = CHtml::listData(
                $class_name::model()->findAll(),
                $class_name::model()->getTableSchema()->primaryKey,
                'toString'
            );
        }

        if (!isset($data)) {
            throw new CException(
                'Класс MyActiveForm не нашел данных для аттрибута "' . $field . '" в модели "' . get_class($model) . '"'
            );
        }

        $html = $this->labelEx($model, $field_name, array('class' => 'simple-label'));
        $html .= '<div class = "radioButtonList"> <br />';
        $html .= $this->radioButtonList(
            $model,
            $field_name,
            $data,
            array('prompt' => '---')
        );
        $html .= '</div>';
        $html .= $this->error($model, $field_name);

        return $html;
    }

    protected function myFileField($model, $field)
    {
        $html = $this->labelEx($model, $field);
        $html .= $this->fileField($model, $field);
        if (!$model->isNewRecord && !empty($model->$field)) {
            $html .= CHtml::link(
                CHtml::image($model->uploadTo($field), '', array('width' => '100')), $model->uploadTo($field),
                array('class' => 'file-field-preview')
            );
            $this->widget('application.extensions.EFancyBox.EFancyBox', array(
                'target' => 'a.file-field-preview',
                'config' => array(),
            ));
        }
        $html .= $this->error($model, $field);

        return $html;
    }

    protected function myAutoCompleteField($model, $field, $sourceUrl)
    {
        if (!isset($model->getMetaData()->columns[$field])) {
            throw new CException('Класс MyActiveForm не нашел аттрибута "' . $field . '" в модели "' . get_class($model) . '"');
        }

        $input_value = $model->$field;
        if ($model->getMetaData()->columns[$field]->isForeignKey) {
            foreach ($model->getMetaData()->relations as $model_relation) {
                if ($model_relation->foreignKey == $field) {
                    $input_value = $model->{$model_relation->name};
                    break;
                }
            }
        }

        $html = $this->labelEx($model, $field);
        $html .= $this->hiddenField($model, $field);
        $html .= $this->widget('application.zii.widgets.jui.MyJuiAutoComplete', array(
            'name' => $field . '_autocomplete',
            'sourceUrl' => $sourceUrl,
            'value' => $input_value,
            'htmlOptions' => array(
                'size' => 60,
            ),
            'options' => array(
                'select' => "js: function(event, ui) {
                    this.value = ui.item.label;
                    $(\"#" . get_class($model) . '_' . $field . "\").val(ui.item.id);
                    if ($.isFunction(" . $field . "_autocomplete_after)) {
                        " . $field . "_autocomplete_after(ui.item);
                    }
                    return false;
                }",
            ),
        ), true);
        $html .= $this->error($model, $field);

        return $html;
    }

    public function beginForm()
    {
        return '<div class="'.$this->beginDivClass.'" style="'.$this->beginDivStyle.'">';
    }

    public function endForm()
    {
        return '</div>';
    }

    public function beginField($class = "", $id = "")
    {
        return '<div class="row ' . $class . '" id="' . $id . '">';
    }

    public function endField()
    {
        return '</div>';
    }

    public function buttons($model, $redirect_buttons = array())
    {
        $html = '<div class="row buttons">';
        $html .= CHtml::submitButton(
            $model->isNewRecord ? Yii::t('application', 'Create') : Yii::t('application', 'Save')
        );

        if (!$model->isNewRecord) {
            $redirect_buttons = array_merge(array('Save and continue' => 'refresh'), $redirect_buttons);
            foreach ($redirect_buttons as $redirect_button_label => $redirect_button_url) {
                $html .= ' или ' . CHtml::submitButton(Yii::t('application', $redirect_button_label), array(
                    'onclick' => 'js:$("#redirect_to").val("' . $redirect_button_url . '");',
                ));
            }
            $html .= CHtml::hiddenField('redirect_to');
        } else {
            $redirect_buttons = array_merge(array('Create and continue' => 'refresh'), $redirect_buttons);
            foreach ($redirect_buttons as $redirect_button_label => $redirect_button_url) {
                $html .= ' или ' . CHtml::submitButton(Yii::t('application', $redirect_button_label), array(
                    'onclick' => 'js:$("#redirect_to").val("' . $redirect_button_url . '");',
                ));
            }
            $html .= CHtml::hiddenField('redirect_to');
        }

        //        $html .= '<div class="fr">';
        //        $html .= CHtml::submitButton(
        //            Yii::t('application', 'Cancel'),
        //            array(
        //                 'onclick' => 'js:window.location = "' . Yii::app()->createUrl('admin') . '"; return false;',
        //                 'class' => 'negative',
        //            )
        //        );
        //        $html .= '</div>';

        return $html;
    }

    public function button($model, $redirect_buttons = array())
    {
        $html = '<div class="row buttons">';
        $html .= CHtml::submitButton(
            $model->isNewRecord ? Yii::t('application', 'Create') : Yii::t('application', 'Save')
        );

        if (!$model->isNewRecord) {
            $html .= CHtml::hiddenField('redirect_to');
        } else {
            $html .= CHtml::hiddenField('redirect_to');
        }

        return $html;
    }

}
