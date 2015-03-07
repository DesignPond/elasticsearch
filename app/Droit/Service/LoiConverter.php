<?php namespace Droit\Service;

class LoiConverter{

    protected $thtml;

    public function __construct()
    {
        $this->thtml = new \Yangqi\Htmldom\Htmldom();
    }

    public function getNumeroTitle($content)
    {
        $this->thtml->load($content);
        $title  = $this->thtml->find('h1',0);

        if($title){
           return $title->outertext;
        }

        return '';

    }

    public function getFormeTitle($content)
    {
        $this->thtml->load($content);
        $title  = $this->thtml->find('h1',1);

        if($title){
            return $title->innertext;
        }

        return '';

    }

    public function setActeTitle($title){

        $loi    = 'Loi fédérale';
        $rest   = str_replace($loi, "", $title);

        $format = '<h1><span id="acte-titre">%s</span>%s</h1>';

        return sprintf($format, $loi, $rest);

    }
}