<?php

namespace App\Restaurants;

use DateTimeZone;
use InvalidArgumentException;

class RestaurantProfileValidator
{
    private const DAYS = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

    private const COLORS = ['canvas', 'surface', 'surface-warm', 'ink', 'muted', 'primary', 'on-primary', 'border', 'success', 'danger', 'focus'];

    private const MINUTES_PER_DAY = 1440;

    private const MINUTES_PER_WEEK = 10080;

    /** @param array<string, mixed> $profile */
    public function validate(array $profile): void
    {
        $this->id($profile['key'] ?? null, 'key');
        foreach (['name', 'introduction', 'footer'] as $field) {
            $this->text($profile[$field] ?? null, $field);
        }
        $this->asset($profile['logo'] ?? null, 'logo');
        $currency = $this->record($profile['currency'] ?? null, 'currency');
        $this->check(($currency['code'] ?? null) === 'SAR' && ($currency['minor_digits'] ?? null) === 2, 'currency');
        $this->check(is_string($profile['timezone'] ?? null) && in_array($profile['timezone'], DateTimeZone::listIdentifiers(), true), 'timezone');
        $this->theme($profile['theme'] ?? null);
        $this->hours($profile['hours'] ?? null);
        $this->contacts($profile['contacts'] ?? null);

        foreach (['hero', 'bestsellers', 'menu', 'offers', 'story', 'contact'] as $section) {
            $content = $this->record($profile[$section] ?? null, $section);
            $this->text($content['heading'] ?? null, $section.'.heading');
            $this->text($content['copy'] ?? null, $section.'.copy');
            if (in_array($section, ['hero', 'story'], true)) {
                $this->asset($content['image'] ?? null, $section.'.image');
            }
        }

        $categories = $this->records($profile['categories'] ?? null, 'categories');
        $categoryIds = $this->uniqueIds($categories, 'categories');
        foreach ($categories as $category) {
            $this->text($category['name'] ?? null, 'categories.name');
        }

        $items = $this->records($profile['items'] ?? null, 'items');
        $itemIds = $this->uniqueIds($items, 'items');
        foreach ($items as $item) {
            $this->check(in_array($item['category_id'] ?? null, $categoryIds, true), 'items.category_id');
            foreach (['name', 'description'] as $field) {
                $this->text($item[$field] ?? null, 'items.'.$field);
            }
            $this->check(is_int($item['price_minor'] ?? null) && $item['price_minor'] >= 0, 'items.price_minor');
            $this->check(is_bool($item['available'] ?? null), 'items.available');
            $this->asset($item['image'] ?? null, 'items.image');
            if (array_key_exists('bundle', $item)) {
                $bundle = $this->record($item['bundle'], 'items.bundle');
                $contents = $this->list($bundle['contents'] ?? null, 'items.bundle.contents');
                $this->check($contents !== [], 'items.bundle.contents');
                foreach ($contents as $content) {
                    $this->text($content, 'items.bundle.contents');
                }
                $this->text($bundle['serving'] ?? null, 'items.bundle.serving');
            }
        }

        foreach (['bestsellers', 'offers'] as $section) {
            $references = $this->list($profile[$section]['item_ids'] ?? null, $section.'.item_ids');
            $seen = [];
            foreach ($references as $reference) {
                $this->check(is_string($reference) && in_array($reference, $itemIds, true) && ! in_array($reference, $seen, true), $section.'.item_ids');
                $seen[] = $reference;
                if ($section === 'offers') {
                    $item = $items[array_search($reference, $itemIds, true)];
                    $this->check(isset($item['bundle']), 'offers.bundle');
                }
            }
        }

        $branches = $this->records($profile['branches'] ?? null, 'branches');
        $this->check($branches !== [], 'branches');
        $this->uniqueIds($branches, 'branches');
        foreach ($branches as $branch) {
            foreach (['name', 'address'] as $field) {
                $this->text($branch[$field] ?? null, 'branches.'.$field);
            }
            $this->phone($branch['phone'] ?? null, 'branches.phone');
            $url = $branch['map_url'] ?? null;
            $this->check(is_string($url) && filter_var($url, FILTER_VALIDATE_URL) !== false && parse_url($url, PHP_URL_SCHEME) === 'https' && parse_url($url, PHP_URL_USER) === null && parse_url($url, PHP_URL_PASS) === null, 'branches.map_url');
        }
    }

    private function theme(mixed $value): void
    {
        $theme = $this->record($value, 'theme');
        $this->check(in_array($theme['font'] ?? null, ['tajawal', 'noto-kufi-arabic'], true), 'theme.font');
        $colors = $this->record($theme['colors'] ?? null, 'theme.colors');
        $this->check(count($colors) === count(self::COLORS), 'theme.colors');
        foreach (self::COLORS as $token) {
            $this->check(is_string($colors[$token] ?? null) && preg_match('/^#[0-9a-fA-F]{6}$/D', $colors[$token]) === 1, 'theme.colors.'.$token);
        }
    }

    private function contacts(mixed $value): void
    {
        $contacts = $this->record($value, 'contacts');
        $this->check(is_bool($contacts['ordering_enabled'] ?? null), 'contacts.ordering_enabled');
        $this->check(array_key_exists('whatsapp', $contacts) && array_key_exists('phone', $contacts), 'contacts');
        $this->phone($contacts['whatsapp'], 'contacts.whatsapp');
        $this->phone($contacts['phone'], 'contacts.phone');
        $this->check(! $contacts['ordering_enabled'] || $contacts['whatsapp'] !== null, 'contacts.whatsapp');
        $this->text($contacts['notice'] ?? null, 'contacts.notice');
    }

    private function phone(mixed $value, string $field): void
    {
        // No invented reachable numbers: null is an explicitly unconfigured demo contact.
        $this->check($value === null || (is_string($value) && preg_match('/^[1-9][0-9]{7,14}$/D', $value) === 1), $field);
    }

    private function asset(mixed $value, string $field): void
    {
        $asset = $this->record($value, $field);
        $this->text($asset['alt'] ?? null, $field.'.alt');
        $this->text($asset['plan'] ?? null, $field.'.plan');
        $this->check(array_key_exists('path', $asset) && array_key_exists('attribution', $asset), $field);
        $path = $asset['path'];
        if ($path === null) {
            $this->check($asset['attribution'] === null, $field.'.attribution');

            return;
        }

        $this->check(is_string($path) && preg_match('~^images/restaurants/[a-z0-9-]+/(?:[a-z0-9-]+/)*[a-z0-9-]+\.(?:svg|webp|avif|png|jpg|jpeg)$~D', $path) === 1, $field.'.path');
        $this->text($asset['attribution'], $field.'.attribution');
    }

    private function hours(mixed $value): void
    {
        $hours = $this->record($value, 'hours');
        $this->check(count($hours) === count(self::DAYS), 'hours');
        $intervals = [];
        foreach (self::DAYS as $dayIndex => $day) {
            foreach ($this->records($hours[$day] ?? null, 'hours.'.$day) as $shift) {
                $start = $this->minutes($shift['start'] ?? null);
                $end = $this->minutes($shift['end'] ?? null);
                $this->check($start !== $end, 'hours.equal_endpoints');
                $start += $dayIndex * self::MINUTES_PER_DAY;
                $end += $dayIndex * self::MINUTES_PER_DAY;
                if ($end < $start) {
                    $end += self::MINUTES_PER_DAY;
                }
                $intervals[] = [$start, $end];
            }
        }

        // Compare adjacent weeks too, so Sunday overnight cannot overlap Monday.
        foreach ($intervals as $index => [$start, $end]) {
            foreach ($intervals as $otherIndex => [$otherStart, $otherEnd]) {
                if ($index === $otherIndex) {
                    continue;
                }
                foreach ([-self::MINUTES_PER_WEEK, 0, self::MINUTES_PER_WEEK] as $offset) {
                    $this->check($start >= $otherEnd + $offset || $end <= $otherStart + $offset, 'hours.overlap');
                }
            }
        }
    }

    private function minutes(mixed $value): int
    {
        $this->check(is_string($value) && preg_match('/^(?:[01][0-9]|2[0-3]):[0-5][0-9]$/D', $value) === 1, 'hours.time');

        return ((int) substr($value, 0, 2) * 60) + (int) substr($value, 3, 2);
    }

    /**
     * @param list<array<string, mixed>> $records
     * @return list<string>
     */
    private function uniqueIds(array $records, string $field): array
    {
        $ids = [];
        foreach ($records as $record) {
            $id = $record['id'] ?? null;
            $this->id($id, $field.'.id');
            $this->check(! in_array($id, $ids, true), $field.'.duplicate_id');
            $ids[] = $id;
        }

        return $ids;
    }

    private function id(mixed $value, string $field): void
    {
        $this->check(is_string($value) && preg_match('/^[a-z][a-z0-9]*(?:-[a-z0-9]+)*$/D', $value) === 1, $field);
    }

    private function text(mixed $value, string $field): void
    {
        $this->check(is_string($value) && trim($value) !== '', $field);
    }

    /** @return array<string, mixed> */
    private function record(mixed $value, string $field): array
    {
        $this->check(is_array($value) && ! array_is_list($value), $field);

        return $value;
    }

    /** @return list<mixed> */
    private function list(mixed $value, string $field): array
    {
        $this->check(is_array($value) && array_is_list($value), $field);

        return $value;
    }

    /** @return list<array<string, mixed>> */
    private function records(mixed $value, string $field): array
    {
        return array_map(fn (mixed $record): array => $this->record($record, $field), $this->list($value, $field));
    }

    /** @phpstan-assert true $condition */
    private function check(bool $condition, string $field): void
    {
        if (! $condition) {
            // Report only a known field, never configuration values or contact details.
            throw new InvalidArgumentException('Invalid restaurant configuration: '.$field.'.');
        }
    }
}
