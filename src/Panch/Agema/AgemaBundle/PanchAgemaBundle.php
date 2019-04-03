<?php

namespace Panch\Agema\AgemaBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class PanchAgemaBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
