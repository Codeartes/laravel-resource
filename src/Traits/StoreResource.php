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
        $this->storeResource($data, $request);
        return $this->redirectOnStore($request);
    }

    /**
     * @param  Array  $data
     * @param  \Illuminate\Http\Request  $request
     * @return Boolean
     */
    public function storeResource($data, Request $request){
        return $this->eloquentModel::create($data);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function redirectOnStore(Request $request){
        return redirect()->to( $this->redirectTo );
    }
}
