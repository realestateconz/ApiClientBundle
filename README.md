ApiClientBundle
===============

Symfony2 integration for the realestate.co.nz api php client https://github.com/realestateconz/realestate-api-php-client

Example config:
------------

    parameters:
        realestateconz_api_public_key: your_api_public_key
        realestateconz_api_private_key: your_api_private_key

    realestateconz_apiclient:
        default:
            public_key: %realestateconz_api_public_key%
            private_key: %realestateconz_api_private_key%