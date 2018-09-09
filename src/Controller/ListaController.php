<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Lista;
use App\Entity\Produto;
use App\Entity\ListProducts;
use Symfony\Component\HttpFoundation\JsonResponse;

class ListaController extends Controller
{
    protected $list;
    
    public function __construct() {}
    
    
    /**
     * Adiciona à lista novo produto
     * @param int $product
     */
    public function add($id, $produto)
    {
        $produto = $this->getDoctrine()->getRepository(Produto::class)->find($produto);
        $lista = $this->getDoctrine()->getRepository(Lista::class)->find($id);
        
        $ListProducts = new ListProducts();
        $ListProducts->setLista($lista);
        $ListProducts->setProduto($produto);
        
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($ListProducts);
        $entityManager->flush();
        
        return new Response(
            'Saved new product with id: '.$id
            );
    }
    
    /**
     * cria nova lista com produtos
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create()
    {
        die;
        $lista = new Lista();
        $lista->setName('Mais um');
        //$lista->setDate($d);
        $lista->setQuantity(1);

        $produto = $this->getDoctrine()
        ->getRepository(Produto::class)
        ->find(15);
        
        $ListProducts = new ListProducts();
        $ListProducts->setLista($lista);
        $ListProducts->setProduto($produto);
        
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($ListProducts);
        $entityManager->flush();
        
        return new Response(
            'Saved new product with id: '.$ListProducts->getId()
            );
        
    }
    /**
     * Listar todos os produtos de uma lista 
     */
    public function list($id)
    {
        $doc = $this->getDoctrine()->getManager();  
        
        $lista = $this->getDoctrine()
        ->getRepository(Lista::class)->find($id);
        
        $lista_produtos = $this->getDoctrine()
        ->getRepository(ListProducts::class)
        ->findById($lista->getId());
        
        if (!$lista_produtos) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
                );
        }
        //var_dump($lista_produtos); die;
        $all = [];
        foreach ($lista_produtos as $lp) {
            $all[$lp['id']] = $lp['name'];
        }
        
        $all['user'] = $lista_produtos[0]['user'];
        
        return new JsonResponse($all);
    }
}