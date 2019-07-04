# Units Theme #

Tested up to: 5.2.2

Requires PHP: 5.6

## Description ##

`Units` theme was created and tested using WAMP.

## Install ##

To install and test `Units` theme you can use 2 ways:

1. Install new test site:
	* clone or download full site.
	* create `www.dev-units.com` folder and copy to it all content.
	* add new VirtualHost to `httpd-vhosts.conf` file.
	* add string `127.0.0.1 dev-units.com www.dev-units.com` to Windows `hosts` file.
	* create `dev_units` DB using phpMyAdmin and import data from `dev_units.sql` file.
	* open page `http://www.dev-units.com/unit/` to get list all published units.
	* if you get 404 error, then login to admin area ( Username: `admin`, Password: `admin` ) open `Settings->Permalinks` page, make sure `Common Settings` option was set to `Post name` and click `Save Changes`.

1. Install on existing test site:
	* download full site.
	* make sure you have installed Twenty Sixteen ( `https://wordpress.org/themes/twentysixteen/` ) theme on your test site.
	* create folder `wp-content/themes/units` and copy to it `Units` theme's files from archive.
	* login to admin area and activate `Units` theme.
	* find `Units` menu item in main navigation menu and click `Add New` to add new units.
	* add unit title, coordinates in appropriate metabox and use shortcode `[yandex_map]` in post content, then Publish unit.
	* open page `http://yoursite/unit/` to get list all published units.
	* if you get 404 error, then login to admin area, open `Settings->Permalinks` page, make sure `Common Settings` option was set to `Post name` and click `Save Changes`.	

## Upgrade Notice ##

### 1.0.0 ###

Init version.