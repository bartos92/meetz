<?php

namespace App\Controller;

use App\Entity\User;
use App\Security\JwtTokenAuthenticator;
use Doctrine\ORM\EntityManager;
use GuzzleHttp\Client;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/user")
 */
class SecurityController extends Controller
{
    private $em;
    private $passwordEncoder;
    private $tokenEncoder;
    private $jwtTokenAuthenticator;

    public function __construct(EntityManager $em, UserPasswordEncoderInterface $passwordEncoder, JWTEncoderInterface $tokenEncoder, JwtTokenAuthenticator $jwtTokenAuthenticator) {
        $this->em = $em;
        $this->passwordEncoder = $passwordEncoder;
        $this->tokenEncoder = $tokenEncoder;
        $this->jwtTokenAuthenticator = $jwtTokenAuthenticator;
    }

    /**
     * @Route("/get-token", name="token_get")
     */
    public function getTokenAction(Request $request)
    {
        $username = $request->get('username');
        $password = $request->get('password');
        $user = $this->em->getRepository(User::class)->findOneBy(['username' => $username]);
        if (!$user) return new JsonResponse(['Error' => 'User not found']);
        if (!$this->passwordEncoder->isPasswordValid($user, $password)) return new JsonResponse(['Error' => 'Password incorrect']);
        $token = $this->tokenEncoder->encode([
            'username'=> $user->getUsername(),
            'exp' => time() + 3600 * 24
        ]);

        return new JsonResponse(['token' => $token]);
    }

    /** @Route("/get", name="user_get") */
    public function getUserAction()
    {
        $userD = $this->getUser();

        return new JsonResponse(['userD' => $userD->getUsername()]);

    }
}
