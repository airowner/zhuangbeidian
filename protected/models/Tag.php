<?php

/**
 * This is the model class for table "tag".
 *
 * The followings are the available columns in table 'tag':
 * @property integer $id
 * @property string $tag
 * @property integer $pid
 * @property integer $display_html
 * @property integer $order
 * @property integer $validate
 * @property string $time
 */
class Tag extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Tag the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function getGame()
    {
        return self::model()->findAllBySql('select * from tag where `pid`="1" and `validate`=1 and `display_html`=1 order by `order` desc');
    }

    public static function getCategory()
    {
        $cates = array();
        $pids = array();
        $parents = self::model()->findAllBySql('select * from tag where `pid`="2" and `validate`=1 and `display_html`=1 order by `order` desc');
        foreach($parents as $p){
            $cates[$p->id] = array('id'=>$p->id, 'tag'=>$p->tag, 'sub'=>array());
            $pids[] = $p->id;
        }
        $subcate = self::model()->findAllBySql('select * from tag where `pid` in ('.implode(',', $pids).') and `validate`=1 and `display_html`=1 order by `order` desc');
        foreach($subcate as $sub){
            $cates[$sub->pid]['sub'][] = array('id'=>$sub->id, 'tag'=>$sub->tag);
        }
        return $cates;
    }

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tag';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tag, time', 'required'),
			array('pid, display_html, order, validate', 'numerical', 'integerOnly'=>true),
			array('tag', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, tag, pid, display_html, order, validate, time', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'tag' => 'Tag',
			'pid' => 'Pid',
			'display_html' => 'Display Html',
			'order' => 'Order',
			'validate' => 'Validate',
			'time' => 'Time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);

		$criteria->compare('tag',$this->tag,true);

		$criteria->compare('pid',$this->pid);

		$criteria->compare('display_html',$this->display_html);

		$criteria->compare('order',$this->order);

		$criteria->compare('validate',$this->validate);

		$criteria->compare('time',$this->time,true);

		return new CActiveDataProvider('Tag', array(
			'criteria'=>$criteria,
		));
	}
}
