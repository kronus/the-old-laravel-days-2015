<?php
/**
 * Class SponsorsController
 *
 * Created for a company 2015.04
 *
 * API controller for retrieving and validating marketing data
 *
 * @version v1
 *
 * @author kronus tam@kronusproductions.com
 */

use services\sponsors\SponsorsServices;

class SponsorsController extends BaseController
{
    /**
     * @var $sponsorsServices
     */
    protected $sponsorsServices;

    /**
     * constructor to inject services
     *
     * @param sponsorsServices
     */
    public function __construct(SponsorsServices $sponsorsServices)
    {
        $this->sponsorsServices = $sponsorsServices;
    }

    /**
     * Method getSponsor
     *
     * Uses SponsorUtility library to retrieve all rows from someSponsorTable from a companies legacy Code Base for our use
     *
     * @return json
     * @throws Exception
     */
    public function getSponsor()
    {
        $this->sponsors = $this->sponsorsServices->getSponsor();
        return $this->sponsors;
    }

    /**
     * Method setSponsor
     *
     * Uses SponsorUtility library to insert a row into someSponsorTable
     *
     * @return json
     * @throws Exception
     */
    public function setSponsor()
    {
        $this->sponsorsInsert = $this->sponsorsServices->setSponsor();
        return $this->sponsorsInsert;
    }

    /**
     * Method putSponsor
     *
     * Uses SponsorUtility library to update a row in someSponsorTable
     *
     * @return json
     * @throws Exception
     */
    public function putSponsor()
    {
        $this->sponsorsUpdate = $this->sponsorsServices->putSponsor();
        return $this->sponsorsUpdate;
    }
}
