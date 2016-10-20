<?php

class bors_rss extends base_rss
{
	function _title_def() { throw new Exception(_('Не указан заголовок RSS-ленты')); }
	function _main_url_def() { throw new Exception(_('Не указан полный URL RSS-ленты')); }
	function _items_class_name_def() { throw new Exception(_('Не указан класс объектов RSS-ленты')); }

	function _limit_def() { return 20; }
	function _order_def() { return '-create_time'; }
	function _where_def() { return array(); }

	function rss_items()
	{
		return bors_find_all($this->items_class_name(), array_merge(array(
			'order' => $this->order(),
			'limit' => $this->limit(),
		), $this->where()));
	}

//	function main_url() { return $this->called_url(); }
	function rss_url()  { return $this->called_url(); }

	function language() { return 'ru'; }

	function parse_template($template_or_suffix, $data)
	{
		// .item.html -> news.item.html
		if($template_or_suffix[0] == '.')
		{
			bors_lib_page::smart_body_template_check($this, substr($template_or_suffix, 1));
			$template = $this->body_template();
		}
		else
			$template = $template_or_suffix;

		return bors_templates_smarty::fetch($template, $data);
	}
}
