<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Repository\ListaRepository;
use App\Entity\Lista;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Produto;
use App\Entity\ListProducts;
use PhpParser\Node\Expr\List_;

class ListaController extends Controller
{
    protected $list;
    
    public function __construct()
    {  
        
    }
    
    public function index()
    {
        $lista = new Lista();
        $lista->setName('Mais um');
        //$lista->setDate($d);
        $lista->setQuantity(1);
        
       # $produto = new Produto();
       # $produto->getId();

        $produto = $this->getDoctrine()
        ->getRepository(Produto::class)
        ->find(15);
        
        
        $ListProducts = new ListProducts();
        $ListProducts->setLista($lista);
        $ListProducts->setProduto($produto);
        #$produto->addListProduct($listProduct);
        
        
        #$ListProducts->setProduto($produto);
        
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($ListProducts);
       // $entityManager->persist($product);
        $entityManager->flush();
        
        return new Response(
            'Saved new product with id: '.$ListProducts->getId()
            );
        
    }
    
    public function list($id)
    {
        $doc = $this->getDoctrine()->getManager();  
        $lista = $this->getDoctrine()
        ->getRepository(Lista::class)
        ->find($id);
        
        $lista = $this->getDoctrine()
        ->getRepository(Lista::class)
        ->findOneByIdJoinedToList($id);
       
        //$listProducts = new ListProducts();
        //$l = $listProducts->addList($lista);
        /*
        echo '<pre>';
        print_r($l);
        echo '</pre>';
        
        die;
        */
        /*
        $produto = new Produto();
        $l = $produto->addListProduct($listProducts)->getListProducts();
        
        var_dump($l);
        
        foreach ($lista[0]['listProducts'] as $key=>$l) {
            
            
            echo $key;
        }
        //var_dump($lista); die;
        die;
        echo '<pre>';
        print_r($lista); 
        echo '</pre>';
        
        die;
        */
        if (!$lista) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
                );
        }
        
        return new Response('Check out this great product: '.$lista->getName());
        
    }
}