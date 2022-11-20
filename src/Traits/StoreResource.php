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
        $fields = app( $this->eloquentModel)->getFillable();
        $data = $request->only($fields, $request);
        $resource = $this->storeResourceQuery($data, $request);

        if(request()->expectsJson() || $this->onlyJsonResponse) 
            return response()->json( $this->storeResponse($request, $resource) );

        return $this->redirectOnStore($request);
    }

    /**
     * @param  Array  $data
     * @param  \Illuminate\Http\Request  $request
     * @return Boolean
     */
    private function storeResourceQuery($data, Request $request){
        return $this->eloquentModel::create($data);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    private function redirectOnStore(Request $request){
        return redirect()->to( $this->redirectTo );
    }

    /**
     * Define query response to store method
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param Illuminate\Database\Eloquent\Model $resource
     * @return Illuminate\Database\Eloquent\Model
     */
    private function storeResponse(Request $request, $resource){
        return $resource;
    }
}
