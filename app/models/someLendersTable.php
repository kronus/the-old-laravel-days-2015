<?php

/**
 * Class someLendersTable
 *
 *
 * created 04.07.2015 for a company
 *
 * @author kronus tam@kronusproductions.com
 */
class someLendersTable extends Eloquent
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
    protected $table = 'someLendersTable_LENDERS_AND_STATES';

    /**
     * The database table used by the model PRIMARY KEY.
     *
     * @var string
     */
    protected $primaryKey = 'someLendersTable_ID';

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
        'someLendersTable_ID',
        'someLendersTable_LENDER',
        'someLendersTable_PRETTY_NAME',
        'someLendersTable_STATES',
        'someLendersTable_CLASS_NAME'
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
