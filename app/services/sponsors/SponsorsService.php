<?php

namespace services\sponsors;

/**
 * Created by PhpStorm.
 * User: kronus
 * Date: 4/28/15
 * Time: 8:38 AM
 */

use repositories\SponsorsInterface;

class SponsorsServices
{
    /**
     * @var SponsorsInterface
     */
    protected $sponsorsInterface;
    /**
     * @var $getSponsor
     */
    protected $getSponsor;

    /**
     * @var $setSponsor
     */
    protected $setSponsor;

    /**
     * @var $putSponsor
     */
    protected $putSponsor;

    /**
     * inject interface to call functions within repository
     */
    public function __construct(SponsorsInterface $sponsorsInterface)
    {
        $this->sponsorsInterface = $sponsorsInterface;
    }

    /**
     * Method getSponsor calls function in repository via interface
     */
    public function getSponsor()
    {
        $this->getSponsor = $this->sponsorsInterface->getSponsor();
        return $this->getSponsor;
    }

    /**
     * Method setSponsor calls function in repository via interface
     */
    public function setSponsor(){
        $this->setSponsor = $this->sponsorsInterface->setSponsor();
        return $this->setSponsor;
    }

    /**
     * Method putSponsor calls function in repository via interface
     */
    public function putSponsor(){
        $this->putSponsor = $this->sponsorsInterface->putSponsor();
        return $this->putSponsor;
    }
}