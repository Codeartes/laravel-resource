<?php

namespace ImFranq\LaravelResource\Traits\Common;

trait PropertiesResource
{
    protected $moduleName = null;

    protected $eloquentModel = null;

    protected $redirectTo = '/';

    protected $onlyJsonResponse = false;
}
