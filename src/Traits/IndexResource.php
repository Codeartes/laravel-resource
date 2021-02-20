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
        if(request()->expectsJson()) return response()->json($this->indexModelQueryResponse());

        return $this->renderView(
            $this->moduleName != null ? Str::plural($this->moduleName) . '.index' : 'index' ,
            $this->indexResponse()
        );
    }

    /**
     * Return the data to use in the view
     * 
     * @return Array
     */
    public function indexResponse()
    {
        $data = [];
        
        if( $this->moduleName != null ) 
            $data[Str::plural($this->moduleName)] = $this->indexModelQueryResponse();

        return $data;
    }

    /**
     * Define query response to show method
     * 
     * @return Illuminate\Database\Eloquent\Model
     */
    public function indexModelQueryResponse(){
        return $this->eloquentModel::get();
    }
}
