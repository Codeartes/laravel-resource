<?php 
namespace ImFranq\LaravelResource\Traits;

use Illuminate\Http\Request;

trait UpdateResource
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user)
    {
        $resource = $this->eloquentModel::find($user);
        if($resource == null) return abort(404);
        $data = $request->only($this->resourceFields);

        $this->updateResource($resource, $this->removeNulls($data), $request);
        return $this->redirectOnUpdate($request);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function redirectOnUpdate(Request $request){
        return redirect()->to( $this->redirectTo );
    }

    /**
     * @param  Illuminate\Database\Eloquent\Model  $resource
     * @param  Array  $data
     * @param  \Illuminate\Http\Request  $request
     * @return Boolean
     */
    public function updateResource($resource, $data, Request $request){
        return $resource->update($data);
    }
    
    /**
     * @param  Array  $data
     * @return  Array  $data
     */
    private function removeNulls($data){
        return collect($data)->filter(function($value, $key)   {
            return $value != null;
        })->all();
    }
}
