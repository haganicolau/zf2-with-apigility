<?php
return [
    'zf-content-negotiation' => [
        'selectors' => [],
    ],
    'zf-mvc-auth' => [
        'authentication' => [
            'map' => [],
        ],
    ],
    'doctrine' => [
        'driver' => [
            'certificado_entities' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [
                    0 => 'var\\www\\soluti\\zf2\\module\\Certificate\\config/../src/V1/Rest/Certificate',
                ],
            ],
            'cliente_entities' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [
                    0 => 'var\\www\\soluti\\zf2\\module\\Cliente\\config/../src/V1/Rest/Cliente',
                ],
            ],
            'telefone_entities' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [
                    0 => 'var\\www\\soluti\\zf2\\module\\Cliente\\config/../src/V1/Rest/Telefone',
                ],
            ],
            'endereco_entities' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [
                    0 => 'var\\www\\soluti\\zf2\\module\\Cliente\\config/../src/V1/Rest/Endereco',
                ],
            ],
            'orm_default' => [
                'drivers' => [
                    'Certificate\\V1\\Rest\\Certificate' => 'certificado_entities',
                    'Cliente\\V1\\Rest\\Cliente' => 'cliente_entities',
                    'Cliente\\V1\\Rest\\Telefone' => 'telefone_entities',
                    'Cliente\\V1\\Rest\\Endereco' => 'endereco_entities'
                ],
            ],
        ],
    ],
];
