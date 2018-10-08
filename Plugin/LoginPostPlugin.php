<?php

namespace Baze\LoginToHomepage\Plugin;

use Magento\Framework\App\Config\ScopeConfigInterface; // References scope config
use Magento\Store\Model\ScopeInterface; // Contains scope constants

class LoginPostPlugin
{
    protected $scopeConfig;
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }
    
    public function aroundExecute(
        \Magento\Customer\Controller\Account\LoginPost $subject,
        callable $proceed
    ) {
        $result = $proceed();
        if (1 == $this->scopeConfig->getValue('customer/startup/fixed_redirect_on', ScopeInterface::SCOPE_STORE)) {
            $result->setPath($this->scopeConfig->getValue('customer/startup/fixed_redirect_destination', ScopeInterface::SCOPE_STORE));
        }
        return $result;
    }
}
