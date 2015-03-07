<?php namespace Droit\Annotation\Repo;

use Droit\Annotation\Repo\AnnotationInterface;
use Droit\Annotation\Entities\Annotation as M;

class AnnotationEloquent implements AnnotationInterface{

    protected $annotation;

    public function __construct(M $annotation)
    {
        $this->annotation = $annotation;
    }

    public function findByUrl($url){

        return $this->annotation->where('url','=',$url)->get();
    }

    public function find($id){

        //return $this->annotation->with(array('annotation_arrets'))->findOrFail($id);
    }

    public function findyByImage($file){

       // return $this->annotation->where('image','=',$file)->where('deleted', '=', 0)->get();
    }

    public function create(array $data){

        $annotation = $this->annotation->create(array(
            'url'         => $data['url'],
            'annotations' => serialize($data['annotations']),
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

        $annotation->title      = $data['title'];
        $annotation->ismain     = $data['ismain'];
        $annotation->hideOnSite = $data['hideOnSite'];

        if(!empty($data['image'])){
            $annotation->image = $data['image'];
        }

        $annotation->updated_at = date('Y-m-d G:i:s');
        $annotation->save();

        return $annotation;
    }

    public function delete($id){

        $annotation = $this->annotation->find($id);

        return $annotation->delete();
    }

}
