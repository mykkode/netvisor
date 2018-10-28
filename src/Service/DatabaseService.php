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

    /**
     * @param string $entityName
     * @param int $id
     *
     * @return null|object
     */
    public function find(string $entityName, int $id)
    {
        return $this->doctrine->getRepository($entityName)->find($id);
    }

    /**
     * @param $entity
     *
     * @return bool
     */
    public function delete($entity)
    {
        /** @var EntityManager $em */
        $em = $this->doctrine->getManager();

        try  {
            $em->remove($entity);
            $em->flush($entity);
        } catch (ORMException $exception) {
            return false;
        }

        return true;
    }

    /**
 * @param string $entityName
 * @param array $criteria
 * @param array|null $orderBy
 * @param null $limit
 * @param null $offset
 *
 * @return array
 */
    public function findBy(string $entityName, array $criteria, ?array $orderBy = null, $limit = null, $offset = null): array
    {
        return $this->doctrine->getRepository($entityName)->findBy($criteria, $orderBy, $limit, $offset);
    }

    /**
     * @param string $entityName
     * @param array $criteria
     *
     * @return null|object
     */
    public function findOneBy(string $entityName, array $criteria)
    {
        return $this->doctrine->getRepository($entityName)->findOneBy($criteria);
    }

    /**
     * @param string $entityName
     *
     * @return array
     */
    public function findAll(string $entityName): array
    {
        return $this->doctrine->getRepository($entityName)->findAll();
    }
}