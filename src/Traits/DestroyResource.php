<?php 
namespace ImFranq\LaravelResource\Traits;

use Illuminate\Http\Request;

trait DestroyResource
{
    use Common\PropertiesResource;

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        
        if( $this->checkDestroyModelRequest($id) ) return abort(404);
        
        $resource = $this->destroyModelQuery($id);

        if( $resource->delete() ){
            if(request()->expectsJson() || $this->onlyJsonResponse) 
                return response()->json($this->destroyResponse($request));

            return $this->redirectOnDestroy();
        }

        return abort(500, 'An error has occurred');
    }

    private function redirectOnDestroy(){
        return redirect()->to( $this->redirectTo );
    }

    /**
     * Define query to destroy method
     * 
     * @param  int  $id
     * @return Illuminate\Database\Eloquent\Model
     */
    private function destroyModelQuery($id){
        return $this->eloquentModel::find($id);
    }

    /**
     * Validate if the model can be destroyed
     * 
     * @param  int  $id
     * @return boolean
     */
    private function checkDestroyModelRequest($id) {
        return $this->eloquentModel::find($id) == null;
    }

    /**
     * Response to destroy method
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Illuminate\Database\Eloquent\Model
     */
    private function destroyResponse(Request $request) {
        return ['message' => 'Resoruce destroyed'];
    }
}
