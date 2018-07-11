<?php

/**
 * Class LendersController
 *
 * Created for a company 2015.04
 *
 * API controller for retrieving and validating marketing data
 *
 * @version v1
 *
 * @author kronus tam@kronusproductions.com
 */

use Illuminate\Support\Facades\DB;
use services\lenders\LendersServices;

class LendersController extends BaseController
{
    /**
     * @var Ldst $ldst
     */
    protected $ldst;

    /**
     * @var $lendersUpdate
     */
    protected $lendersUpdate;

    /**
     * @var $lendersInsert
     */
    protected $lendersInsert;

    /**
     * @var LendersServices $LendersServices
     */
    protected $LendersServices;

    /**
     * @var LdstId $ldstId
     */
    protected $ldstId;

    /**
     * @var $db
     */
    protected $db;

    /**
     * @var $lenderLogo
     */
    protected $lenderLogo;

    /**
     * @var $lateFees
     */
    protected $lateFees;

    /**
     * @var $returnCheckFees
     */
    protected $returnCheckFees;

    /**
     * @var $lateFeesUpdate
     */
    protected $lateFeesUpdate;

    /**
     * @var $lateFeesInsert
     */
    protected $lateFeesInsert;

    /**
     * @var $returnCheckFeesUpdate
     */
    protected $returnCheckFeesUpdate;

    /**
     * @var $returnCheckFeesInsert
     */
    protected $returnCheckFeesInsert;

    /**
     * @param ldst $ldst
     */
    public function __construct(LendersServices $LendersServices)
    {
        $this->LendersServices = $LendersServices;
    }

    /**
     * Method getLenders
     *
     * Uses LendersServices library to retrieve all rows from someLendersTable from a companies legacy Code Base for our use
     *
     * @return json
     * @throws Exception
     */
    public function getLenders()
    {
        $this->ldst = $this->LendersServices->getLenders();
        return $this->ldst;
    }

    /**
     * Method putLenders
     *
     * Uses LendersServices library to update a row into someLendersTable
     *
     * @return json
     * @throws Exception
     */
    public function putLenders()
    {
        $this->lendersUpdate = $this->LendersServices->putLenders();
        return $this->lendersUpdate;
    }

    /**
     * Method setUploadedImage
     *
     * Uses LendersServices library to update someTable_LOGO in someLendersTable
     *
     * @return json
     * @throws Exception
     */
    public function setUploadedImage($param1, $param2)
    {
        $this->lenderLogo = $this->LendersServices->setUploadedImage($param1, $param2);
        return $this->lenderLogo;
    }

    /**
     * Method getLateFeeLenders
     *
     * Uses LendersServices library to retrieve all rows from LATE_FEES from a companies legacy Code Base for our use
     *
     * @return json
     * @throws Exception
     */
    public function getLateFeeLenders()
    {
        $this->lateFees = $this->LendersServices->getLateFeeLenders();
        return $this->lateFees;
    }

    /**
     * Method getReturnCheckFeeLenders
     *
     * Uses LendersServices library to retrieve all rows from RETURN_CHECK_FEES from a companies legacy Code Base for our use
     *
     * @return json
     * @throws Exception
     */
    public function getReturnCheckFeeLenders()
    {
        $this->returnCheckFees = $this->LendersServices->getReturnCheckFeeLenders();
        return $this->returnCheckFees;
    }

    /**
     * Method setLateFees
     *
     * Uses LendersServices library to insert a row into LATE_FEES
     *
     * @return json
     * @throws Exception
     */
    public function setLateFees()
    {
        $this->lateFeesInsert = $this->LendersServices->setLateFees();
        return $this->lateFeesInsert;
    }

    /**
     * Method putLateFees
     *
     * Uses LendersServices library to update a row into LATE_FEES
     *
     * @return json
     * @throws Exception
     */
    public function putLateFees()
    {
        $this->lateFeesUpdate = $this->LendersServices->putLateFees();
        return $this->lateFeesUpdate;
    }

    /**
     * Method putReturnCheckFees
     *
     * Uses LendersServices library to update a row into RETURN_CHECK_FEES
     *
     * @return json
     * @throws Exception
     */
    public function putReturnCheckFees()
    {
        $this->returnCheckFeesUpdate = $this->LendersServices->putReturnCheckFees();
        return $this->returnCheckFeesUpdate;
    }

    /**
     * Method setReturnCheckFees
     *
     * Uses LendersServices library to insert a row into RETURN_CHECK_FEES
     *
     * @return json
     * @throws Exception
     */
    public function setReturnCheckFees()
    {
        $this->returnCheckFeesInsert = $this->LendersServices->setReturnCheckFees();
        return $this->returnCheckFeesInsert;
    }
}
