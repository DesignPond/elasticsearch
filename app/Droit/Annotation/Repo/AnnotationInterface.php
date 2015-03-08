<?php namespace Droit\Annotation\Repo;

interface AnnotationInterface {

    public function findByUrl($uri);
    public function find($data);
    public function create(array $data);
    public function update(array $data);
    public function delete($id);

}
