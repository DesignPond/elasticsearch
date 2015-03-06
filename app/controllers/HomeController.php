<?php

class HomeController extends BaseController {

    public function index()
    {
        $grab = new \Droit\Service\GrabWorker;

        $url = 'http://www.admin.ch/opc/fr/classified-compilation/19950278/index.html';

        $premb = '';
        $content = [];
        // $html = $grab->getPage($url);

        $thtml = new \Htmldom();

        $html = $thtml->file_get_html($url);

        foreach($html->find('div[id=content]') as $element)
        {
            foreach($element->find('div[id=toolbar]') as $tool)
            {
                $tool->outertext = '';
            }

            // premabule
            $preambule = $element->find('div',1);

            $content['preambule'] = $preambule->innertext;

            $preambule->outertext = null;

            $ancres = $element->find('a[name^=id-]');

            $i = 1;
            foreach($ancres as $ancre)
            {


                $next = $ancre->next_sibling();
                $no   = ['kopf','praeambel'];

                if( !in_array($ancre->name,$no) )
                {

                    $ancre_name = explode('-', $ancre->name);

                    if(count($ancre_name) < 3){

                        $content['loi'][$i]['ancre'] = $ancre->name;

                        if($next)
                        {
                            if($next->class == 'title') {
                                $content['loi'][$i]['title'] = $next->outertext;
                            }

                            $article = $next->next_sibling();

                            if($article)
                            {
                                if($article->class == 'collapseable')
                                {
                                    $content['loi'][$i]['content'] = $article->innertext;
                                }

                                $content['loi'][$i]['paragraphes'] = $this->getSameSibling($article);
                            }
                        }

                    }

                }

                $i++;
            }

            foreach($element->find('div#app1') as $annexes){

                $content['annexe'] = $annexes->innertext;

                $ro = $annexes->next_sibling();

                if($ro)
                {
                    $ro_ = $ro->next_sibling();
                    if($ro_) {

                        $content['RO'] = $ro_->innertext;
                    }
                }

                $i++;
            }

            foreach($element->find('div.fns') as $notes){

                $content['notes'] = $notes->innertext;

                $i++;
            }

        }

        return View::make('index')->with(array('article' => $premb, 'content' => $content));
    }

    public function getSameSibling($element){

        $content = [];

        $para = $element->next_sibling();

        if($para && $para->tag == 'p')
        {
            if(!empty($para->innertext))
            {
                $content[] = $para->innertext;
                $content = array_merge($content, $this->getSameSibling($para));
            }
        }

        return $content;
    }

    public function arretf(){

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
        $elements = str_replace("<p>  </p>", "", $elements);
        $elements = str_replace("<p>&nbsp; </p>", "", $elements);

        return View::make('index')->with(array('article' => $elements));
    }

}
