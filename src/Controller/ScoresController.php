<?php
    namespace App\Controller;

    use App\Entity\Score;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Routing\Annotation\Route;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;

    class ScoresController extends AbstractController {
        /**
        * @Route("/", name="score_list")
        * @Method({"GET"}, {"POST"})
        */
        public function index(Request $request){
            $score = new Score();

            $form = $this->createFormBuilder($score)
                ->add('name', TextType::class, array('attr' => array('class' => 'form-control')))
                ->add('difficulty', TextType::class, array('attr' => array('class' => 'form-control')))
                ->add('score', TextType::class, array('attr' => array('class' => 'form-control')))
                ->add('save', SubmitType::class, array(
                    'label' => 'Save new Score',
                    'attr' => array('class' => 'btn btn-primary mt-3')))
                ->getForm();

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $score = $form->getData();

                $entityManager = $this->getDoctrine()->getManager();
                $score->setAuthorised(false);

                $entityManager->persist($score);

                $entityManager->flush();
            }
            
            $scores = $this->getDoctrine()->getRepository(Score::class)->findAll();

            return $this->render('scores/index.html.twig', array('admin' => false, 'scores' => $scores, 'form' => $form->createView()));
        }

        /**
         * @Route("/score/new", name="new_score")
         * @Method({"POST"})
         */
        public function new(Request $request){
        }

        /**
        * @Route("/admin")
        * @Method({"GET"})
        */
        public function admin(){
            $scores = $this->getDoctrine()->getRepository(Score::class)->findAll();
            return $this->render('scores/index.html.twig', array('admin' => true, 'scores' => $scores));
        }

        /**
         * @Route("/score/save")
         */
        public function save(){
            /*
            $entityManager = $this->getDoctrine()->getManager();
            $score = new Score();
            $score->setName("John");
            $score->setDifficulty("Medium");
            $score->setScore("10000");
            $score->setAuthorisation(true);

            $entityManager->persist($score);
            $entityManager->flush();

            return new Response("Saved data with ID: " . $score->getId());
            */
        }
    }
?>