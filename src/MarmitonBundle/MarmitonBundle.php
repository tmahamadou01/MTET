<?php

namespace MarmitonBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class MarmitonBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
