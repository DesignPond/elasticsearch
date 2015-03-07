<?php namespace Droit;

use Illuminate\Support\ServiceProvider;
use Droit\Annotation\Entities\Annotation as Annotation;


/**
 *  DroitServiceProvider
 */
class DroitServiceProvider extends ServiceProvider {

	/**
	 * Register binding interface to implementation 
	 */
    public function register()
    {         	
		$this->registerAnnotationService();
    }

	/**
	 * registerAnnotationService
	 */     
    protected function registerAnnotationService(){
    
	    $this->app->bind('Droit\Annotation\Repo\AnnotationInterface', function()
        {
            return new \Droit\Annotation\Repo\AnnotationEloquent( new Annotation );
        });        
    }


}