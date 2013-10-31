<?php

namespace hnr\sircimBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EstudioArea
 *
 * @ORM\Table(name="estudio_area")
 * @ORM\Entity(repositoryClass="hnr\sircimBundle\Repositorio\EstudioAreaRepository")
 */
class EstudioArea
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="estudio_area_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_estudio_area", type="smallint", nullable=false)
     */
    private $estadoEstudioArea;

    /**
     * @var \Estudio
     *
     * @ORM\ManyToOne(targetEntity="Estudio", cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estudio", referencedColumnName="id")
     * })
     */
    private $idEstudio;

    /**
     * @var \Area
     *
     * @ORM\ManyToOne(targetEntity="Area")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_area", referencedColumnName="id")
     * })
     */
    private $idArea;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set estadoEstudioArea
     *
     * @param integer $estadoEstudioArea
     * @return EstudioArea
     */
    public function setEstadoEstudioArea($estadoEstudioArea)
    {
        $this->estadoEstudioArea = $estadoEstudioArea;
    
        return $this;
    }

    /**
     * Get estadoEstudioArea
     *
     * @return integer 
     */
    public function getEstadoEstudioArea()
    {
        return $this->estadoEstudioArea;
    }

    /**
     * Set idEstudio
     *
     * @param \hnr\sircimBundle\Entity\Estudio $idEstudio
     * @return EstudioArea
     */
    public function setIdEstudio(\hnr\sircimBundle\Entity\Estudio $idEstudio = null)
    {
        $this->idEstudio = $idEstudio;
    
        return $this;
    }

    /**
     * Get idEstudio
     *
     * @return \hnr\sircimBundle\Entity\Estudio 
     */
    public function getIdEstudio()
    {
        return $this->idEstudio;
    }

    /**
     * Set idArea
     *
     * @param \hnr\sircimBundle\Entity\Area $idArea
     * @return EstudioArea
     */
    public function setIdArea(\hnr\sircimBundle\Entity\Area $idArea = null)
    {
        $this->idArea = $idArea;
    
        return $this;
    }

    /**
     * Get idArea
     *
     * @return \hnr\sircimBundle\Entity\Area 
     */
    public function getIdArea()
    {
        return $this->idArea;
    }
}