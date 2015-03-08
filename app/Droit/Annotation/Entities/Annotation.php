<?php namespace Droit\Annotation\Entities;

class Annotation extends \Eloquent {

	protected $fillable = ['uri','text','ranges','quote'];

    public static $rules = array();
    public static $messages = array();

}