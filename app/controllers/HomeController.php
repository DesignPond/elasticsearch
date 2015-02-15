<?php

class HomeController extends BaseController {

	public function index()
	{
		$grab = new \Droit\Service\GrabWorker;

		$url  = 'http://relevancy.bger.ch/php/aza/http/index.php?lang=fr&zoom=&type=show_document&highlight_docid=aza%3A%2F%2F19-11-2014-4A_271-2014';
		$host = 'http://relevancy.bger.ch/';

		$elements = '';
		// $html = $grab->getPage($url);
		$thtml = new \Htmldom();
		$html  = $grab->getArticle($url,$host);
		$html1 = $thtml->str_get_html($html);

		foreach($html1->find('div[class=para]') as $element)
		{
			$string = $grab->trim_all($element->innertext);

			if(!empty($string))
			{
				foreach($element->find('table tr td') as $table){
					$child = $grab->trim_all($table->innertext);
					if(isset($child)){
						$elements .= '<strong>'. $child .'</strong>';
					}
				}

				$elements .= '<p>'.$string.'</p>';
			}
		}

		return View::make('index')->with(array('article' => $elements));
	}

}
