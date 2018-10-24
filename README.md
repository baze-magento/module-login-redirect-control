# module-login-redirect-control
Makes users automatically login to a specified URL rather than using the referrer URL.


## Architecture
Modules that require theme changes <- Core theme -> Child "skin" themes

**Standalone modules** (This Repo) -> (no dependencies)

## Properties
Standalone Magento module.

Module name: Baze_LoginRedirectControl

Configured through Customers -> Customer Configuration.

"Create New Account Options" -> "Redirect Customer to Specific Page after Registering" (Yes/No), "Specific Redirect Destination Path" (String)

"Login Options" -> "Redirect Customer to Specific Page after Logging In" (Yes/No), "Specific Redirect Destination Path" (String)
