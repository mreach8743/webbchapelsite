<?php
if (!defined("ROOT_PATH"))
{
	header("HTTP/1.1 403 Forbidden");
	exit;
}
require_once dirname(__FILE__) . '/pjLocaleApp.model.php';
class pjLocaleModel extends pjLocaleAppModel
{
	protected $primaryKey = 'id';
	
	protected $table = 'plugin_locale';
	
	protected $schema = array(
		array('name' => 'id', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'language_iso', 'type' => 'varchar', 'default' => ':NULL'),
		array('name' => 'sort', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'is_default', 'type' => 'tinyint', 'default' => ':NULL')
	);
	
	public static function factory($attr=array())
	{
		return new pjLocaleModel($attr);
	}
	
	public function pjActionSetup()
	{
		$field_arr = array(
			0 => array('plugin_locale_languages', 'Locale plugin / Languages'),
			1 => array('plugin_locale_titles', 'Locale plugin / Titles'),
			2 => array('plugin_locale_index_title', 'Locale plugin / Languages info title'),
			3 => array('plugin_locale_index_body', 'Locale plugin / Languages info body'),
			4 => array('plugin_locale_titles_title', 'Locale plugin / Titles info title'),
			5 => array('plugin_locale_titles_body', 'Locale plugin / Titles info body'),
			6 => array('plugin_locale_lbl_title', 'Locale plugin / Title'),
			7 => array('plugin_locale_lbl_flag', 'Locale plugin / Flag'),
			8 => array('plugin_locale_lbl_is_default', 'Locale plugin / Is default'),
			9 => array('plugin_locale_lbl_order', 'Locale plugin / Order'),
			10 => array('plugin_locale_add_lang', 'Locale plugin / Add Language'),
			11 => array('plugin_locale_lbl_field', 'Locale plugin / Field'),
			12 => array('plugin_locale_lbl_type', 'Locale plugin / Type'),
			13 => array('plugin_locale_lbl_value', 'Locale plugin / Value'),
			14 => array('plugin_locale_type_backend', 'Locale plugin / Back-end title'),
			15 => array('plugin_locale_type_frontend', 'Locale plugin / Front-end title'),
			16 => array('plugin_locale_type_arrays', 'Locale plugin / Special title'),
			17 => array('error_titles_ARRAY_PAL01', 'Locale plugin / Status title', 'arrays'),
			18 => array('error_bodies_ARRAY_PAL01', 'Locale plugin / Status body', 'arrays')
		);
		
		$multi_arr = array(
			0 => array('Languages'),
			1 => array('Titles'),
			2 => array('Languages'),
			3 => array('Add as many languages as you need to your script. For each of the languages added you need to translate all the text titles.'),
			4 => array('Titles'),
			5 => array('Edit all page titles. Use the search box to quickly locate a title.'),
			6 => array('Title'),
			7 => array('Flag'),
			8 => array('Is default'),
			9 => array('Order'),
			10 => array('Add Language'),
			11 => array('Field'),
			12 => array('Type'),
			13 => array('Value'),
			14 => array('Back-end title'),
			15 => array('Front-end title'),
			16 => array('Special title'),
			17 => array('Titles Updated'),
			18 => array('All the changes made to titles have been saved.')
		);
		
		$pjFieldModel = pjFieldModel::factory();
		$pjMultiLangModel = pjMultiLangModel::factory();
		$locale_arr = pjLocaleModel::factory()->findAll()->getDataPair('id', 'id');
		
		foreach ($field_arr as $key => $field)
		{
			$insert_id = $pjFieldModel->reset()->setAttributes(array(
				'key' => $field[0],
				'type' => !isset($field[2]) ? 'backend' : $field[2],
				'label' => $field[1]
			))->insert()->getInsertId();
			if ($insert_id !== false && (int) $insert_id > 0)
			{
				foreach ($locale_arr as $locale)
				{
					$pjMultiLangModel->reset()->setAttributes(array(
						'foreign_id' => $insert_id,
						'model' => 'pjField',
						'locale' => $locale,
						'field' => 'title',
						'content' => $multi_arr[$key][0]
					))->insert();
				}
			}
		}
	}
}
?>