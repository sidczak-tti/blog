<?php
//src/BlogBundle/DataFixtures/ORM/LoadCommentData.php

namespace BlogBundle\DataFixtures\ORM;
 
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use BlogBundle\Entity\Comment;
 
class LoadCommentData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {

    }

    public function getOrder()
    {
        return 3; // the order in which fixtures will be loaded
    }
}