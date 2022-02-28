<?php

namespace App\Controller;

use App\Entity\Pokemon;
use App\Entity\Type;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/pokemons", name="getAll")
     * @param ManagerRegistry $doctrine
     * @return JsonResponse
     */
    public function getAll(ManagerRegistry $doctrine)
    {
        if(isset($_GET['type'])) $type = $_GET['type'];

        $em=$doctrine->getManager();

        if(!empty($type))
        {
            $ressourceType= $em->getRepository(Type::class)->findAll();

            $datas = array();
            foreach ($ressourceType as $key => $ressource){
                if($ressource->getLabel()===$type) {
                    $datas[$key]['name'] = $ressource->getLabel();
                    foreach ($ressource->getListPokemon() as $pokemon) {
                        $datas[$key]['pokemon'][$pokemon->getId()]['name'] = $pokemon->getName();
                        $datas[$key]['pokemon'][$pokemon->getId()]['description'] = $pokemon->getDescription();
                    }
                };
            }
            if(empty($datas)) return new JsonResponse('Aucun pokemon de ce type dans notre base de donnees');
            if(isset($_GET['page'])) {
                $datas=array_slice($datas[0]['pokemon'],0, $_GET['page']);
            }
            return new JsonResponse($datas);
        }
        else {
            $ressources= $em->getRepository(Pokemon::class)->findAll();

            $datas = array();
            foreach ($ressources as $key => $ressource){
                $datas[$key]['name'] = $ressource->getName();
                $datas[$key]['description'] = $ressource->getDescription();
                foreach ($ressource->getType() as $type) {
                    $datas[$key]['type'][$type->getId()] = $type->getLabel();
                }
            }
            if(empty($datas)) return new JsonResponse('Aucun pokemon dans notre base de donnees');
            if(isset($_GET['page'])) {
                $datas=array_slice($datas[0]['pokemon'],0, $_GET['page']);
            }
            return new JsonResponse($datas);
        }
    }

    /**
     * @Route("/pokemon", name="getOne")
     * @param ManagerRegistry $doctrine
     * @return JsonResponse
     */
    public function getOne(ManagerRegistry $doctrine)
    {
        if(!isset($_GET['name'])) {
            return new JsonResponse('Veuillez renseignez un nom');
        }
        $name = $_GET['name'];
        $em=$doctrine->getManager();
        $ressources= $em->getRepository(Pokemon::class)->findBy(['name' => $name]);
        $datas = array();
        foreach ($ressources as $key => $ressource){
            $datas[$key]['name'] = $ressource->getName();
            $datas[$key]['description'] = $ressource->getDescription();
            foreach ($ressource->getType() as $type) {
                $datas[$key]['type'][$type->getId()] = $type->getLabel();
            }
        }
        if(empty($datas)) return new JsonResponse('Aucun pokemon de ce nom dans notre base de donnees');
        return new JsonResponse($datas);
    }
}
