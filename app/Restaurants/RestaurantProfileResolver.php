<?php

namespace App\Restaurants;

use Illuminate\Contracts\Config\Repository;
use InvalidArgumentException;

class RestaurantProfileResolver
{
    public function __construct(
        private Repository $config,
        private RestaurantProfileValidator $validator,
    ) {}

    /** @return array<string, mixed> */
    public function resolve(): array
    {
        $key = $this->config->get('restaurants.active');
        $profiles = $this->config->get('restaurants.profiles');

        if (! is_string($key) || ! is_array($profiles) || ! isset($profiles[$key]) || ! is_array($profiles[$key])) {
            throw new InvalidArgumentException('Invalid restaurant configuration: active profile.');
        }

        $profile = $profiles[$key];
        $this->validator->validate($profile);

        if ($profile['key'] !== $key) {
            throw new InvalidArgumentException('Invalid restaurant configuration: profile key mismatch.');
        }

        return $profile;
    }
}
