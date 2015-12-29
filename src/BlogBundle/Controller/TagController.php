<?php

namespace BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use BlogBundle\Entity\Tag;

class TagController extends Controller
{

    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
 
        $tag = $em->getRepository('BlogBundle:Tag')->findOneBySlug($slug);
        
        if (!$tag) {
            throw $this->createNotFoundException('Unable to find Tag entity.');
        }
        
        $tag->setActivePosts($em->getRepository('BlogBundle:Post')->getPostsFromTag($tag->getId()));
        
        $categories = $em->getRepository('BlogBundle:Category')->getWithPosts(); //pobranie wszystkich kategorii, które mają posty
        
        $tags = $em->getRepository('BlogBundle:Tag')->getWithPosts(); //pobranie wszystkich tagów, które mają posty
        
        $archives = $em->getRepository('BlogBundle:Post')->getArchives();
        
        $recent_posts = $em->getRepository('BlogBundle:Post')->findBy(array(), array(), 10);
        
        return $this->render('BlogBundle:Tag:show.html.twig', array(
            'tag' => $tag,
            'categories' => $categories,
            'tags' => $tags,
            'archives' => $archives,
            'recent_posts' => $recent_posts,
        ));
    }
}