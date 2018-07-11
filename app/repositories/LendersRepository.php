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
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use models\Ldst;

class LendersRepository implements LendersInterface{

    /**
     * @var $dbConn
     */
    protected $dbConn;

    /**
     * @var $lenders
     */
    protected $lenders;

    /**
     * @var $lateFees
     */
    protected $lateFees;

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

    public function __construct()
    {
        $this->dbConn = DB::connection('someNameDbConnectio');
    }

    public function getAll()
    {
        return Ldst::all();
    }

    public function find($id)
    {
        return Ldst::findorfail($id);
    }

    /**
     * Method getLenders
     *
     * Retrieves all rows from someLendersTable from a companies legacy Code Base for our use
     *
     * @return json
     * @throws Exception
     */
    public function getLenders()
    {
        try {
            $this->lenders = $this->dbConn->table('someLendersTable')->get();
        } catch (Exception $e) {
            throw new Exception($e->getMessage("{'msg': 'getLenders-lenders-utility: " . $e->getMessage() . "''}"));
        }

        return Response::json($this->lenders);
    }

    /**
     * Method putLenders
     *
     * Update a row into someLendersTable
     *
     * @return json
     * @throws Exception
     */
    public function putLenders(){
        $input = Input::all();

        if($input['WHICH-LOS'] != "" || $input['WHICH-LOS'] != null){

            try{
                $this->sendToLegacy( $input['WHICH-LOS'], $input['ID'], $input['CLASS_NAME'], $input['vendorID'], $input['destinationCode'], $input['classificationId'] );

                $this->dbConn->table('someLendersTable')
                    ->where('ID', $input['ID'])
                    ->update(array(
                        'PRETTY_NAME' => $input['PRETTY_NAME'],
                        'STATES' => $input['STATES'],
                        'CLASS_NAME' => "obj" . $input['CLASS_NAME']
                    ));
                return Response::json("{'msg':'putLenders-lenders-utility: true'}");
            } catch (Exception $e) {
                throw new Exception($e->getMessage("{'msg': 'putLenders-lenders-utility-w-los: " . $e->getMessage() . "''}"));
            }
        }else{
            try{
                $this->dbConn->table('someLendersTable')
                    ->where('ID', $input['ID'])
                    ->update(array(
                        'PRETTY_NAME' => $input['PRETTY_NAME'],
                        'STATES' => $input['STATES'],
                        'CLASS_NAME' => "obj" . $input['CLASS_NAME']
                    ));
                return Response::json("{'msg':'putLenders-lenders-utility: true'}");
            } catch (Exception $e) {
                throw new Exception($e->getMessage("{'msg': 'putLenders-lenders-utility-no-los: " . $e->getMessage() . "''}"));
            }
        }
    }

    /**
     * Method setUploadedImage
     *
     * Updates someLenders_LOGO in someLendersTable
     *
     * @return json
     * @throws Exception
     */
    public function setUploadedImage($param1, $param2)
    {
        try {
            $this->dbConn->table('someLendersTable')
                ->where('ID', $param1)
                ->update(array('someLenders_LOGO' => $param2));
            return Response::json("{'msg': 'setUploadedImage-lenders-utility: true'}");
        } catch (Exception $e) {
            throw new Exception($e->getMessage("{'msg': 'setUploadedImage-lenders-utility: " . $e->getMessage() . "''}"));
        }
    }

    /**
     * Method getLateFeeLenders
     *
     * Retrieves all rows from LATE_FEES from a companies legacy Code Base for our use
     *
     * @return json
     * @throws Exception
     */
    public function getLateFeeLenders()
    {
        try {
            $this->lateFees = $this->dbConn->table('LATE_FEES')->get();
        } catch (Exception $e) {
            throw new Exception($e->getMessage("{'msg': 'getLateFeeLenders-lenders-utility: " . $e->getMessage() . "''}"));
        }
        return Response::json($this->lateFees);
    }

    /**
     * Method setLateFees
     *
     * Inserts a row into LATE_FEES
     *
     * @return json
     * @throws Exception
     */
    public function setLateFees(){
        $input = Input::all();
        try {
            $this->maxSponId = $this->dbConn->table('LATE_FEES')->max('LATE_FEES_ID');
            $this->oneMore = $this->maxSponId + 1;

            $this->dbConn->table('LATE_FEES')
                ->insert(array(
                    'LATE_FEES_ID' => $this->oneMore,
                    'LATE_FEES_LENDER_ABBRV' => $input['LATE_FEES_LENDER_ABBRV'],
                    'LATE_FEES_STATE' => $input['LATE_FEES_STATE'],
                    'LATE_FEES_DAYS' => $input['LATE_FEES_DAYS'],
                    'LATE_FEES_AMOUNT_SHORT' => $input['LATE_FEES_AMOUNT_SHORT'],
                    'LATE_FEES_AMOUNT_LONG' => $input['LATE_FEES_AMOUNT_LONG'],
                    'LATE_FEES_MINIMUM' => $input['LATE_FEES_MINIMUM'],
                    'LATE_FEES_MAXIMUM' => $input['LATE_FEES_MAXIMUM'],
                    'LATE_FEES_LONG_TEXT' => $input['LATE_FEES_LONG_TEXT'],
                    'LATE_FEES_SHORT_TEXT1' => $input['LATE_FEES_SHORT_TEXT1'],
                    'LATE_FEES_SHORT_TEXT2' => $input['LATE_FEES_SHORT_TEXT2']
                ));
            return Response::json("{'msg':'setLateFees-lenders-utility: true'}");
        } catch (Exception $e) {
            throw new Exception($e->getMessage("{'msg': 'setLateFees-lenders-utility: " . $e->getMessage() . "''}"));
        }
    }

    /**
     * Method putLateFees
     *
     * Update a row into LATE_FEES
     *
     * @return json
     * @throws Exception
     */
    public function putLateFees(){
        $input = Input::all();

        try {
            $this->dbConn->table('LATE_FEES')
                ->where('LATE_FEES_ID', $input['LATE_FEES_ID'])
                ->update(array(
                    'LATE_FEES_LENDER_ABBRV' => $input['LATE_FEES_LENDER_ABBRV'],
                    'LATE_FEES_STATE' => $input['LATE_FEES_STATE'],
                    'LATE_FEES_DAYS' => $input['LATE_FEES_DAYS'],
                    'LATE_FEES_AMOUNT_SHORT' => $input['LATE_FEES_AMOUNT_SHORT'],
                    'LATE_FEES_AMOUNT_LONG' => $input['LATE_FEES_AMOUNT_LONG'],
                    'LATE_FEES_MINIMUM' => $input['LATE_FEES_MINIMUM'],
                    'LATE_FEES_MAXIMUM' => $input['LATE_FEES_MAXIMUM'],
                    'LATE_FEES_LONG_TEXT' => $input['LATE_FEES_LONG_TEXT'],
                    'LATE_FEES_SHORT_TEXT1' => $input['LATE_FEES_SHORT_TEXT1'],
                    'LATE_FEES_SHORT_TEXT2' => $input['LATE_FEES_SHORT_TEXT2']
                ));
            return Response::json("{'msg':'putLateFees-lenders-utility: true'}");
        } catch (Exception $e) {
            throw new Exception($e->getMessage("{'msg': 'putLateFees-lenders-utility: " . $e->getMessage() . "''}"));
        }
    }

    /**
     * Method getReturnCheckFeeLenders
     *
     * Retrieves all rows from RETURN_CHECK_FEES from a companies legacy Code Base for our use
     *
     * @return json
     * @throws Exception
     */
    public function getReturnCheckFeeLenders()
    {
        try {
            $this->returnCheckFees = $this->dbConn->table('RETURN_CHECK_FEES')->get();
        } catch (Exception $e) {
            throw new Exception($e->getMessage("{'msg': 'getReturnCheckFeeLenders-lenders-utility: " . $e->getMessage() . "''}"));
        }
        return Response::json($this->returnCheckFees);
    }

    /**
     * Method putReturnCheckFees
     *
     * Update a row into RETURN_CHECK_FEES
     *
     * @return json
     * @throws Exception
     */
    public function putReturnCheckFees(){
        $input = Input::all();

        try {
            $this->dbConn->table('RETURN_CHECK_FEES')
                ->where('RETURN_CHECK_FEES_ID', $input['RETURN_CHECK_FEES_ID'])
                ->update(array(
                    'RETURN_CHECK_FEES_LENDER_ABBRV' => $input['RETURN_CHECK_FEES_LENDER_ABBRV'],
                    'RETURN_CHECK_FEES_LENDER_STATE' => $input['RETURN_CHECK_FEES_LENDER_STATE'],
                    'RETURN_CHECK_FEES_AMOUNT' => $input['RETURN_CHECK_FEES_AMOUNT']
                ));
            return Response::json("{'msg':'putReturnCheckFees-lenders-utility: true'}");
        } catch (Exception $e) {
            throw new Exception($e->getMessage("{'msg': 'putReturnCheckFees-lenders-utility: " . $e->getMessage() . "''}"));
        }
    }

    /**
     * Method setReturnCheckFees
     *
     * Inserts a row into RETURN_CHECK_FEES
     *
     * @return json
     * @throws Exception
     */
    public function setReturnCheckFees(){
        $input = Input::all();
        try {
            $this->maxSponId = $this->dbConn->table('RETURN_CHECK_FEES')->max('RETURN_CHECK_FEES_ID');
            $this->oneMore = $this->maxSponId + 1;

            $this->dbConn->table('RETURN_CHECK_FEES')
                ->insert(array(
                    'RETURN_CHECK_FEES_ID' => $this->oneMore,
                    'RETURN_CHECK_FEES_LENDER_ABBRV' => $input['RETURN_CHECK_FEES_LENDER_ABBRV'],
                    'RETURN_CHECK_FEES_LENDER_STATE' => $input['RETURN_CHECK_FEES_LENDER_STATE'],
                    'RETURN_CHECK_FEES_AMOUNT' => $input['RETURN_CHECK_FEES_AMOUNT']
                ));
            return Response::json("{'msg':'setReturnCheckFees-lenders-utility: true'}");
        } catch (Exception $e) {
            throw new Exception($e->getMessage("{'msg': 'setReturnCheckFees-lenders-utility: " . $e->getMessage() . "''}"));
        }
    }
}