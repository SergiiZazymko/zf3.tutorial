<?php
/**
 * @access protected
 * @author Sergiy Zazymko <sergiy.zazymko@gns-it.com>
 */

namespace Album\Controller;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Interface EntityManagerAwareInterface
 * @package Album\Controller
 */
interface EntityManagerAwareInterface
{
    /**
     * @return mixed
     */
    public function setEntityManager(EntityManagerInterface $entityManager);

    /**
     * @return mixed
     */
    public function getEntityManager();
}