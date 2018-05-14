<?php

namespace LSTATS\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class LSTATSUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
