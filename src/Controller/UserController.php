<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Services\FakerService;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{

    private $fakerService;
    private $entityManager;

    public function __construct(FakerService $fakerService, EntityManagerInterface $entityManager)
    {
        $this->fakerService = $fakerService;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/", name="user")
     */
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/about", name="aboutuser")
     */
    public function index2(Request $request): Response
    {
        dump($request);
        return new Response("<body>A propos</body>");
    }

    /**
     * @Route("/{id}", name="iduser", requirements={"id"="[0-9]*"}, methods={"GET"})
     */
    // public function index3($id): Response
    // {
    //     return new Response("<body>$id</body>");
    // }

    /**
     * @Route("/{id}", name="iduserpost", requirements={"id"="[0-9]*"}, methods={"POST"})
     */
    // public function indexPost($id): Response
    // {
    //     return new Response("<body>c'est le user $id</body>");
    // }

    /**
     * @Route("/generate/{number}", name="generateuser")
     */
    public function indexGenerate($number): Response
    { 
        $faker = \Faker\Factory::create();
        $noms = [];

        for ($i = 0; $i < $number; $i++) {
            array_push($noms, $faker->name());
        }

        return $this->render('user/user.html.twig', [
            'controller_name' => 'UserController',
            'noms' => $noms
        ]);
    }

    
    /**
     * @Route("/newuser",name="newuser")
     */
    public function newUser() {
        $newUser = new User();
        $newUser->setName("Michel");
        $newUser->setAge("37");
        $newUser->setEmail("Michel@gmail.com");

        $this->entityManager->persist($newUser);
        $this->entityManager->flush();

        dump($newUser);
        return new Response("<body></body>");
    }

    /**
     * @Route("/list",name="userList")
     */
    public function userList() : Response
    {
        $usersRepo = $this->entityManager->getRepository(User::class);

        $users = $usersRepo->findAll();

        dump($users);

        return new Response("<body>Liste</body>");
    }

    /**
     * @Route("/profile",name="profile")
     */
    public function getProfile() {
        return new Response("<body>Profil de " . $this->getUser()->getUserIdentifier() . "</body>");
    }

    /**
     * @Route("/{iduser}",name="userShow")
     */
    public function userShow($iduser) : Response
    {
        $usersRepo = $this->entityManager->getRepository(User::class);

        $user = $usersRepo->find($iduser);
        // $user = $usersRepo->findBy(array("id"=>$iduser));

        dump($user);
        return new Response("<body>L'user là</body>");
    }
}
