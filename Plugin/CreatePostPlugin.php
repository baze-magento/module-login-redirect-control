<?php

namespace Baze\LoginRedirectControl\Plugin;

use Magento\Framework\App\Config\ScopeConfigInterface; // References scope config
use Magento\Store\Model\ScopeInterface; // Contains scope constants
use Magento\Framework\App\Response\Http; // Redirect is only readable by rendering to an HTTP response object

class CreatePostPlugin
{
    protected $scopeConfig;
    protected $Http;
    
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        Http $Http
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->Http = $Http;
    }
    
    public function afterExecute(
        \Magento\Customer\Controller\Account\CreatePost $subject,
        $result
    ) {
        // Execute doesn't return a success value, only a redirect. The redirect's URL is private, unless we render it:
        $result->renderResult($this->Http);
        // ex: "/[store]/customer/account/"
        $path = $this->Http->getHeader('Location')->uri()->getPath();
        // Trims off "/[store]/"
        $parsedPath = implode('/', array_slice(explode('/', $path), 2));
        //Compares against "customer/account/", but not "customer/account/create/"
        $success = (substr($parsedPath, 0, 17) == "customer/account/") && (substr($parsedPath, 17, 6) != "create");
        
        // Don't change the redirect on failure
        if ($success &&
            1 == $this->scopeConfig->getValue('customer/create_account/fixed_redirect_on', ScopeInterface::SCOPE_STORE)
        ) {
            $result->setPath($this->scopeConfig->getValue('customer/create_account/fixed_redirect_destination', ScopeInterface::SCOPE_STORE));
        }
        return $result;
    }
}
