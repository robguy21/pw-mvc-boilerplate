<?php
/**
 * Trait for Twitter cards - similar to the Open Graph protocol
 */

trait Twitter {
	static function __twInitialize($obj) {
		$obj->helper('twitter_meta_tags');
	}

	private $__tw_opts = array(
		'card' => 'summary',
		'site' => false,
		'creator' => false,
	);

	private $__tw_custom_tags = [];

	protected function tw_get_handle() {
		return $this->__tw_get_handle();
	}

	protected function tw_set_opt($opt, $value) {
		$this->__tw_opts[$opt] = $value;
	}

	protected function tw_add_tag($tag, $value) {
		$this->__tw_custom_tags[$tag] = $value;
	}

	function twitter_meta_tags() {
		$this->__tw_opts['handle'] = $this->__tw_get_handle();

		$tags = array(
			'card' => $this->__tw_opts['card'],
			'site' => $this->__tw_opts['site'] ? $this->__tw_opts['site'] : $this->__tw_opts['handle'],
			'creator' => $this->__tw_opts['creator'] ? $this->__tw_opts['creator'] : $this->__tw_opts['handle'],
		);

		$tags = array_merge($tags, $this->__tw_custom_tags);

		return $this->__tw_render_tags($tags);
	}

	// relies on only a username (without '@') provided to an account_twitter field
	private function __tw_get_handle() {
		$pages = $this->pages;
		$handle = $pages->get('/settings')->account_twitter;

		if ($handle) {
			return '@' . $handle;
		}

		return null;
	}

	private function __tw_render_tags($tags) {
		$html = '';
		foreach ($tags as $name => $value) {
			if ($value !== null) {
				$html .= $this->__tw_tag_markup($name, $value);
			}
		}

		return $html;
	}

	private function __tw_tag_markup($name, $value) {
		return "<meta property='twitter:{$name}' value='{$value}'/>";
	}
}


