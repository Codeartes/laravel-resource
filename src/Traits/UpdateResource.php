<?php 
namespace ImFranq\LaravelResource\Traits;

use Illuminate\Http\Request;

trait UpdateResource
{
    use Common\PropertiesResource;

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($this->checkUpdateModelRequest($id)) return abort(404);

        $resource = $this->eloquentModel::find($id);
        $fields = app($this->eloquentModel)->getFillable();
        $data = $request->only($fields);

        if( $this->updateResource($resource, $this->removeNulls($data), $request) ){
            if(request()->expectsJson() || $this->onlyJsonResponse) 
                return response()->json($this->updateResponse($request, $id));
            return $this->redirectOnUpdate($request);
        }

        return abort(500, 'An error has occurred');
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    private function redirectOnUpdate(Request $request){
        return redirect()->to( $this->redirectTo );
    }

    /**
     * @param  Illuminate\Database\Eloquent\Model  $resource
     * @param  Array  $data
     * @param  \Illuminate\Http\Request  $request
     * @return Boolean
     */
    private function updateResource($resource, $data, Request $request){
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

    /**
     * Define query to update method
     * 
     * @param  int  $id
     * @return Illuminate\Database\Eloquent\Model
     */
    private function updateModelQuery($id){
        return $this->eloquentModel::find($id);
    }

    /**
     * Validate if the model can be updated
     * 
     * @param  int  $id
     * @return boolean
     */
    private function checkUpdateModelRequest($id) {
        return $this->eloquentModel::find($id) == null;
    }

    /**
     * Response to update method
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Illuminate\Database\Eloquent\Model
     */
    private function updateResponse(Request $request, $id) {
        return $this->eloquentModel::find($id);
    }
}
