<?php

namespace services\lenders;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Response;
use repositories\LendersInterface;

/**
 * Created by PhpStorm.
 * User: kronus
 * Date: 4/28/15
 * Time: 8:38 AM
 */

class LendersServices
{
    /**
     * @var LendersInterface
     */
    protected $lendersInterface;

    /**
     * @var $getLenders
     */
    protected $getLenders;

    /**
     * @var $putLenders
     */
    protected $putLenders;

    /**
     * @var $setUploadedImage
     */
    protected $setUploadedImage;

    /**
     * @var $getLateFeeLenders
     */
    protected $getLateFeeLenders;

    /**
     * @var $setLateFees
     */
    protected $setLateFees;

    /**
     * @var $putLateFees
     */
    protected $putLateFees;

    /**
     * @var $getReturnCheckFeeLenders
     */
    protected $getReturnCheckFeeLenders;

    /**
     * @var $putReturnCheckFees
     */
    protected $putReturnCheckFees;

    /**
     * @var $setReturnCheckFees
     */
    protected $setReturnCheckFees;

    /**
     * inject interface to call functions within repository
     */
    public function __construct(LendersInterface $lendersInterface)
    {
        $this->lendersInterface = $lendersInterface;
    }

    /**
     * Method getLenders calls function in repository via interface
     *
     * @return json
     * @throws Exception
     */
    public function getLenders()
    {
        $this->getLenders = $this->lendersInterface->getLenders();
        return $this->getLenders;
    }

    /**
     * Method putLenders calls function in repository via interface
     *
     * @return json
     * @throws Exception
     */
    public function putLenders(){
        $this->putLenders = $this->lendersInterface->putLenders();
        return $this->putLenders;
    }

    /**
     * Method setUploadedImage calls function in repository via interface
     */
    public function setUploadedImage($param1, $param2)
    {
        $this->setUploadedImage = $this->lendersInterface->setUploadedImage($param1, $param2);
        return $this->setUploadedImage;
    }

    /**
     * Method getLateFeeLenders calls function in repository via interface
     */
    public function getLateFeeLenders()
    {
        $this->getLateFeeLenders = $this->lendersInterface->getLateFeeLenders();
        return $this->getLateFeeLenders;
    }

    /**
     * Method setLateFees calls function in repository via interface
     */
    public function setLateFees(){
        $this->setLateFees = $this->lendersInterface->setLateFees();
        return $this->setLateFees;
    }

    /**
     * Method putLateFees calls function in repository via interface
     */
    public function putLateFees(){
        $this->putLateFees = $this->lendersInterface->putLateFees();
        return $this->putLateFees;
    }

    /**
     * Method getReturnCheckFeeLenders calls function in repository via interface
     */
    public function getReturnCheckFeeLenders()
    {
        $this->getReturnCheckFeeLenders = $this->lendersInterface->getReturnCheckFeeLenders();
        return $this->getReturnCheckFeeLenders;
    }

    /**
     * Method putReturnCheckFees calls function in repository via interface
     */
    public function putReturnCheckFees(){
        $this->putReturnCheckFees = $this->lendersInterface->putReturnCheckFees();
        return $this->putReturnCheckFees;
    }

    /**
     * Method setReturnCheckFees calls function in repository via interface
     */
    public function setReturnCheckFees(){
        $this->setReturnCheckFees = $this->lendersInterface->setReturnCheckFees();
        return $this->setReturnCheckFees;
    }

    /**
     * Method sendToLegacy
     *
     * curl post info to legacy
     *
     * @return json
     * @throws Exception
     */
    public function sendToLegacy($whichLos, $ldstId, $ldstClassName, $vendorID, $destinationCode, $classificationId){
        $curl = curl_init();

        if (FALSE === $curl) {
            throw new Exception('failed to initialize');
        }else {
            // $legacyUrl = Config::get('rategenius.rg_legacy_los_receive') . "?whichLos=" . $whichLos . "&ldstId=" . $ldstId . "&ldstClassName=" . $ldstClassName . "&vendorID=" . $vendorID . "&destinationCode=" .$destinationCode . "&classificationId=" . $classificationId;
            $legacyUrl = Config::get('rategenius.rg_legacy_los_receive');

            $data = array('whichLos' => $whichLos, 'ldstId' => $ldstId, 'ldstClassName' => $ldstClassName, 'vendorID' => $vendorID, 'destinationCode' => $destinationCode, 'classificationId' => $classificationId);
            curl_setopt($curl, CURLOPT_URL, $legacyUrl);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

            try {
                $jsonResponse = curl_exec($curl);
                if (FALSE === $jsonResponse) {
                    var_dump($jsonResponse);
                } else {
                    curl_close($curl);
                }
                return Response::json(json_decode($jsonResponse));
            } catch (Exception $e) {
                throw new Exception(curl_error($curl), curl_errno($curl));
            }
        }
    }
}