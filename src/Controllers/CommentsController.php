<?php

namespace App\Controllers;

use Silex\Application;
use App\Models\Comments;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints as Assert;

class CommentsController
{

    public function indexAction(Application $app)
    {
        $builder = new Comments($app);
        $comments = $builder->getAllComments();

        return $app['twig']->render('index.html.twig', array(
            'comments' => $comments
        ));
    }

    public function commentAction(Application $app, $id)
    {
        $builder = new Comments($app);
        $comment = $builder->getComment($id);

        return $app['twig']->render('comment.html.twig', array(
            'comment' => $comment,
        ));
    }

    public function formAction(Application $app)
    {
        $data = array(
            'name' => '',
            'email' => '',
        );

        $form = $app['form.factory']->createBuilder(FormType::class, $data)
            ->add('name', TextType::class, array(
                'constraints' => array(new Assert\NotBlank(), new Assert\Length(array('min' => 5)))
            ))
            ->add('email', TextType::class, array(
                'constraints' => new Assert\Email()
            ))
            ->add('ip', HiddenType::class, array(
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

    public function addAction(Application $app)
    {
        var_dump($_POST);
        die();
    }
}