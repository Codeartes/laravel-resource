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
        return $this->renderView(
            $this->moduleName != null ? Str::plural($this->moduleName) . '.edit' : 'edit' ,
            $this->editData($id)
        );
    }

    /**
     * Return the data to use in the view
     * 
     * @param  int  $id
     * @return Array
     */
    public function editData($id)
    {
        return [
            Str::singular($this->moduleName) => $this->eloquentModel::find($id)
        ];
    }
}
