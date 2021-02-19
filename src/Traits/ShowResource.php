<?php 
namespace ImFranq\LaravelResource\Traits;

use Illuminate\Support\Str;

trait ShowResource
{
    use Common\PropertiesResource;
    use Common\ViewResource;

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->renderView(
            $this->moduleName != null ? Str::plural($this->moduleName) . '.show' : 'show' ,
            $this->showData($id)
        );
    }

    /**
     * Return the data to use in the view
     * 
     * @param  int  $id
     * @return Array
     */
    public function showData($id)
    {
        return [
            Str::singular($this->moduleName) => $this->eloquentModel::find($id)
        ];
    }
}
