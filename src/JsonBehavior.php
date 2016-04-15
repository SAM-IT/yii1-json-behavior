<?php
	namespace SamIT\Yii1\Behaviors;
	/**
	 * JsonBehavior
	 * Automatically converts to / from json before saving / after reading.
	 *
     *  
	 * Author: Sam Mousa <sam@befound.nl>
	 * Version: 1.0
	 */

	class JsonBehavior  extends \CActiveRecordBehavior
	{
        /**
         * @var string[] List of attribute names that need to be encoded.
         */
		public $jsonAttributes = [];

		public function beforeSave($event)
		{
			foreach($this->jsonAttributes as $key => $attribute)
			{
				if (is_string($key))
				{
					$this->owner->$attribute = json_encode($this->owner->$key);
				}
				else
				{
					$this->owner->$attribute = json_encode($this->owner->$attribute);
				}
			}
			return true;
		}

		public function afterFind($event)
		{
			foreach($this->jsonAttributes as $key => $attribute)
			{
				if (is_string($key))
				{
					$this->owner->$key = json_decode($this->owner->$attribute, true);
				}
				else
				{
					$this->owner->$attribute = json_decode($this->owner->$attribute, true);
				}
			}
			return true;
		}

		public function afterSave($event)
		{
			foreach($this->jsonAttributes as $key => $attribute)
			{
				if (!is_string($key))
				{
					$this->owner->$attribute = json_decode($this->owner->$attribute, true);
				}
			}
			return true;
		}


	}
