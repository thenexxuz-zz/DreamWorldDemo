<?php
namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class PostController extends AbstractController
{
    public function index()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $mpQuery = $entityManager->createQuery(
            'SELECT p
                FROM App\Entity\Post p
                WHERE p.user = :user'
        )->setParameter('user', $this->get('security.token_storage')->getToken()->getUser());
        $opQuery = $entityManager->createQuery(
            'SELECT p
                FROM App\Entity\Post p
                WHERE p.user != :user'
        )->setParameter('user', $this->get('security.token_storage')->getToken()->getUser());
        $my_posts = $mpQuery->getResult();
        $others_posts = $opQuery->getResult();

        return $this->render('dashboard.html.twig', [
            'my_posts' => $my_posts,
            'others_posts' => $others_posts,
        ]);
    }

    public function create(Request $request)
    {
        if ($request->getMethod() === 'GET') {
            return $this->render('post.html.twig');
        }
        $entityManager = $this->getDoctrine()->getManager();
        $post = new Post();
        $post->setSlug(uniqid());
        $post->setTitle($request->get('title'));
        $post->setSummary($request->get('summary'));
        $post->setBody($request->get('body'));

        $usr = $this->get('security.token_storage')->getToken()->getUser();
        $post->setUser($usr);

        $entityManager->persist($post);
        $entityManager->flush();
        return $this->redirect('/dashboard');
    }

    public function update(Request $request, $slug)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $post = $entityManager->createQuery(
            'SELECT p
                FROM App\Entity\Post p
                WHERE p.slug = :slug
                AND p.user = :user'
        )->setParameter('slug', $slug)
            ->setParameter('user', $this->get('security.token_storage')->getToken()->getUser())->getOneOrNullResult();

        if (!$post) {
            return $this->redirect('/error');
        }

        if ($request->getMethod() === 'GET') {
            return $this->render('post/edit.html.twig', [
                'slug' => $slug,
                'post' => $post
            ]);
        }

        $updatedPost = $entityManager->getRepository(Post::class)->find($post->getId());
        $updatedPost->setTitle($request->get('title'));
        $updatedPost->setSummary($request->get('summary'));
        $updatedPost->setBody($request->get('body'));
        $entityManager->flush();

        return $this->redirect('/dashboard');
    }

    public function delete()
    {
        $posts = null;
        return $this->render('dashboard.html.twig', [
            'posts' => $posts,
        ]);
    }
}