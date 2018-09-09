<?php
namespace App\Controller;

use App\Entity\Produto;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductController extends Controller{
    
    public function __construct(){}
    
    public function produtos()
    {
        $produtos = $this->getDoctrine()->getRepository(Produto::class)->allWithCategory();
       
       if (!$produtos) {
           throw $this->createNotFoundException(
               'No products founds.'
               );
       }
       
       $all = [];
       foreach ($produtos as $key => $produto) {
           $all[$key]['cat'] = $produto->getCategoryId()->getName();
           $all[$key]['name'] = $produto->getName();
           $all[$key]['id'] = $produto->getId();
       }
       
       return new JsonResponse($all);
    }
}   