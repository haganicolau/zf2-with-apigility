<?php
return [
    'service_manager' => [
        'factories' => [
            \Certificate\V1\Rest\Certificate\CertificateResource::class => \Certificate\V1\Rest\Certificate\CertificateResourceFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'certificate.rest.certificate' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/certificate[/:certificate_id]',
                    'defaults' => [
                        'controller' => 'Certificate\\V1\\Rest\\Certificate\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'zf-versioning' => [
        'uri' => [
            0 => 'certificate.rest.certificate',
        ],
    ],
    'zf-rest' => [
        'Certificate\\V1\\Rest\\Certificate\\Controller' => [
            'listener' => \Certificate\V1\Rest\Certificate\CertificateResource::class,
            'route_name' => 'certificate.rest.certificate',
            'route_identifier_name' => 'certificate_id',
            'collection_name' => 'certificate',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
                2 => 'PUT',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \Certificate\V1\Rest\Certificate\CertificateEntity::class,
            'collection_class' => \Certificate\V1\Rest\Certificate\CertificateCollection::class,
            'service_name' => 'Certificate',
        ],
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            'Certificate\\V1\\Rest\\Certificate\\Controller' => 'HalJson',
        ],
        'accept_whitelist' => [
            'Certificate\\V1\\Rest\\Certificate\\Controller' => [
                0 => 'application/vnd.certificate.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'Certificate\\V1\\Rest\\Certificate\\Controller' => [
                0 => 'application/vnd.certificate.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'zf-hal' => [
        'metadata_map' => [
            \Certificate\V1\Rest\Certificate\CertificateEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'certificate.rest.certificate',
                'route_identifier_name' => 'certificate_id',
                'hydrator' => \DoctrineModule\Stdlib\Hydrator\DoctrineObject::class,
            ],
            \Certificate\V1\Rest\Certificate\CertificateCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'certificate.rest.certificate',
                'route_identifier_name' => 'certificate_id',
                'is_collection' => true,
            ],
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
            'orm_default' => [
                'drivers' => [
                    'Certificate\\V1\\Rest\\Certificate' => 'certificado_entities',
                ],
            ],
        ],
    ],
    'zf-content-validation' => [
        'Certificate\\V1\\Rest\\Certificate\\Controller' => [
            'input_filter' => 'Certificate\\V1\\Rest\\Certificate\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'Certificate\\V1\\Rest\\Certificate\\Validator' => [
            0 => [
                'required' => false,
                'validators' => [],
                'filters' => [],
                'name' => 'name',
                'description' => 'certificate\'s name',
                'error_message' => 'Name is required!',
                'field_type' => 'text',
            ],
            1 => [
                'required' => false,
                'validators' => [],
                'filters' => [],
                'name' => 'certificate',
                'description' => 'certificate\'s file',
                'field_type' => 'file',
                'error_message' => 'Certificate is required!',
            ],
        ],
    ],
    'zf-mvc-auth' => [
        'authorization' => [
            'Certificate\\V1\\Rest\\Certificate\\Controller' => [
                'collection' => [
                    'GET' => false,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
                'entity' => [
                    'GET' => false,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
            ],
        ],
    ],
];
