# Mage2 Module Experius SansecReport

    ``experius/module-sansecreport``

 - [Main Functionalities](#markdown-header-main-functionalities)
 - [Installation](#markdown-header-installation)


## Main Functionalities

Provides an adminpanel interface for Sansec eComscan Reports.

![Picture](/Docs/Images/report.png)

## Installation
\* = in production please use the `--keep-generated` option

### Type 1: Zip file

 - Unzip the zip file in `app/code/Experius`
 - Enable the module by running `php bin/magento module:enable Experius_SansecReport`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

### Type 2: Composer

 - Make the module available in a composer repository for example:
    - private repository `repo.magento.com`
    - public repository `packagist.org`
    - public github repository as vcs
 - Add the composer repository to the configuration by running `composer config repositories.repo.magento.com composer https://repo.magento.com/`
 - Install the module composer by running `composer require experius/module-sansecreport`
 - enable the module by running `php bin/magento module:enable Experius_SansecReport`
 - apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

### Configuration

In order to configure eComscan to publish reports to your Magento installation, two steps are required:

 - Create a new Integration Bearer token via Magento:
	- System->Extension->Integrations
	- Add New Integration
	- Fill in the name as `sansec` and fill in your current Administrator password in the lowest field on the page
	- Under the `API` tab, choose `Resource Access` `Custom`. Check the field `SansecReports`
	- Save And Activate
	- Copy the `Access Token`
 - Change your Sansec Cron to add the POST call (change EXAMPLEBEARERTOKEN to your copied `Access Token` and change the domain to your Magento store)
	- Add `--format=json | ifne curl -k -H 'Content-Type: application/json' -H 'Authorization: Bearer <bearerToken>' -d@- -X POST <magentowebshopdomain>/rest/V1/experius-sansecreport/sansecreports`
	- Example full Cron: `~/bin/ecomscan -k <key> --report <your_email> --new-only --format=json --slack <webhookurl> <store_path> | ifne curl -k -H 'Content-Type: application/json' -H 'Authorization: Bearer <bearerToken>' -d@- -X POST <magentowebshopdomain>/rest/V1/experius-sansecreport/sansecreports`
