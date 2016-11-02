<?php
/**
 * Created by PhpStorm.
 * User: blush
 * Date: 2016. 11. 02.
 * Time: 19:50
 */

namespace Blog\ModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Timestampable
 * @package Blog\ModelBundle\Entity
 *
 * @ORM\MappedSuperclass()
 */
abstract class Timestampable
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * Author constructor.
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }
}