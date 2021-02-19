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
        $this->eloquentModel = \App\Models\User::class;
        $this->resourceFields = ['name', 'email', 'password'];
        $this->redirectTo = '/users';
    }
}
```
