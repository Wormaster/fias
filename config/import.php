<?php

return array(
    'address_objects' => array(
        'table_name' => 'address_objects',
        'node_name'  => 'Object',
        'fields'     => array(
            'AOID'       => array('name' => 'id', 'type' => 'uuid'),
            'AOGUID'     => array('name' => 'address_id', 'type' => 'uuid'),
            'PARENTGUID' => array('name' => 'parent_id', 'type' => 'uuid'),
            'FORMALNAME' => array('name' => 'title'),
            'POSTALCODE' => array('name' => 'postal_code', 'type' => 'integer'),
            'SHORTNAME'  => array('name' => 'prefix')
        ),
        'filters'    => array(
            array('field' => 'ACTSTATUS', 'type' => 'eq', 'value' => 1),
            array('field' => 'REGIONCODE', 'type' => 'in', 'value' => array(47, 50, 77, 78)),
        ),
    ),
    'houses'          => array(
        'table_name' => 'houses',
        'node_name'  => 'House',
        'fields'     => array(
            'HOUSEID'   => array('name' => 'id', 'type' => 'uuid'),
            'HOUSEGUID' => array('name' => 'home_id', 'type' => 'uuid'),
            'AOGUID'    => array('name' => 'address_id', 'type' => 'uuid'),
            'HOUSENUM'  => array('name' => 'number'),
            'BUILDNUM'  => array('name' => 'building'),
            'STRUCNUM'  => array('name' => 'structure'),
        ),
    ),
);