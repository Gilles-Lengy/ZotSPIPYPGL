<?php

// Sécurité
if (!defined("_ECRIRE_INC_VERSION"))
    return;

function zotspip_declarer_tables_interfaces($interface) {
    // 'spip_' dans l'index de $tables_principales
    $interface['table_des_tables']['zitems'] = 'zitems';
    $interface['table_des_tables']['zcollections'] = 'zcollections';
    $interface['table_des_tables']['ztags'] = 'ztags';
    $interface['table_des_tables']['zcreators'] = 'zcreators';

    //-- Jointures ----------------------------------------------------
    $interface['tables_jointures']['spip_zitems'][] = 'ztags';
    $interface['tables_jointures']['spip_zitems'][] = 'zcreators';
    $interface['tables_jointures']['spip_zitems'][] = 'zitems_zcollections';
    $interface['tables_jointures']['spip_zcollections'][] = 'zitems_zcollections';
    $interface['tables_jointures']['spip_ztags'][''] = 'zitems';
    $interface['tables_jointures']['spip_zcreators'][] = 'zitems';

    return $interface;
}

function zotspip_declarer_tables_principales($tables_principales) {
    //-- Table zitems -----------------------------------------------------------
    $zitems = array(
        "id_zitem" => "varchar(16) DEFAULT '' NOT NULL UNIQUE",
        "id_parent" => "varchar(16) DEFAULT '' NOT NULL",
        "type_ref" => "varchar(255) DEFAULT '' NOT NULL",
        "annee" => "smallint(6)",
        "titre" => "text DEFAULT '' NOT NULL",
        "auteurs" => "text DEFAULT '' NOT NULL",
        "resume" => "mediumtext DEFAULT '' NOT NULL",
        "date" => "varchar(255) DEFAULT '' NOT NULL",
        "pages" => "varchar(255) DEFAULT '' NOT NULL",
        "publication" => "text DEFAULT '' NOT NULL",
        "editeur" => "text DEFAULT '' NOT NULL",
        "collection" => "varchar(255) DEFAULT '' NOT NULL",
        "conference" => "text DEFAULT '' NOT NULL",
        "type_doc" => "text DEFAULT '' NOT NULL",
        "volume" => "varchar(255) DEFAULT '' NOT NULL",
        "numero" => "varchar(255) DEFAULT '' NOT NULL",
        "doi" => "varchar(255) DEFAULT '' NOT NULL",
        "isbn" => "varchar(255) DEFAULT '' NOT NULL",
        "issn" => "varchar(255) DEFAULT '' NOT NULL",
        "url" => "text DEFAULT '' NOT NULL",
        "extras" => "text DEFAULT '' NOT NULL",
        "mimetype" => "varchar(255) DEFAULT '' NOT NULL",
        "poids" => "bigint",
        "fichier" => "text DEFAULT '' NOT NULL",
        "json" => "mediumtext DEFAULT '' NOT NULL",
        "csljson" => "mediumtext DEFAULT '' NOT NULL",
        "updated" => "varchar(50) DEFAULT '' NOT NULL",
        "date_ajout" => "varchar(50) DEFAULT '' NOT NULL",
        'id_zotspip' => 'bigint(21) NOT NULL', // Ajout GL Artaban
    );

    $zitems_cles = array(
        "PRIMARY KEY" => "id_zotspip", // Modif GL Artaban
        "KEY id_parent" => "id_parent"
    );

    $join_zitems = array(
        "id_zitem" => "id_zitem"
    );

    $tables_principales['spip_zitems'] = array(
        'field' => &$zitems,
        'key' => &$zitems_cles,
        'join' => &$join_zitems,
    );

    //-- Table zcollections -----------------------------------------------------------
    $zcollections = array(
        "id_zcollection" => "varchar(16) DEFAULT '' NOT NULL",
        "id_parent" => "varchar(16) DEFAULT '' NOT NULL",
        "zcollection" => "text DEFAULT '' NOT NULL",
        "updated" => "varchar(50) DEFAULT '' NOT NULL"
    );

    $zcollections_cles = array(
        "PRIMARY KEY" => "id_zcollection",
        "KEY id_parent" => "id_parent"
    );

    $join_zcollections = array(
        "id_zcollection" => "id_zcollection"
    );

    $tables_principales['spip_zcollections'] = array(
        'field' => &$zcollections,
        'key' => &$zcollections_cles,
        'join' => &$join_zcollections,
    );

    //-- Table zcreators -----------------------------------------------------------
    $zcreators = array(
        "auteur" => "varchar(150) DEFAULT '' NOT NULL",
        "id_zitem" => "varchar(16) DEFAULT '' NOT NULL",
        "role" => "varchar(30) DEFAULT '' NOT NULL",
        "rang" => "smallint DEFAULT '1' NOT NULL"
    );

    $zcreators_cles = array(
        "PRIMARY KEY" => "auteur, id_zitem, role",
        "KEY auteur" => "auteur"
    );

    $join_zcreators = array(
        "id_zitem" => "id_zitem"
    );

    $tables_principales['spip_zcreators'] = array(
        'field' => &$zcreators,
        'key' => &$zcreators_cles,
        'join' => &$join_zcreators,
    );

    //-- Table ztags -----------------------------------------------------------
    $ztags = array(
        "tag" => "varchar(255) DEFAULT '' NOT NULL",
        "id_zitem" => "varchar(16) DEFAULT '' NOT NULL"
    );

    $ztags_cles = array(
        "PRIMARY KEY" => "tag, id_zitem",
        "KEY tag" => "tag"
    );

    $join_ztags = array(
        "id_zitem" => "id_zitem"
    );

    $tables_principales['spip_ztags'] = array(
        'field' => &$ztags,
        'key' => &$ztags_cles,
        'join' => &$join_ztags,
    );

    return $tables_principales;
}

function zotspip_declarer_tables_auxiliaires($tables_auxiliaires) {
    //-- Table zitems_zcollections -----------------------------------------------------------
    $zitems_zcollections = array(
        "id_zitem" => "varchar(16) DEFAULT '' NOT NULL",
        "id_zcollection" => "varchar(16) DEFAULT '' NOT NULL"
    );

    $zitems_zcollections_cles = array(
        "PRIMARY KEY" => "id_zitem, id_zcollection",
        "KEY id_zcollection" => "id_zcollection"
    );

    $join_zitems_zcollections = array(
        "id_zitem" => "id_zitem",
        "id_zcollection" => "id_zcollection"
    );

    $tables_auxiliaires['spip_zitems_zcollections'] = array(
        'field' => &$zitems_zcollections,
        'key' => &$zitems_zcollections_cles,
        'join' => &$join_zitems_zcollections
    );

    return $tables_auxiliaires;
}
