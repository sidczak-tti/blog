<?php

namespace BlogBundle\Repository;

/**
 * TagRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TagRepository extends \Doctrine\ORM\EntityRepository
{
    public function getWithPosts()
    {
        //$query = $this->getEntityManager()->createQuery('SELECT t FROM BlogBundle:Tag t INNER JOIN t.posts pt');
        
        $qb = $this->createQueryBuilder('t')
            ->innerJoin('t.posts', 'pt')
            //->innerJoin('pt.tags', 'p')
            ->orderBy('t.name', 'ASC');

        $query = $qb->getQuery();

        return $query->getResult();
    }
}
