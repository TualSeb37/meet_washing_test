<?php
namespace App\Controller;


use App\CashRegister\Change;
use App\CashRegister\Currency;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CashRegister  extends AbstractController
{
    private CONST COIN_AVAILABLE = [2];
    private CONST BILL_AVAILABLE = [5, 10];

    /**
     * Undocumented function
     */
    public function __construct()
    {

    }

    /**
     * @ApiDoc(
     *    description="Permet d'effectuer les opérations de calcul pour la caisse enregistreuse"
     * )
     *
     * @Post\Get("/cash-register")
     * @param Request $request
     * @param string $param
     * @return JsonResponse
     */
    #[Route('/cash-register', name:'cash-register', methods:['POST'])]
    public function getCash(Request $request, SerializerInterface $serializer): JsonResponse
    {
        // On s'assure que c'est bien au format json que les données sont passées
        if($request->headers->get('Content-Type') != 'application/json') {
            return $this->json('Mauvais Header', 400, []) ;
        }

        $currency = new Currency();
        // Nous récupérons la valeur passées dans currency
        $serializer->deserialize($request->getContent(),Currency::class,'json');
        // la valeur fourni est inférieur à 2 la monnaie la plus petite qui peut être rendue
        if($currency < 2){
            $text = 'impossible de rendre de la monnaie sur ' . $currency .'€, nous pouvons rendre uniquement des pièces
            de 2€ ou des billets de 5€ et 10€';
            return $this->json($text, 400, []) ;
        }
        else {
            // On peut rendre de la monnaie, on va donc faires les calculs
            // Nous vérifions si l'option solutionOptimal est passé en paramètre à m'url avec true
            $optimalSolution = $request->attributes->get('solutionOptimal');
            if($optimalSolution) {
                return $this->json('solutionOptimal OK' . $optimalSolution, 400, []) ;
            }
            else {
                return $this->json('solutionOptimal KO : ' . $optimalSolution, 400, []) ;
            }
        }
    }

    public function possibleSolutions (int $currency): array
    {
        $finalChange = null;
        $change = new Change();
        $change[] = [];
        return $change ;
    }
}