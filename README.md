# GWPRESS

GWPRESS is an open source blogging software with no framework built to be the best! Built by: [George Whitcher](http://georgewhitcher.com).

## Composer Installation

    1. composer require gwhitcher/gwpress
    2. Take the index.php, gw-config.dist, and .htaccess.dist in /vendor/gwhitcher/gwpress/ and put in your root.
    3. Setup gw-config.php.dist with your settings and database information. Save and rename to gw-config.php.  Don't forget to activate composer in the config or else it will not work!
    4. Rename .htaccess.dist to .htaccess.
    5. Setup /vendor/gwhitcher/gwpress/gw-includes/routes.php.dist (leave as is if unsure).  Save and rename to routes.php.
    6. Visit site yourdomain.com/install.  If everything is correct it will install itself. (If the installer did not delete /gw-content/themes/gwpress/install.php please delete it now.)
    7. To view the Administration visit yourdomain.com/admin and use admin@admin.com:password.  It is suggested you change this immediately.
    
## Manual Installation

    1. [Download](https://github.com/gwhitcher/GWPRESS/archive/master.zip) and extract files to the root of your server.
    2. Setup gw-config.php.dist with your settings and database information. Save and rename to gw-config.php.
    3. Rename .htaccess.dist to .htaccess.
    4. Setup /gw-includes/routes.php.dist (leave as is if unsure).  Save and rename to routes.php.
    5. Visit site yourdomain.com/install.  If everything is correct it will install itself. (If the installer did not delete /gw-content/themes/gwpress/install.php please delete it now.)
    6. To view the Administration visit yourdomain.com/admin and use admin@admin.com:password.  It is suggested you change this immediately.