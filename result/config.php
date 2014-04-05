$projects = array();

$project = new Sismo\Project('');
$project->setRepository('');
$project->setBranch('');
$project->setCommand(
    'echo mv ~/.phpenv/versions/$(phpenv version-name)/etc/conf.d/xdebug.ini ~/.phpenv/versions/$(phpenv version-name)/etc/conf.d/xdebug.ini.orig;
    echo "extension = apc.so" >> ~/.phpenv/versions/$(phpenv version-name)/etc/php.ini;
    echo "extension = memcached.so" >> ~/.phpenv/versions/$(phpenv version-name)/etc/php.ini;
    echo 'date.timezone = "America/Los_Angeles"' >> ~/.phpenv/versions/$(phpenv version-name)/etc/php.ini;
    cp web/davinci/xml/config/config.xml.example web/davinci/xml/config/config.xml;
    composer self-update;
    rm -rf vendor/doctrine/doctrine-bundle vendor/presta/sitemap-bundle vendor/satooshi;
    COMPOSER_PROCESS_TIMEOUT=600 composer install -n;
    app/console doctrine:database:create -e=test --connection=default;
    app/console doctrine:migrations:migrate -n -e=test --em=default;
    app/console doctrine:database:create -e=test --connection=mailinglists;
    app/console doctrine:migrations:migrate -n -e=test --em=mailinglists;
    app/console doctrine:fixtures:load -e=test;
    echo mv ~/.phpenv/versions/$(phpenv version-name)/etc/conf.d/xdebug.ini.orig ~/.phpenv/versions/$(phpenv version-name)/etc/conf.d/xdebug.ini || true;
    vendor/bin/phpunit --coverage-clover clover.xml;
    echo '' > ~/.phpenv/versions/$(phpenv version-name)/etc/conf.d/xdebug.ini || true;
    php -d memory_limit=2048M vendor/bin/behat --verbose --format progress,failed;
    wget https://scrutinizer-ci.com/ocular.phar;
    php ocular.phar code-coverage:upload --access-token="5472b7472266a977e2b0be942fd805d4ccf1d29f92edafd4823574271a570b81" --format=php-clover clover.xml'
);
$project->setSlug('');
$project->setUrlPattern('');
$project->addNotifier('');
$projects[] = $project;

return $projects;