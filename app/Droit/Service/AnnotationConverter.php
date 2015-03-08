<?php namespace Droit\Service;

class AnnotationConverter{

    public function convert($annotation)
    {

        $new = [
            'id' => $annotation->id,
            'annotator_schema_version' => 'v1.0',
            'created'  => $annotation->created_at,
            'updated'  => $annotation->updated_at,
            'text'     => $annotation->text,
            'quote'    => $annotation->quote,
            'tags'     => unserialize($annotation->tags),
            'uri'      => $annotation->uri,
            'ranges'   => unserialize($annotation->ranges),
            'user'     => 1,
            'consumer' => 'elastic',
        ];

        return $new;

    }

}