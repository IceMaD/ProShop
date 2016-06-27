<?php

namespace AppBundle\DataFixtures\Faker\Provider;

use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;

class PasswordProvider
{
    public function password($password, $salt)
    {
        $encoder = new BCryptPasswordEncoder(13);

        return $encoder->encodePassword($password, $salt);
    }

    public function salt()
    {
        return base64_encode(random_bytes(16));
    }
}
