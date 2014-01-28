<?php

namespace Fias;

use Grace\DBAL\ConnectionAbstract\ConnectionInterface;

class AddressObjectsImporter extends Importer
{

    public function __construct(ConnectionInterface $db, $table, array $fields)
    {
        parent::__construct($db, $table, $fields, false);
    }

    public function modifyDataAfterImport()
    {
        // Формируем полный заголовок
        $sql = <<<SQL
            UPDATE address_objects ao SET
                level      = tmp.level,
                full_title = tmp.title
            FROM (
                WITH RECURSIVE required_addresses(level, address_id, title) AS (
                    SELECT DISTINCT 0, address_id, "prefix" || ' ' || title
                    FROM address_objects_xml_importer
                    WHERE parent_id IS NULL
                UNION ALL
                    SELECT ra.level + 1, ar.address_id, ra.title || ', ' || "prefix" || ' ' || ar.title
                    FROM address_objects_xml_importer ar
                    INNER JOIN required_addresses ra
                        ON ra.address_id = ar.parent_id
                )
                SELECT * FROM required_addresses
            ) tmp
            WHERE tmp.address_id = ao.address_id;
SQL;

        $this->db->execute($sql);
    }

    protected $rowsPerInsert = 10000;
}