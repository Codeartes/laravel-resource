<?php 
namespace ImFranq\LaravelResource\Traits;

trait FullApiResource
{
    use IndexResource;
    use ShowResource;
    use UpdateResource;
    use StoreResource;
    use DestroyResource;
}
