<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
//use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class Test extends Controller
{
	public function list()
	{
		return new Response ('about shiit');
	}
}
