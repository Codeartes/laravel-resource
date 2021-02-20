<?php 
namespace ImFranq\LaravelResource\Traits;

use Illuminate\Support\Str;

trait CreateResource
{
    use Common\PropertiesResource;
    use Common\ViewResource;

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->renderView(
            $this->moduleName != null ? Str::plural($this->moduleName) . '.create' : 'create' ,
            $this->createResponse()
        );
    }

    /**s
     * Return the data to use in the view
     * 
     * @return Array
     */
    public function createResponse()
    {
        return [];
    }
}