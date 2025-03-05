<?php

/**
 * UOJLocale类用于处理本地化相关操作，包括设置和获取语言环境以及本地化模块的加载
 */
class UOJLocale {
	// 支持的本地化语言列表
	public static $supported_locales = array('en', 'zh-cn', 'rus', 'ger', 'fra', 'spa', 'por');
	// 支持的本地化模块列表
	public static $supported_modules = array('basic', 'contests', 'problems', 'faq', 'mainpage');
	// 本地化数据存储数组
	public static $data = array();
	// 已加载的模块列表
	public static $required = array();

	/**
	 * 获取当前的语言环境
	 *
	 * @return string 当前的语言环境代码，如果无法确定则返回默认语言'en'
	 */
	public static function locale() {
		// 从Cookie中获取用户选择的语言环境
		$locale = Cookie::get('uoj_locale');
		// 如果获取的语言环境不被支持，则重置Cookie并返回null
		if ($locale != null && !in_array($locale, self::$supported_locales)) {
			$locale = null;
			Cookie::unsetVar('uoj_locale', '/');
		}
		// 如果语言环境为null，使用默认语言'en'
		if ($locale == null) {
			$locale = 'en';
		}
		// var_dump($locale);
		return $locale;
	}

	/**
	 * 设置用户语言环境并更新Cookie
	 *
	 * @param string $locale 要设置的语言环境代码
	 * @return bool 成功设置返回true，否则返回false
	 */
	public static function setLocale($locale) {
		// 检查语言环境是否被支持
		if (!in_array($locale, self::$supported_locales)) {
			return false;
		}
		// 设置Cookie，有效期为10年
		return Cookie::set('uoj_locale', $locale, time() + 60 * 60 * 24 * 365 * 10, '/');
	}

	/**
	 * 加载并要求本地化模块
	 *
	 * @param string $name 要加载的本地化模块名称
	 */
	public static function requireModule($name) {
		// 避免重复加载同一模块
		if (in_array($name, self::$required)) {
			return;
		}
		self::$required[] = $name;
		// 包含本地化数据文件
		$data = include($_SERVER['DOCUMENT_ROOT'].'/app/locale/'.$name.'/'.self::locale().'.php');

		// 确定数据前缀，用于组织数据键
		$pre = $name == 'basic' ? '' : "$name::";
		// 加载本地化数据
		foreach ($data as $key => $val) {
			self::$data[$pre.$key] = $val;
		}
	}

	/**
	 * 获取本地化数据项
	 *
	 * @param string $name 要获取的数据项名称
	 * @return mixed 如果数据项存在则返回其值，否则返回false
	 */
	public static function get($name) {
		// 检查数据项是否已加载，如果没有则尝试加载对应的模块
		// print_r(self::$data);
		if (!isset(self::$data[$name])) {

			$module_name = strtok($name, '::');
			if (!in_array($module_name, self::$supported_modules)) {
				return false;
			}
			self::requireModule($module_name);
		}
		// 再次检查数据项是否已加载
		if (!isset(self::$data[$name])) {
			return false;
		}
		// 根据数据项类型返回值或调用回调函数
		if (is_string(self::$data[$name])) {
			return self::$data[$name];
		} else {
			return call_user_func_array(self::$data[$name], array_slice(func_get_args(), 1));
		}
	}
}
