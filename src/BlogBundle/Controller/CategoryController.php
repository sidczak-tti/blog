<?php

namespace BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use BlogBundle\Entity\Category;

class CategoryController extends Controller
{

    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
 
        $category = $em->getRepository('BlogBundle:Category')->findOneBySlug($slug);
        
        if (!$category) {
            throw $this->createNotFoundException('Unable to find Category entity.');
        }
        
        $category->setActivePosts($em->getRepository('BlogBundle:Post')->getPostsFromCategory($category->getId()));
        
        $categories = $em->getRepository('BlogBundle:Category')->getWithPosts(); //pobranie wszystkich kategorii, które mają posty
        
        $tags = $em->getRepository('BlogBundle:Tag')->getWithPosts(); //pobranie wszystkich tagów, które mają posty
        
        $archives = $em->getRepository('BlogBundle:Post')->getArchives();
        
        $recent_posts = $em->getRepository('BlogBundle:Post')->findBy(array(), array(), 10);
        
        return $this->render('BlogBundle:Category:show.html.twig', array(
            'category' => $category,
            'categories' => $categories,
            'tags' => $tags,
            'archives' => $archives,
            'recent_posts' => $recent_posts,
        ));
    }
}



