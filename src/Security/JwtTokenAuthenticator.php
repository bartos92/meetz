<?php

namespace App\Security;

use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTDecodeFailureException;
use Lexik\Bundle\JWTAuthenticationBundle\TokenExtractor\AuthorizationHeaderTokenExtractor;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

class JwtTokenAuthenticator extends AbstractGuardAuthenticator
{

    private $jwtEncoder;
    private $em;

    public function __construct(JWTEncoderInterface $jwtEncoder, EntityManager $em) {

        $this->jwtEncoder = $jwtEncoder;
        $this->em = $em;
    }

    public function supports(Request $request)
    {
        return $request->headers->has('Authorization');
    }

    public function getCredentials(Request $request)
    {
        $extractor = new AuthorizationHeaderTokenExtractor(
            'Bearer',
            'Authorization'
        );
        $token = $extractor->extract($request);
        if(!$token) return;
        return $token;

    }

    public function getUser($credentials, UserProviderInterface $userProvider = null)
    {
        try {
            $data = $this->jwtEncoder->decode($credentials);
        } catch (JWTDecodeFailureException $e) {
            throw new CustomUserMessageAuthenticationException('Invalid Token');
        }

        if($data === false) { throw new CustomUserMessageAuthenticationException('Invalid token');}

        $username = $data['username'];

        return $this->em->getRepository(User::class)->findOneBy(['username' => $username]);

    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        return true;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        // TODO: Implement onAuthenticationFailure() method.
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        // do nothing
    }

    public function supportsRememberMe()
    {
        return false;
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        return new JsonResponse([
            'error' => $authException->getMessage()
        ], 401);
    }

}
