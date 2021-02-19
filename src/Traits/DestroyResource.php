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
        $resource = $this->eloquentModel::find($id);
        if($resource == null) return abort(404);
        $resource->delete();
        return $this->redirectOnDestroy();
    }

    public function redirectOnDestroy(){
        return redirect()->to( $this->redirectTo );
    }
}
