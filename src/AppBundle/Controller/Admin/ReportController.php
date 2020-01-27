<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Report;
use AppBundle\Entity\Post;
use AppBundle\Entity\Comment;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 *
 * @Route("/admin/report")
 * @Security("has_role('ROLE_ADMIN')")
 *
 */
class ReportController extends Controller
{

    /**
     * Lists all Report entities.
     *
     * @Route("/index", name="admin_report_index")
     * @Route("/", name="admin_report_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $reports = $entityManager->getRepository(Report::class)->findBy(['author' => $this->getUser()], ['createdAt' => 'DESC']);
        extract($this->refreshAction());

        return $this->render('admin/report/index.html.twig', [
            'reports' => $reports, 
            'posts' => $posts, 
            'comments' => $comments
        ]);
    }

    /**
     * Returns count of posts and comments.
     *
     * @Route("/refresh", name="admin_report_refresh")
     * @Method("GET")
     */
    public function refreshAction(Request $request = null)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $posts = $entityManager->getRepository(Post::class)->createQueryBuilder('a')
            ->select('count(a.id)')
            ->getQuery()
            ->getSingleScalarResult();

        $comments = $entityManager->getRepository(Comment::class)->createQueryBuilder('a')
            ->select('count(a.id)')
            ->getQuery()
            ->getSingleScalarResult();

        $data = [
            'posts' => $posts,
            'comments' => $comments
        ];

        if(is_null($request)) {
            return $data;
        } elseif($request->isXmlHttpRequest()) {
            return new JsonResponse($data);
        } else {
            return $this->redirectToRoute('admin_report_index');
        }
    }


    /**
     * Creates a new Report entity.
     *
     * @Route("/new", name="admin_report_new")
     * @Method("GET")
     *
     */
    public function newAction(Request $request)
    {
        $report = new Report();
        $report->setAuthor($this->getUser());

        extract($this->refreshAction());
        $report->setPosts($posts);
        $report->setComments($comments);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($report);
        $entityManager->flush();

        $this->addFlash('success', 'report.created_successfully');

        return $this->redirectToRoute('admin_report_index');
    }

}
