<?php 
namespace ImFranq\LaravelResource\Traits;

trait FullResource
{
    use IndexResource;
    use ShowResource;
    use EditResource;
    use UpdateResource;
    use CreateResource;
    use StoreResource;
    use DestroyResource;
}
