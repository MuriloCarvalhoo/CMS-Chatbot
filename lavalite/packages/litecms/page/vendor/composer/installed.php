<?php return array(
    'root' => array(
        'pretty_version' => 'dev-master',
        'version' => 'dev-master',
        'type' => 'lavalite-package',
        'install_path' => __DIR__ . '/../../',
        'aliases' => array(),
        'reference' => '9719ffc529593832360aca521a9bcf2fe75de485',
        'name' => 'litecms/page',
        'dev' => true,
    ),
    'versions' => array(
        'composer/installers' => array(
            'pretty_version' => 'v1.11.0',
            'version' => '1.11.0.0',
            'type' => 'composer-plugin',
            'install_path' => __DIR__ . '/./installers',
            'aliases' => array(),
            'reference' => 'ae03311f45dfe194412081526be2e003960df74b',
            'dev_requirement' => false,
        ),
        'litecms/page' => array(
            'pretty_version' => 'dev-master',
            'version' => 'dev-master',
            'type' => 'lavalite-package',
            'install_path' => __DIR__ . '/../../',
            'aliases' => array(),
            'reference' => '9719ffc529593832360aca521a9bcf2fe75de485',
            'dev_requirement' => false,
        ),
        'roundcube/plugin-installer' => array(
            'dev_requirement' => false,
            'replaced' => array(
                0 => '*',
            ),
        ),
        'shama/baton' => array(
            'dev_requirement' => false,
            'replaced' => array(
                0 => '*',
            ),
        ),
    ),
);
