<?php

namespace App\Ldap\Rules;

use LdapRecord\Laravel\Auth\Rule;

class SoloUsuariosVision extends Rule
{
    /**
     * Check if the rule passes validation.
     *
     * @return bool
     */
    public function isValid()
    {
        return $this->user->groups()->exists(
            'CN=Vision,OU=Grupo Aplicaciones,OU=ACS,DC=acs,DC=local'
        );
    }
}
