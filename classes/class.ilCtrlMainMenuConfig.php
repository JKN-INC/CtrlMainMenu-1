<?php

/**
 * Class Configuration
 *
 * @author Michael Heren <mh@studer-raimann.ch>
 * @author Fabian Schmid <fs@studer-raimann.ch>
 */
class ilCtrlMainMenuConfig extends ActiveRecord {

	const F_CSS_PREFIX = 'css_prefix';
	const F_CSS_ACTIVE = 'css_active';
	const F_CSS_INACTIVE = 'css_inactive';
	const F_DOUBLECLICK_PREVENTION = 'doubleclick_prevention';
	const F_SIMPLE_FORM_VALIDATION = 'simple_form_validation';
	const F_REPLACE_FULL_HEADER = "replace_full_header";
	/**
	 * @var array
	 */
	protected static $cache = array();
	/**
	 * @var array
	 */
	protected static $cache_loaded = array();
	/**
	 * @var bool
	 */
	protected $ar_safe_read = false;


	/**
	 * @return string
	 */
	public static function returnDbTableName() {
		return ilCtrlMainMenuPlugin::CONFIG_TABLE;
	}


	/**
	 * @param $name
	 *
	 * @return string
	 */
	public static function getConfigValue($name) {
		if (!isset(self::$cache_loaded[$name])) {
			/**
			 * @var $obj ilCtrlMainMenuConfig
			 */
			$obj = self::find($name);
			if ($obj === NULL) {
				self::$cache[$name] = NULL;
			} else {
				self::$cache[$name] = $obj->getFieldValue();
			}
			self::$cache_loaded[$name] = true;
		}

		return self::$cache[$name];
	}


	/**
	 * @param $name
	 * @param $value
	 *
	 * @return null
	 */
	public static function set($name, $value) {
		/**
		 * @var $obj ilCtrlMainMenuConfig
		 */
		$obj = self::findOrGetInstance($name);
		$obj->setFieldValue($value);
		if (self::where(array( 'name_key' => $name ))->hasSets()) {
			$obj->update();
		} else {
			$obj->create();
		}
	}


	/**
	 * @var string
	 *
	 * @db_has_field        true
	 * @db_is_unique        true
	 * @db_is_primary       true
	 * @db_is_notnull       true
	 * @db_fieldtype        text
	 * @db_length           250
	 */
	protected $name_key;
	/**
	 * @var string
	 *
	 * @db_has_field        true
	 * @db_fieldtype        text
	 * @db_length           1000
	 */
	protected $field_value;


	/**
	 * @param string $field_value
	 */
	public function setFieldValue($field_value) {
		$this->field_value = $field_value;
	}


	/**
	 * @return string
	 */
	public function getFieldValue() {
		return $this->field_value;
	}


	/**
	 * @param string $name_key
	 */
	public function setNameKey($name_key) {
		$this->name_key = $name_key;
	}


	/**
	 * @return string
	 */
	public function getNameKey() {
		return $this->name_key;
	}
}