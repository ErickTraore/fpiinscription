<?php

namespace App\Controller;

use App\Entity\Count;
use App\Entity\adhesion;
use App\Form\CountType;
use App\Repository\AdhesionRepository;
use Stripe\BalanceTransaction;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\NotBlank;

  /**
   * @Route("/cotisation")
   */
class CotisationController extends AbstractController
{
    /**
      *@var AdhesionRepository
      *
      */
    private $repository;

    public function __construct(AdhesionRepository $repository)
    {
        $this->repository = $repository;
    }
  
    /**
    * @Route("/paiement", name="cotisation_paiement")
    */
    public function paiement(Request $request, AdhesionRepository $repository)
    {
        if (isset($_POST['stripeToken'])) {
            // \Stripe\Stripe::setApiKey("sk_test_NAzldBsleRwMMbtOKprXgq3R");
            \Stripe\Stripe::setApiKey("sk_live_6SfP2cSgoy5oNl8Tan8eWSJV");
            $token = $_POST['stripeToken'];
            
            $amountdeux = $_POST['amountrois'];
            $nbremois = ($amountdeux / 500);
            $charge = \Stripe\Charge::create([
            'amount' => $amountdeux,
            'currency' => 'eur',
            'description' => 'Discover France Guide',
            'source' => $token,
                  ]);
            $description = 'paiement en ligne';
            $ref = 'Don';
            $user = $this->getUser();
            $adhesion = $user->getAdhesion();
            $adhesionId = $user->getAdhesion()->getId();
            var_dump($amountdeux );
            var_dump($description );

           
            if (!empty($amountdeux) && !empty($description) && !empty($adhesion) && !empty($ref) && !empty($nbremois)) {
              
                return $this->redirectToRoute('adhesion_maj', [
                    'adhesionId' => $adhesionId,
                    'nbremois' => $nbremois,
                    'amountdeux' => $amountdeux
                ]);
            }
        }
        return $this->render('cotisation/traitement_stripe.html.twig');
    }

    /**
    * @Route("/paiement_abonnement", name="cotisation_paiement_abonnement")
    */
    public function paiement_abonnement(Request $request, AdhesionRepository $repository)
    {
            if (isset($_POST['stripeToken'])) {
                // \Stripe\Stripe::setApiKey("sk_test_NAzldBsleRwMMbtOKprXgq3R");
                \Stripe\Stripe::setApiKey("sk_live_6SfP2cSgoy5oNl8Tan8eWSJV");
                $token = $_POST['stripeToken'];
            
                $amountdeux = $_POST['amountrois'];
                // $nbremois = ($amountdeux / 500);
                $charge = \Stripe\Charge::create([
            'amount' => $amountdeux,
            'currency' => 'eur',
            'description' => 'Discover France Guide',
            'source' => $token,
                  ]);
                $description = 'paiement en ligne';
                $ref = 'Don';
                $user = $this->getUser();
                $adhesion = $user->getAdhesion();
                $adhesionId = $user->getAdhesion()->getId();

           
                if (!empty($amountdeux) && !empty($description) && !empty($adhesion) && !empty($ref)) {
                    return $this->redirectToRoute('adhesion_maj_abonnement', [
                    'adhesionId' => $adhesionId,
                   // 'nbremois' => $nbremois,
                    'amountdeux' => $amountdeux
                ]);
                }
            }
            return $this->render('cotisation/traitement_stripeabonnement.html.twig');
        }
  

    /**
    * @Route("/formPaiement", name="cotisation_formPaiement")
    */
    public function formPaiement(Request $request):Response
    {
        if (!empty($_POST['amountun'])) {
            $extractarif = $_POST['amountun'];

            if (!empty($_POST['Annuler'])) {
                return $this->redirectToRoute('home');
            }
  
            return $this->render('cotisation/traitement_stripe.html.twig', [
      'amountdeux' => $extractarif,
                 ]);
        }
        return $this->render('cotisation/formPaiement.html.twig');
    }

      /**
    * @Route("/formdon", name="cotisation_formdon")
    */
    public function formdon(Request $request):Response
    {
        if (!empty($_POST['amountun'])) {
            $extractarif = $_POST['amountun'];     

            // if ($_POST['Annuler'] = "Annuler") {
            //     return $this->redirectToRoute('home');  
            // }
 

  
            return $this->render('cotisation/traitement_stripeabonnement.html.twig', [
      'amountdeux' => $extractarif,
                 ]);
        }
        return $this->render('cotisation/formdon.html.twig');
    }

    

}