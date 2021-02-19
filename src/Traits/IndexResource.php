<?php 
namespace ImFranq\LaravelResource\Traits;

use Illuminate\Support\Str;

trait IndexResource
{
    use Common\PropertiesResource;
    use Common\ViewResource;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->renderView(
            $this->moduleName != null ? Str::plural($this->moduleName) . '.index' : 'index' ,
            $this->indexData()
        );
    }

    /**
     * Return the data to use in the view
     * 
     * @return Array
     */
    public function indexData()
    {
        $data = [];
        
        if( $this->moduleName != null ) 
            $data[Str::plural($this->moduleName)] = $this->eloquentModel::get();

        return $data;
    }
}
