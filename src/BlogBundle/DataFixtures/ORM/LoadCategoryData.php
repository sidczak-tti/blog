<?php
//src/BlogBundle/DataFixtures/ORM/LoadPostData.php

namespace BlogBundle\DataFixtures\ORM;
 
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use BlogBundle\Entity\Category;
 
class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
	    $no_category = new Category();
	    $no_category->setName('No category');
	    $no_category->setDescription('Desktops No category');
	    $no_category->setImage('no-category.jpg');
	    $no_category->setIsActive(1);
	    
	    $blog = new Category();
	    $blog->setName('Blog');
	    $blog->setDescription('Blog Description');
	    $blog->setImage('blog.jpg');
	    $blog->setIsActive(1);
	    
	    $shop = new Category();
	    $shop->setName('Shop');
	    $shop->setDescription('Shop Description');
	    $shop->setImage('shop.jpg');
	    $shop->setIsActive(1);
	    	 
	    $em->persist($no_category);
            $em->persist($blog);
	    $em->persist($shop);
	 
	    $em->flush();
            
            $this->addReference('category-no_category', $no_category);
	    $this->addReference('category-blog', $blog);
	    $this->addReference('category-shop', $shop);
    }

    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}