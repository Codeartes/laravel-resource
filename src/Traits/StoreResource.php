<?php 
namespace ImFranq\LaravelResource\Traits;

use Illuminate\Http\Request;

trait StoreResource
{
    use Common\PropertiesResource;

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only($this->resourceFields, $request);
        $resource = $this->storeResourceQuery($data, $request);

        if(request()->expectsJson()) return response()->json( $this->storeResponse($resource) );

        return $this->redirectOnStore($request);
    }

    /**
     * @param  Array  $data
     * @param  \Illuminate\Http\Request  $request
     * @return Boolean
     */
    public function storeResourceQuery($data, Request $request){
        return $this->eloquentModel::create($data);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function redirectOnStore(Request $request){
        return redirect()->to( $this->redirectTo );
    }

    /**
     * Define query response to store method
     * 
     * @param Illuminate\Database\Eloquent\Model $resource
     * @return Illuminate\Database\Eloquent\Model
     */
    public function storeResponse($resource){
        return $resource;
    }
}
