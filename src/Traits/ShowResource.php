<?php 
namespace ImFranq\LaravelResource\Traits;

use Illuminate\Support\Str;

trait ShowResource
{
    use Common\PropertiesResource;
    use Common\ViewResource;

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        if( $this->checkShowModelRequest() ) return abort(404, "Resource not found");

        if(request()->expectsJson()) return response()->json($this->showModelQueryResponse($id));

        return $this->renderView(
            $this->moduleName != null ? Str::plural($this->moduleName) . '.show' : 'show' ,
            $this->showResponse($id)
        );
    }

    /**
     * Return the data to use in the view
     * 
     * @param  int  $id
     * @return Array
     */
    public function showResponse($id)
    {
        return [
            Str::singular($this->moduleName) => $this->showModelQueryResponse($id)
        ];
    }
    
    /**
     * Define query response to show method
     * 
     * @param  int  $id
     * @return Illuminate\Database\Eloquent\Model
     */
    public function showModelQueryResponse($id){
        return $this->eloquentModel::find($id);
    }

    /**
     * Validate if the model can be showed
     * 
     * @param  int  $id
     * @return boolean
     */
    public function checkShowModelRequest($id) {
        return $this->eloquentModel::find($id) == null;
    }
}
