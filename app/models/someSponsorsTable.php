<?php

namespace models;

/**
 * Class Sponsors
 *
 *
 * created 04.09.2015 for a company
 *
 * @author kronus tam@kronusproductions.com
 */
class Sponsors extends Eloquent
{

    /**
     * connection
     *
     * DB Connection
     *
     * @var string
     * @access protected
     */
    protected $connection = 'someDbConnection';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'SPONSOR';

    /**
     * The database table used by the model PRIMARY KEY.
     *
     * @var string
     */
    protected $primaryKey = 'ID';

    /**
     * Tells Laravel / Eloquent NOT TO maintain created_at or updated_at
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array $fillable
     *
     * Dictates to eloquent which fields are available for mass insert / update
     */
    protected $fillable = [
        'ID',
        'NAME',
        'ABBR',
        'TYPE',
        'DNIS',
        'LDST_ID',
        'API_KEY',
        'ANB',
        'ACTIVE'
    ];

    /**
     * method getTableName
     *
     * @returns string
     */
    public function getTableName()
    {
        return $this->table;
    }

    /**
     * method getFields
     *
     * @return array
     */
    public function getFields()
    {
        return $this->fillable;
    }
}
