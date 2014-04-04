<?php

\fixate\Php::require_all(TEMPLATE_DIR.'/controllers/traits');

class ApplicationController extends Controller {
	use Javascript;
	use OpenGraph;
	use PrimaryNav;
	use SEO;
	use Search;
	use VideoEmbed;
	use Utils;

	function initialize() {
		Javascript::__jsInitialize($this);
		OpenGraph::__ogInitialize($this);
		PrimaryNav::__pnInitialize($this);
		SEO::__seoInitialize($this);
		Search::__searchInitialize($this);
		VideoEmbed::__vidembedInitialize($this);
		Utils::__utilsInitialize($this);

		$this->js_add_cdn(
			'//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js',
			'window.jQuery',
			'vendor/jquery/jquery.js'
		);
	}

  // Fallback index
  function index() {
		return $this->render($this->config->page->template->name);
  }
}

