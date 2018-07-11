<?php

/**
 * Created by PhpStorm.
 * User: kronus
 * Date: 7/16/15
 * Time: 14:12 PM
 */

namespace repositories;

/**
 * Interface LendersInterface
 */
interface LendersInterface
{
    /**
     * Method getAll
     *
     * @return mixed
     */
    public function getAll();

    /**
     * Method find
     *
     * @return mixed
     */
    public function find($id);

    /**
     * Method getLenders
     *
     * @return json
     * @throws Exception
     */
    public function getLenders();

    /**
     * Method putLenders
     *
     * @return json
     * @throws Exception
     */
    public function putLenders();

    /**
     * Method setUploadedImage
     *
     * receives two parameters
     */
    public function setUploadedImage($param1, $param2);

    /**
     * Method getLateFeeLenders
     *
     * @return json
     * @throws Exception
     */
    public function getLateFeeLenders();

    /**
     * Method setLateFees
     *
     * @return json
     * @throws Exception
     */
    public function setLateFees();

    /**
     * Method putLateFees
     *
     * @return json
     * @throws Exception
     */
    public function putLateFees();

    /**
     * Method getReturnCheckFeeLenders
     *
     * @return json
     * @throws Exception
     */
    public function getReturnCheckFeeLenders();

    /**
     * Method putReturnCheckFees
     *
     * @return json
     * @throws Exception
     */
    public function putReturnCheckFees();

    /**
     * Method setReturnCheckFees
     *
     * @return json
     * @throws Exception
     */
    public function setReturnCheckFees();
}