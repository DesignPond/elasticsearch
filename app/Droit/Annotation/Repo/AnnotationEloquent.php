<?php namespace Droit\Annotation\Repo;

use Droit\Annotation\Repo\AnnotationInterface;
use Droit\Annotation\Entities\Annotation as M;

class AnnotationEloquent implements AnnotationInterface{

    protected $annotation;

    public function __construct(M $annotation)
    {
        $this->annotation = $annotation;
    }

    public function findByUrl($uri){

        return $this->annotation->where('uri','=',$uri)->get();
    }

    public function find($id){

        return $this->annotation->findOrFail($id);
    }

    public function create(array $data){

        $annotation = $this->annotation->create(array(
            'uri'         => $data['uri'],
            'text'        => $data['text'],
            'quote'       => $data['quote'],
            'tags'        => $data['tags'],
            'ranges'      => serialize($data['ranges']),
            'created_at'  => date('Y-m-d G:i:s'),
            'updated_at'  => date('Y-m-d G:i:s')
        ));

        if( ! $annotation )
        {
            return false;
        }

        return $annotation;

    }

    public function update(array $data){

        $annotation = $this->annotation->findOrFail($data['id']);

        if( ! $annotation )
        {
            return false;
        }

        $annotation->uri    = $data['uri'];
        $annotation->text   = $data['text'];
        $annotation->quote  = $data['quote'];
        $annotation->tags   = serialize($data['tags']);
        $annotation->ranges = serialize($data['ranges']);

        $annotation->updated_at = date('Y-m-d G:i:s');
        $annotation->save();

        return $annotation;
    }

    public function delete($id){

        return  $this->annotation->delete($id);
    }

}
