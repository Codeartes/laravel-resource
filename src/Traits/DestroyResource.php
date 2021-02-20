<?php 
namespace ImFranq\LaravelResource\Traits;

use Illuminate\Http\Request;

trait DestroyResource
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if( $this->checkDestroyModelRequest($id) ) return abort(404);
        
        $resource = $this->destroyModelQuery($id);

        if( $resource->delete() ){
            if(request()->expectsJson()) return response()->json(['message' => 'Resoruce destroyed']);
            return $this->redirectOnDestroy();
        }

        return abort(500, 'An error has occurred');
    }

    public function redirectOnDestroy(){
        return redirect()->to( $this->redirectTo );
    }

    /**
     * Define query to destroy method
     * 
     * @param  int  $id
     * @return Illuminate\Database\Eloquent\Model
     */
    public function destroyModelQuery($id){
        return $this->eloquentModel::find($id);
    }

    /**
     * Validate if the model can be destroyed
     * 
     * @param  int  $id
     * @return boolean
     */
    public function checkDestroyModelRequest($id) {
        return $this->eloquentModel::find($id) == null;
    }
}
