<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class RechercheVoiture
{
    /**
     * @var integer minAnnee
     * 
     * @Assert\LessThanOrEqual(
     *  propertyPath = "maxAnnee",
     *  message="L'année de départ doit être superieure a l'année de fin"
     * )
     */
    private $minAnnee;

    /**
     * @var integer maxAnnee
     */
    private $maxAnnee;

    /**
     * Get minAnnee
     *
     * @return  integer
     */
    public function getMinAnnee()
    {
        return $this->minAnnee;
    }

    /**
     * Set minAnnee
     *
     * @param  integer  $minAnnee  minAnnee
     *
     * @return  self
     */
    public function setMinAnnee(int $minAnnee)
    {
        $this->minAnnee = $minAnnee;

        return $this;
    }

    /**
     * Get maxAnnee
     *
     * @return  integer
     */
    public function getMaxAnnee()
    {
        return $this->maxAnnee;
    }

    /**
     * Set maxAnnee
     *
     * @param  integer  $maxAnnee  maxAnnee
     *
     * @return  self
     */
    public function setMaxAnnee(int $maxAnnee)
    {
        $this->maxAnnee = $maxAnnee;

        return $this;
    }
}
