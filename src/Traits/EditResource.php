<?php 
namespace ImFranq\LaravelResource\Traits;

use Illuminate\Support\Str;

trait EditResource
{
    use Common\PropertiesResource;
    use Common\ViewResource;

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if( $this->checkEditModelRequest($id) ) return abort(404);

        return $this->renderView(
            $this->moduleName != null ? Str::plural($this->moduleName) . '.edit' : 'edit' ,
            $this->editResponse($id)
        );
    }

    /**
     * Return the data to use in the view
     * 
     * @param  int  $id
     * @return Array
     */
    private function editResponse($id)
    {
        return [
            Str::singular($this->moduleName) => $this->editModelQueryResponse($id)
        ];
    }

    /**
     * Define query response to index method
     * 
     * @param  int  $id
     * @return Illuminate\Database\Eloquent\Model
     */
    private function editModelQueryResponse($id){
        return $this->eloquentModel::find($id);
    }

    /**
     * Validate if the model can be edited
     * 
     * @param  int  $id
     * @return boolean
     */
    private function checkEditModelRequest($id) {
        return $this->eloquentModel::find($id) == null;
    }
}
