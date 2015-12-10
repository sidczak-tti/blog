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
	    
	    $comment1 = new Comment();
            $comment1->setPost($em->merge($this->getReference('post-post1')));
	    $comment1->setUsername('admin');
	    $comment1->setAuthorEmail('admin@symfony.com');
            $comment1->setWebsite('www.demo.pl');
            $comment1->setContent('YouTube has become the standard way for delivering high quality video on the web.');
	    $comment1->setIsApproved(0);
            
            $comment2 = new Comment();
            $comment2->setPost($em->merge($this->getReference('post-post2')));
	    $comment2->setUsername('editor');
	    $comment2->setAuthorEmail('editor@symfony.com');
            $comment2->setContent('Bootstrap is the most widely used frontend framework right now.');
            
            $comment3 = new Comment();
            $comment3->setPost($em->merge($this->getReference('post-post1')));
	    $comment3->setUsername('journalist');
	    $comment3->setAuthorEmail('journalist@symfony.com');
            $comment3->setWebsite('www.demo.pl');
            $comment3->setContent('Lorem ipsum dolor sit amet consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et **dolore magna aliqua**: Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
            
            $em->persist($comment1);
            $em->persist($comment2);
            $em->persist($comment3);
	 
	    $em->flush();
            
	    $this->addReference('comment-comment1', $comment1);
            $this->addReference('comment-comment2', $comment2);
            $this->addReference('comment-comment3', $comment3);

    }

    public function getOrder()
    {
        return 3; // the order in which fixtures will be loaded
    }
}