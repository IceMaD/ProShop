ProShop
=======

A Symfony project created on June 27, 2016, 8:51 pm.

## Instalation

### Initialisation

```bash
composer install
npm install
grunt symfony:assets
bin/console assets:install --symlink
bin/console doctrine:schema:update --force
bin/console h:d:f:l // stands for hautelook_alice:doctrine:fixtures:load
```

### Virtualhost configuration

#### On linux

create a file `proshop.conf` in `/etc/apache2/sites-available/` with this content

```
<VirtualHost *:80>
    ServerName dev.proshop.local

    DocumentRoot /path/to/ProShop/web
    <Directory /path/to/ProShop/web>
        AllowOverride All
        Order Allow,Deny
        Allow from All
    </Directory>

    ErrorLog /var/log/apache2/proshop_error.log
    CustomLog /var/log/apache2/proshop_access.log combined
</VirtualHost>
```

Then execute:

```bash
sudo a2ensite proshop
sudo service apache2 reload
```

And add this line in `/etc/hosts`

```
127.0.0.1   dev.proshop.local
```


## Workflow

```bash
grunt watch
```
