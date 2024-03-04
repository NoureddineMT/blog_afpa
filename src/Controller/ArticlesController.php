<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ArticlesController extends AbstractController
{
    #[Route('/articles', name: 'app_articles')]
    public function index(EntityManagerInterface $entityManager): Response
    {

        $articles = $entityManager->getRepository(Article::class)->findAll();
        // dd($articles);
        return $this->render('articles/index.html.twig', [
            'articles' => $articles,
        ]);
    }
    #[Route('/articles/{id}', name: 'app_get_article_by_id')]
    public function getArticleById(EntityManagerInterface $entityManager,
        int $id): Response
    {
        $article = $entityManager->getRepository(Article::class)->find($id);
        // dd($article);
        return $this->render('articles/show_artcile.html.twig', [
            'article' => $article,
        ]);
    }
}
