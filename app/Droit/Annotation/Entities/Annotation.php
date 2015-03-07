<?php namespace Droit\Annotation\Entities;

class Annotation extends \Eloquent {

	protected $fillable = ['url','annotations'];

    public static $rules = array();
    public static $messages = array();

}