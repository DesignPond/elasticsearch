<?php

use Droit\Service\LoiConverter;

class PreambuleTest extends TestCase {

    protected $thtml;
    protected $preambule;

    public function __construct()
    {
        $this->converter = new LoiConverter();
        $this->preambule = '<div id="preambule">
                <a name="kopf"></a>
                <h1>251</h1>
                <h1>Loi fédérale sur les cartels et autres restrictions à la concurrence</h1>
                <h2>(Loi sur les cartels, LCart)</h2>
                <p>du 6 octobre 1995 (Etat le 1<sup>er</sup> décembre 2014)</p>
                <div>
                    <a name="praeambel"></a>
                    <p><em>L\'Assemblée fédérale de la Confédération suisse,</em></p>
                    <p>vu les art. 27, al. 1, 96<sup><a href="#fn1">1</a></sup>, 97, al. 2, et 122<sup><a href="#fn2">2</a></sup> de la Constitution<sup>
                    <a href="#fn3">3</a></sup>,<sup>
                    <a href="#fn4">4</a></sup> en application des dispositions du droit de la concurrence des accords internationaux, vu le message du Conseil fédéral du 23 novembre 1994<sup>
                    <a href="#fn5">5</a></sup>,</p><p><em>arrête:</em></p>
                    </div>
                </div>';
    }

    /**
	 * Numero Loi
	 */
	public function testGetNumeroExample()
	{
        $title  = $this->converter->getNumeroTitle($this->preambule);
        $expect = '<h1>251</h1>';

        $this->assertEquals($expect,$title);
    }

    /**
     * Forme Loi
     */
    public function testGetFormeExample()
    {
        $title  = $this->converter->getFormeTitle($this->preambule);
        $expect = 'Loi fédérale sur les cartels et autres restrictions à la concurrence';

        $this->assertEquals($expect,$title);
    }

    /**
     * Acte Loi
     */
    public function testGetActeExample()
    {
        $title  = $this->converter->getFormeTitle($this->preambule);
        $title  = $this->converter->setActeTitle($title);
        $expect = '<h1><span id="acte-titre">Loi fédérale</span> sur les cartels et autres restrictions à la concurrence</h1>';

        $this->assertEquals($expect,$title);
    }

}
