<?php

namespace Spryker\Foo\Bar\Baz;

use Foo\Bar\Baz\Zip;

class Blub
{
    const ZIP = 'Spryker\Foo\Bar\Baz';

    public function something()
    {
        $foo = DataDirectory::getLocalStoreSpecificPath('cache/profiler');
    }
}
