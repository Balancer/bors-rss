<?php

namespace B2\Rss\Yandex\Turbo;

class Item extends \bal_suin_rsswriter_item
{
	function asXML()
	{
		$xml = parent::asXML();

		$xml->addAttribute('turbo', 'true');

		$xml->addChild('turbo:content', $this->rss->item_yandex_turbo($this->item), 'http://news.yandex.ru');

		return $xml;
	}
}
