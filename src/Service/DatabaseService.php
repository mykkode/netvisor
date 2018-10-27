<?php
/**
 * Created by PhpStorm.
 * User: andru
 * Date: 27-Oct-18
 * Time: 17:44
 */

namespace App\Service;


use Doctrine\Common\Persistence\ObjectManagerAware;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Symfony\Bridge\Doctrine\RegistryInterface;

class DatabaseService
{
    /** @var RegistryInterface */
    private $doctrine;

    /**
     * @param RegistryInterface $doctrine
     *
     * @required
     */
    public function setDoctrine(RegistryInterface $doctrine): void
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @param $entity
     *
     * @return bool
     */
    public function save($entity): bool
    {
        /** @var EntityManager $em */
        $em = $this->doctrine->getManager();

        try  {
            $em->persist($entity);
            $em->flush($entity);
        } catch (ORMException $exception) {
            return false;
        }

        return true;
    }
}