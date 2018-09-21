<?php

namespace Baze\LoginToHomepage\Plugin;

class LoginPostPlugin
{
    public function aroundExecute(
        \Magento\Customer\Controller\Account\LoginPost $subject,
        callable $proceed)
    {
        $result = $proceed();
        // Paths use the store as their root. 
        // Must not include a leading slash; such paths are discarded by magento.
        // Trailing slashes are permitted, but unnecessary.
        $result->setPath('');
        return $result;
    }
}
