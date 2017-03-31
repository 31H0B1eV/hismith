<?php

namespace App\Controllers;

use Silex\Application;
use App\Models\Comments;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints as Assert;

class CommentsController
{

    /**
     * Index page
     * Get comments list
     *
     * @param Application $app
     * @return mixed
     */
    public function indexAction(Application $app)
    {
        $builder = new Comments($app);
        $comments = $builder->getAllComments();

        return $app['twig']->render('index.html.twig', array(
            'comments' => $comments
        ));
    }

    /**
     * Details page
     * Get single comment by id
     *
     * @param Application $app
     * @param $id
     * @return mixed
     */
    public function commentAction(Application $app, $id)
    {
        $builder = new Comments($app);
        $comment = $builder->getComment($id);
        $total = sizeof($builder->getAllComments()); // get total comments count for next&prev navigation

        return $app['twig']->render('comment.html.twig', array(
            'comment' => $comment,
            'total' => $total
        ));
    }

    /**
     * Form page
     *
     * @param Application $app
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function formAction(Application $app)
    {
        $data = array(
            'name' => '',
            'email' => '',
        );

        $form = $app['form.factory']->createBuilder(FormType::class, $data)
            ->add('author_name', TextType::class, array(
                'constraints' => new Assert\NotBlank()
            ))
            ->add('feedback_text', TextareaType::class, array(
                'constraints' => new Assert\NotBlank()
            ))
            ->add('published_at', HiddenType::class, array(
                'data' => date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME'])
            ))
            ->add('author_ip', HiddenType::class, array(
                'data' => $_SERVER['REMOTE_ADDR'],
            ))
            ->add('submit', SubmitType::class, [
                'label' => 'Save',
            ])
            ->getForm();

        $form->handleRequest($app['request_stack']->getCurrentRequest());

        if ($form->isValid()) {
            $data = $form->getData();

            // do something with the data

            // redirect somewhere
            return $app->redirect('...');
        }

        // display the form
        return $app['twig']->render('form.html.twig', array('form' => $form->createView()));
    }

    /**
     * Handler for POST form.
     * Save record into database,
     * Doctrine DBAL’s SQL Query Builder work in safe with data as described in docs
     * (http://docs.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/query-builder.html)
     *
     * @param Application $app
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addAction(Application $app)
    {
        $data = array(
            'author_name' => $_POST['form']['author_name'],
            'feedback_text' => $_POST['form']['feedback_text'],
            'published_at' => $_POST['form']['published_at'],
            'author_ip' => $_POST['form']['author_ip'],
        );

        $app['db']->createQueryBuilder()
            ->insert('comments')
            ->values(array(
                'author_name' => '?',
                'author_ip' => '?',
                'feedback_text' => '?',
                'published_at' => '?',
            ))
            ->setParameter(0, $data['author_name'])
            ->setParameter(1, ip2long($data['author_ip']))
            ->setParameter(2, trim(strip_tags($data['feedback_text'])))
            ->setParameter(3, $data['published_at'])
            ->execute();


//        $app['session']->getFlashBag()->add('message', 'Created!');
        return $app->redirect('/');
    }
}