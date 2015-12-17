<?php
//src/BlogBundle/DataFixtures/ORM/LoadImageData.php

namespace BlogBundle\DataFixtures\ORM;
 
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use BlogBundle\Entity\Image;

class LoadImageData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
	    
	    $img_blog = new Image();
            $img_blog->setPost($em->merge($this->getReference('post-blog')));
	    $img_blog->setImage('blog.jpg');
            
	    $img_shop = new Image();
	    $img_shop->setPost($em->merge($this->getReference('post-shop')));
	    $img_shop->setImage('shop.jpg');
            
	    $em->persist($img_blog);
	    $em->persist($img_shop);
            
            foreach (range(0, 30) as $i) { //mamy 30 postów dlatego rand(0, 30)
                
                $img = new Image();
                
                $post = $this->getReference('post-post'.$i);
                $img->setPost($em->merge($post));
                
                switch ($post->getCategory()) {
                    case $this->getReference('category-blog'):
                        $img->setImage('blog.jpg');
                        break;
                    case $this->getReference('category-shop'):
                        $img->setImage('shop.jpg');
                        break;
                    default:
                       $img->setImage(null);
                }
                
                $em->persist($img);
            }
            
	 
	    $em->flush();
    }

    public function getOrder()
    {
        return 3; // the order in which fixtures will be loaded
    }
    
}