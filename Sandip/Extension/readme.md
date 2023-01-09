
# Sandip_Extension module

This extension allow you to track add to cart items in Magento 2. When customer add a product to cart it will call an API and save record to tracker table.
To enable this module you need follow these steps:



1.) Download this module from git.

2.) Place the module under app/code directory of magento 2.

3.) Run : bin/magento s:up && bin/magento s:d:c && bin/magento s:s:d -f && bin/magento c:f

4.) Go to magento 2 admin panel -> STORES-> Settings -> Configuration -> Tracker -> Tracker

5.) Set Tracker Integration Url -> https://supertracking.view.agentur-loop.com/trackme save

6.) Add a product in to a cart. After that, goto Tracker menu from Magento 2 admin dashboard. You can see tracking data there.


## Tracking List API

To get all the tracking data from magento 2 webapi, do the following steps:

1.) Go to magento 2 admin panel.

2.) Go to SYSTEM -> Extensions -> Integrations

3.) Create a new integration. Provide integration Name and your Password in info section. In API section, checked Tracker Listing resource and save.

4.) Magento 2 will provide you Consumer Key, Consumer Secret, Access Token, Access Token Secret.

5.) If you use OAuth 2.0, you need to set access toaken to request header and request this endpoint <store_url>/rest/rest/V1/tracker/get-list. You will get list of Tracking data.

6.) If you use OAuth 1.0 then you need to set Consumer Key, Consumer Secret, Access Token, Access Token Secret to request header when request this endpoint <store_url>/rest/rest/V1/tracker/get-list. After that you will get tracking data.
