<?php

use Droit\Annotation\Repo\AnnotationInterface;
use Droit\Service\AnnotationConverter;

class AnnotationController extends BaseController {

    protected $annotation;
    protected $converter;

    public function __construct(AnnotationInterface $annotation, AnnotationConverter $converter)
    {
        $this->annotation = $annotation;
        $this->converter  = $converter;
    }

    public function index()
    {
        $out = array(
            'name'    => "Annotator Store API (PHP)",
            'version' => '1.0.0',
            'author'  => '@DesignPond'
        );

        return Response::json( $out , 200 );
    }

    /**
     * Create the specified resource from storage.
     * POST /annotations
     *
     * @return Response
     */
    public function store()
    {
        $uri     = Input::get('uri');
        $text    = Input::get('text');
        $ranges  = Input::get('ranges');
        $quote   = Input::get('quote');
        $tags    = Input::get('tags');

        $result = $this->annotation->create(['tags' => $tags, 'quote' => $quote, 'text' => $text, 'ranges' => $ranges, 'uri' => $uri]);

        return Response::json( $result , 200 );
    }

    /**
     * Update the specified resource from storage.
     * PUT /annotations/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $uri     = Input::get('uri');
        $text    = Input::get('text');
        $ranges  = Input::get('ranges');
        $quote   = Input::get('quote');
        $tags    = Input::get('tags');

        $result = $this->annotation->update(['id' => $id, 'tags' => $tags, 'quote' => $quote, 'text' => $text, 'ranges' => $ranges, 'uri' => $uri]);

        return Response::json( $result , 200 );
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /annotations/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->annotation->delete($id);

        return Response::json('ok' , 200 );
    }

    public function search()
    {
        $uri    = Input::get('uri');
        $result = $this->annotation->findByUrl($uri);
        $annotations = [];

        if(!$result->isEmpty())
        {
            $annotations = [
                'total' => $result->count()
            ];

            foreach($result as $ann)
            {
                $new = $this->converter->convert($ann);
                $annotations['rows'][] = $new;
            }
        }

        return Response::json( $annotations , 200 );
    }

}
