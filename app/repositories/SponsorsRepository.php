<?php

namespace repositories;

/**
 * Created by PhpStorm.
 * User: kronus
 * Date: 7/16/15
 * Time: 14:12 PM
 */

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use repositories\SponsorsInterface;
use Illuminate\Support\Facades\Auth;
use models\Sponsors;

class SponsorsRepository implements SponsorsInterface{

    /**
     * @var Sponsors $sponsors
     */
    protected $sponsors;

    /**
     * @var Sponsors $sponsorsInsert
     */
    protected $sponsorsInsert;

    /**
     * @var Sponsors $sponsorsUpdate
     */
    protected $sponsorsUpdate;

    /**
     * @var sponsorsInterface
     */
    protected $sponsorsInterface;

    /**
     * @var $maxSponId
     */
    protected $maxSponId;

    /**
     * @var $oneMore
     */
    protected $oneMore;

    /**
     * @var $db
     */
    protected $db;

    /**
     * @var $input
     */
    protected $input;

    /**
     * @var $dbConn
     */
    protected $dbConn;

    /**
     * constructor
     */
    public function __construct()
    {
        $this->dbConn = DB::connection('someDbConnectionNameInConfigDatabaseFile');
    }

    public function getAll()
    {
        return Sponsors::all();
    }

    public function find($id)
    {
        return Sponsors::findorfail($id);
    }

    /**
     * Method getSponsor
     *
     * Retrieves all rows from SPONSOR from RG Legacy Code Base for our use
     *
     * @return json
     * @throws Exception
     */
    public function getSponsor(){
        try {
            $this->sponsors = $this->dbConn->table('SPONSOR')->get();
        } catch (Exception $e) {
            throw new Exception($e->getMessage("{'msg': 'getSponsor-sponsors-utility: " . $e->getMessage() . "''}"));
        }

        return Response::json($this->sponsors);
    }

    /**
     * Method setSponsor
     *
     * Inserts a row into SPONSOR
     *
     * @return json
     * @throws Exception
     */
    public function setSponsor(){
        $this->input = Input::all();

        try {
            $this->maxSponId = $this->dbConn->table('SPONSOR')->max('ID');
            $this->oneMore = $this->maxSponId + 1;

            $this->dbConn->table('SPONSOR')
                ->insert(array(
                    'ID' => $this->oneMore,
                    'NAME' => $this->input['NAME'],
                    'ABBR' => $this->input['ABBR'],
                    'TYPE' => $this->input['TYPE'],
                    'DNIS' => $this->input['DNIS'],
                    'LDST_ID' => $this->input['LDST_ID'],
                    'API_KEY' => $this->input['API_KEY'],
                    'ANB' => $this->input['ANB'],
                    'ACTIVE' => $this->input['ACTIVE']
                ));
            return Response::json("{'msg':'setSponsor-sponsors-utility true'}");
        } catch (Exception $e) {
            return Response::json("{'msg':'setSponsor-sponsors-utility rg-api max id = " . $this->oneMore . "'}");
        }
    }

    /**
     * Method putSponsor
     *
     * Updates a row in SPONSOR
     *
     * @return json
     * @throws Exception
     */
    public function putSponsor(){
        $this->input = Input::all();

        try {
            $this->dbConn->table('SPONSOR')
                ->where('ID', $this->input['ID'])
                ->update(array(
                    'ID' => $this->input['ID'],
                    'NAME' => $this->input['NAME'],
                    'ABBR' => $this->input['ABBR'],
                    'TYPE' => $this->input['TYPE'],
                    'DNIS' => $this->input['DNIS'],
                    'LDST_ID' => $this->input['LDST_ID'],
                    'API_KEY' => $this->input['API_KEY'],
                    'ANB' => $this->input['ANB'],
                    'ACTIVE' => $this->input['ACTIVE']
                ));
            return Response::json("{'msg':'putSponSponsor-sponsors-utility true'}");
        } catch (Exception $e) {
            return Response::json("{'msg':'putSponSponsor-sponsors-utility rg-api ID = " . $this->input['ID'] . "'}");
        }
    }
}