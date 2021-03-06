<?php
require_once('./include/inc.ilias_version.php');
require_once('./Services/Component/classes/class.ilComponent.php');

/**
 * Class ctrlmm
 *
 * @author  Fabian Schmid <fs@studer-raimann.ch>
 * @version 1.0.0
 */
class ctrlmm {

	const ILIAS_50 = 50;
	const ILIAS_51 = 51;
	const MIN_ILIAS_VERSION = self::ILIAS_50;


	/**
	 * @return int
	 */
	public static function getILIASVersion() {
		if (strpos(ILIAS_VERSION_NUMERIC, " ") !== false) {
			$a_ver1 = substr(ILIAS_VERSION_NUMERIC, 0, strpos(ILIAS_VERSION_NUMERIC, " "));
		} else {
			$a_ver1 = ILIAS_VERSION_NUMERIC;
		}
		if (ilComponent::isVersionGreaterString($a_ver1, '5.0.999')) {
			return self::ILIAS_51;
		}
		if (ilComponent::isVersionGreaterString($a_ver1, '4.9.999')) {
			return self::ILIAS_50;
		}

		return 0;
	}


	/**
	 * @return bool
	 */
	public static function isILIASSupported() {
		return self::getILIASVersion() >= self::MIN_ILIAS_VERSION;
	}


	/**
	 * @return bool
	 */
	public static function is50() {
		return self::getILIASVersion() >= self::ILIAS_50;
	}


	/**
	 * @return bool
	 */
	public static function is51() {
		return self::getILIASVersion() >= self::ILIAS_51;
	}


	/**
	 * @return bool
	 */
	public static function isGlobalCacheActive() {
		static $has_global_cache;
		if (!isset($has_global_cache)) {
			$has_global_cache = ilCtrlMainMenuConfig::getConfigValue('activate_cache')
			AND self::hasGlobalCache();
		}

		return $has_global_cache;
	}


	/**
	 * @return bool
	 */
	public static function hasGlobalCache() {
		return is_file('./Services/GlobalCache/classes/class.ilGlobalCache.php');
	}
}


