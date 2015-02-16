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

			foreach($element->find('div[class=para]') as $table)
			{
				if(!empty($table->innertext) && $table->innertext != '&nbsp;')
				{
					$elements .= '<p>'.$table->innertext.'</p>';
				}
			}

			foreach($element->find('table') as $tablerow)
			{
				$tablerow->outertext = null;
			}

			if(!empty($string))
			{
				foreach($element->find('img') as $image)
					$elements .= '<img width="200px" src="'. $image->src .'">';

				$elements .= '<p>'.$string.'</p>';
			}
		}

		$elements = str_replace("<p>&nbsp;</p>", "", $elements);
		$elements = str_replace("<p>&nbsp; </p>", "", $elements);

		return View::make('index')->with(array('article' => $elements));
	}

}
