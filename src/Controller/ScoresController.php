<?php
    namespace App\Controller;

    use App\Entity\Score;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Routing\Annotation\Route;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
    use Symfony\Component\Form\Extension\Core\Type\IntegerType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;

    class ScoresController extends AbstractController {
        /**
        * @Route("/", name="score_list")
        * @Method({"GET"}, {"POST"})
        */
        public function index(Request $request){
            $score = new Score();

            $entityManager = $this->getDoctrine()->getManager();

            //Build the form used to add a new score
            $form = $this->createFormBuilder($score)
                ->add('name', TextType::class, array('attr' => array('class' => 'form-control')))
                ->add('difficulty', ChoiceType::class, array(
                    'attr' => array('class' => 'form-control'),
                    'choices' => array('Easy' => 'Easy', 'Medium' => 'Medium', 'Hard' => 'Hard')))
                ->add('score', IntegerType::class, array('attr' => array('class' => 'form-control')))
                ->add('save', SubmitType::class, array(
                    'label' => 'Save new Score',
                    'attr' => array('class' => 'btn btn-primary mt-3')))
                ->getForm();

            $form->handleRequest($request);

            //If data is submitted, create a new score entry
            if($form->isSubmitted() && $form->isValid()){
                $score = $form->getData();
                $score->setAuthorised(false);
                $entityManager->persist($score);
                $entityManager->flush();
            }
            
            //Get JSON data via API call
            $url = "highscores.test/score/data";                //API URL. CHANGE FOR YOUR LOCAL INSTALL
            $data = ['collection' => 'scores'];                 //Collection object
            $curl = curl_init($url);                            //Initializes a new cURL session
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);   //Set the CURLOPT_RETURNTRANSFER option to true
            curl_setopt($curl, CURLOPT_POST, false);            //Set the CURLOPT_POST option to false for GET request
            $response = curl_exec($curl);                       //Execute cURL request with all previous settings
            curl_close($curl);                                  //Close cURL session

            //Convert JSON into object
            $scores = json_decode($response);

            //Show the user the authorised scores page
            return $this->render('scores/index.html.twig', array('admin' => false, 'scores' => $scores, 'form' => $form->createView()));
        }

        /**
        * @Route("/admin")
        * @Method({"GET"})
        */
        public function admin(){
            //Get all scores
            $scores = $this->getDoctrine()->getRepository(Score::class)->findBy(array(), array('score' => 'DESC'));

            //Show the admin all the scores
            return $this->render('scores/index.html.twig', array('admin' => true, 'scores' => $scores));
        }

        /**
        * @Route("/score/data")
        * @Method({"GET"})
        */
        public function data(){
            //Get scores in descending order
            $entityManager = $this->getDoctrine()->getManager();
            $qb = $entityManager->createQueryBuilder()
                ->select('s')
                ->from(Score::class, 's')
                ->where('s.authorised = 1')
                ->orderBy('s.score', 'DESC');
            $scores = $qb->getQuery()->getResult();

            //Encode into JSON
            $json = json_encode($scores);
            return new Response($json);
        }

        /**
         * @Route("/score/delete/{id}")
         * @Method({"DELETE"})
         */
        public function delete(Request $request, $id){
            //Get the individual score
            $score = $this->getDoctrine()->getRepository(Score::class)->find($id);

            //Remove it
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($score);
            $entityManager->flush();

            //Send a response
            $response = new Response();
            $response->send();
        }

        /**
         * @Route("/score/authorise/{id}")
         */
        public function authorise($id){
            //Get the individual score
            $score = $this->getDoctrine()->getRepository(Score::class)->find($id);
            $entityManager = $this->getDoctrine()->getManager();
            
            //Change authorised to true (1)
            $score->setAuthorised(true);
            $entityManager->flush();

            //Redirect to see changes
            return $this->redirect("/admin");
        }
    }
?>