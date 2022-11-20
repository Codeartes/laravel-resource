# Laravel Resource

Create easy cruds in Laravel PHP Framework.

## install

`composer require imfranq/laravel-resource`

## Basic Crud

```
use ImFranq\LaravelResource\Traits\FullResource;

class TestController extends Controller
{
    use FullResource;

    public function __construct(){
        $this->moduleName = 'users';
        $this->eloquentModel = \App\Models\User::class
        // $this->onlyJsonResponse = true;
        $this->redirectTo = '/users'; // optional if onlyJsonResponse is enabled
    }
}
```

## Custom Request

```
class UserController extends Controller
{
    use FullResource {
        create as protected createResource;
        // update as protected updateResource;
        // destroy as protected destroyResource;
    }

    public function __construct(){
        // ...
    }

    public function create(CustomRequest $request){
        // ... Code
        return $this->createResource($request);
    }
}

```