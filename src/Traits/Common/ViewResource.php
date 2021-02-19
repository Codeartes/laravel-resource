<?php

namespace ImFranq\LaravelResource\Traits\Common;

trait ViewResource
{
    private function renderView($view, $data = [])
    {
        try {
            return $this->viewResponse($view, $data);
        } catch (\Throwable $th) {
            if( config('app.debug') ) throw new \Exception($th->getMessage(), 1);
            return abort(404);
        }
    }

    private function viewResponse($view, $data = [])
    {
        return view($view, $data);
    }
}
