<?php

namespace Tests\Feature\Restaurants;

use App\Restaurants\RestaurantProfileResolver;
use App\Restaurants\RestaurantProfileValidator;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class RestaurantProfileTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Local contact configuration must never influence test data or failure output.
        foreach (['dar-al-sufra', 'saj-wa-zaytoun'] as $key) {
            config()->set("restaurants.profiles.$key.contacts.whatsapp", null);
            config()->set("restaurants.profiles.$key.contacts.phone", null);
            config()->set("restaurants.profiles.$key.contacts.ordering_enabled", false);
            config()->set("restaurants.profiles.$key.branches.0.phone", null);
        }
    }

    public function test_one_selection_switches_the_entire_profile_without_leaking_content(): void
    {
        $resolver = $this->app->make(RestaurantProfileResolver::class);
        config()->set('restaurants.active', 'dar-al-sufra');

        $first = $resolver->resolve();
        config()->set('restaurants.active', 'saj-wa-zaytoun');
        $second = $resolver->resolve();

        $this->assertSame('دار السفرة', $first['name']);
        $this->assertSame('صاج وزيتون', $second['name']);
        $this->assertSame(config('restaurants.profiles.saj-wa-zaytoun'), $second);
        $this->assertSame(['chicken-musakhan', 'shish-tawook', 'hummus', 'mint-lemon', 'family-saj'], array_column($second['items'], 'id'));
        $this->assertSame(['saj', 'grill', 'starters', 'drinks', 'family'], array_column($second['categories'], 'id'));
        $this->assertSame(['family-saj'], $second['offers']['item_ids']);
    }

    #[DataProvider('invalidSelections')]
    public function test_invalid_selection_fails_without_falling_back(mixed $selection): void
    {
        config()->set('restaurants.active', $selection);
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid restaurant configuration: active profile.');

        $this->app->make(RestaurantProfileResolver::class)->resolve();
    }

    public static function invalidSelections(): array
    {
        return ['unknown' => ['missing'], 'missing' => [null], 'array' => [[]], 'numeric' => [1]];
    }

    public function test_mismatched_profile_identity_fails(): void
    {
        config()->set('restaurants.active', 'dar-al-sufra');
        config()->set('restaurants.profiles.dar-al-sufra.key', 'saj-wa-zaytoun');
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('profile key mismatch');

        $this->app->make(RestaurantProfileResolver::class)->resolve();
    }

    #[DataProvider('invalidProfiles')]
    public function test_invalid_profile_is_rejected_with_a_safe_field_diagnostic(string $path, mixed $value, string $field): void
    {
        $profile = config('restaurants.profiles.dar-al-sufra');
        data_set($profile, $path, $value);
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid restaurant configuration: '.$field.'.');

        (new RestaurantProfileValidator)->validate($profile);
    }

    public static function invalidProfiles(): array
    {
        return [
            'missing item ID' => ['items.0.id', null, 'items.id'],
            'duplicate item ID' => ['items.1.id', 'chicken-kabsa', 'items.duplicate_id'],
            'missing category ID' => ['categories.0.id', null, 'categories.id'],
            'duplicate category ID' => ['categories.1.id', 'main', 'categories.duplicate_id'],
            'missing branch ID' => ['branches.0.id', null, 'branches.id'],
            'unsafe ID' => ['items.0.id', '../secret', 'items.id'],
            'string money' => ['items.0.price_minor', '3200', 'items.price_minor'],
            'float money' => ['items.0.price_minor', 3200.0, 'items.price_minor'],
            'negative money' => ['items.0.price_minor', -1, 'items.price_minor'],
            'boolean money' => ['items.0.price_minor', true, 'items.price_minor'],
            'availability type' => ['items.0.available', 1, 'items.available'],
            'currency' => ['currency.code', 'USD', 'currency'],
            'precision' => ['currency.minor_digits', 3, 'currency'],
            'precision type' => ['currency.minor_digits', '2', 'currency'],
            'timezone' => ['timezone', 'Not/AZone', 'timezone'],
            'offset timezone' => ['timezone', '+03:00', 'timezone'],
            'missing weekday' => ['hours.monday', null, 'hours.monday'],
            'invalid hour' => ['hours.monday.0.start', '24:00', 'hours.time'],
            'invalid minute' => ['hours.monday.0.end', '12:60', 'hours.time'],
            'equal endpoints' => ['hours.monday.0.end', '12:00', 'hours.equal_endpoints'],
            'overlapping shifts' => ['hours.monday', [['start' => '12:00', 'end' => '15:00'], ['start' => '14:00', 'end' => '16:00']], 'hours.overlap'],
            'overnight overlap' => ['hours.saturday.0.start', '00:30', 'hours.overlap'],
            'week rollover overlap' => ['hours.sunday', [['start' => '23:00', 'end' => '13:00']], 'hours.overlap'],
            'recipient plus' => ['contacts.whatsapp', '+12025550101', 'contacts.whatsapp'],
            'recipient too short' => ['contacts.whatsapp', '123', 'contacts.whatsapp'],
            'recipient too long' => ['contacts.whatsapp', '1234567890123456', 'contacts.whatsapp'],
            'recipient number type' => ['contacts.whatsapp', 12025550101, 'contacts.whatsapp'],
            'recipient zero prefix' => ['contacts.whatsapp', '02025550101', 'contacts.whatsapp'],
            'recipient injection' => ['contacts.whatsapp', 'secret?text=private', 'contacts.whatsapp'],
            'enabled without recipient' => ['contacts.ordering_enabled', true, 'contacts.whatsapp'],
            'enabled type' => ['contacts.ordering_enabled', 'true', 'contacts.ordering_enabled'],
            'phone scheme' => ['branches.0.phone', 'tel:12025550101', 'branches.phone'],
            'theme CSS injection' => ['theme.colors.primary', 'red;display:none', 'theme.colors.primary'],
            'unknown theme token' => ['theme.colors.custom', '#FFFFFF', 'theme.colors'],
            'font CSS injection' => ['theme.font', 'url(external)', 'theme.font'],
            'unknown category' => ['items.0.category_id', 'missing', 'items.category_id'],
            'unknown bestseller' => ['bestsellers.item_ids', ['missing'], 'bestsellers.item_ids'],
            'duplicate reference' => ['bestsellers.item_ids', ['jareesh', 'jareesh'], 'bestsellers.item_ids'],
            'offer without bundle' => ['offers.item_ids', ['jareesh'], 'offers.bundle'],
            'empty bundle' => ['items.4.bundle.contents', [], 'items.bundle.contents'],
            'missing serving guidance' => ['items.4.bundle.serving', '', 'items.bundle.serving'],
            'missing hero copy' => ['hero.copy', ' ', 'hero.copy'],
            'missing story' => ['story', null, 'story'],
            'missing image description' => ['hero.image.alt', '', 'hero.image.alt'],
            'remote image' => ['hero.image.path', 'https://example.com/image.jpg', 'hero.image.path'],
            'traversal image' => ['hero.image.path', 'images/restaurants/../secret.jpg', 'hero.image.path'],
            'image without rights record' => ['hero.image.path', 'images/restaurants/dar-al-sufra/hero.webp', 'hero.image.attribution'],
            'unsafe map scheme' => ['branches.0.map_url', 'javascript:alert(1)', 'branches.map_url'],
            'map credentials' => ['branches.0.map_url', 'https://user:secret@example.com', 'branches.map_url'],
            'no branches' => ['branches', [], 'branches'],
            'unordered item shape' => ['items', ['dish' => []], 'items'],
        ];
    }

    public function test_closed_week_empty_menu_and_sold_out_items_are_valid_browsing_states(): void
    {
        $profile = config('restaurants.profiles.dar-al-sufra');
        $profile['hours'] = array_fill_keys(array_keys($profile['hours']), []);
        $profile['items'][0]['available'] = false;
        $profile['items'][0]['price_minor'] = 0;
        $validator = new RestaurantProfileValidator;

        $validator->validate($profile);
        $profile['items'] = [];
        $profile['bestsellers']['item_ids'] = [];
        $profile['offers']['item_ids'] = [];
        $validator->validate($profile);
        $profile['categories'] = [];
        $validator->validate($profile);

        $this->assertSame([], $profile['items']);
    }

    public function test_adjoining_shifts_and_week_rollover_are_valid(): void
    {
        $profile = config('restaurants.profiles.dar-al-sufra');
        $profile['hours'] = array_fill_keys(array_keys($profile['hours']), []);
        $profile['hours']['sunday'] = [['start' => '23:00', 'end' => '01:00']];
        $profile['hours']['monday'] = [['start' => '01:00', 'end' => '12:00'], ['start' => '12:00', 'end' => '14:00']];

        (new RestaurantProfileValidator)->validate($profile);

        $this->assertSame('01:00', $profile['hours']['monday'][0]['start']);
    }

    public function test_configured_recipient_is_selected_without_sharing_it_between_profiles(): void
    {
        // Fictional test-only values; no outbound request is made.
        config()->set('restaurants.profiles.dar-al-sufra.contacts.whatsapp', '12025550101');
        config()->set('restaurants.profiles.dar-al-sufra.contacts.ordering_enabled', true);
        config()->set('restaurants.profiles.saj-wa-zaytoun.contacts.whatsapp', '12025550102');
        $resolver = $this->app->make(RestaurantProfileResolver::class);
        config()->set('restaurants.active', 'dar-al-sufra');

        $first = $resolver->resolve();
        config()->set('restaurants.active', 'saj-wa-zaytoun');
        $second = $resolver->resolve();

        $this->assertSame('12025550101', $first['contacts']['whatsapp']);
        $this->assertSame('12025550102', $second['contacts']['whatsapp']);
        $this->assertSame(true, $first['contacts']['ordering_enabled']);
        $this->assertSame(false, $second['contacts']['ordering_enabled']);
    }

    public function test_profiles_survive_configuration_export_and_reload(): void
    {
        $profiles = config('restaurants.profiles');
        // Mirrors Laravel's trusted config export without caching the local .env or writing secrets.
        $restored = eval('return '.var_export($profiles, true).';');
        config()->set('restaurants.profiles', $restored);

        foreach (['dar-al-sufra', 'saj-wa-zaytoun'] as $key) {
            config()->set('restaurants.active', $key);
            $this->assertSame($profiles[$key], $this->app->make(RestaurantProfileResolver::class)->resolve());
        }
    }
}
