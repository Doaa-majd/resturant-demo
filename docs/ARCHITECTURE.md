# Architecture

## New-build baseline and evidence
This is a new restaurant website built on a Laravel Livewire starter kit, not a refactor of restaurant functionality. The documentation review read dependency declarations, Composer lock/installed metadata, starter routes, view/test inventories, PHPUnit configuration, CSS, and build configuration. It did not run the application or test suite.

| Area | Observed evidence | Implementation consequence |
| --- | --- | --- |
| Laravel | Requires ^13.17; lock and installed metadata show 13.42.0 | Use installed Laravel 13 without upgrade/downgrade. Laravel 12 is an allowed alternative only if that is the installed baseline. |
| Livewire | Requires ^4.1; lock and installed metadata show 4.4.8 | Use Livewire 4 conventions after local verification. |
| Tailwind | Declares ^4.0.7 and @tailwindcss/vite ^4.1.11; CSS imports Tailwind | Target Tailwind 4. No frontend lockfile or node_modules was found; resolved version/build is unverified. |
| Frontend | Vite Plus configuration; scripts use vp dev / vp build | Retain compatible tooling; do not replace it with a generic Vite setup. |
| Scaffold | Welcome, auth/settings/dashboard views and tests; Flux, Blaze, Fortify dependencies | Build a dedicated public storefront; preserve unrelated scaffolding. No dashboard aesthetic or customer login requirement. |
| Tests | PHPUnit uses in-memory SQLite and array sessions; Composer has lint/type/test scripts | Preserve conventions; add restaurant tests and separately verify real refresh persistence. |
| Runtime session | Session config exists; reviewed source did not establish the active driver | Explicitly verify/select a server session driver; do not assume database sessions. |
| Change tracking | No .git directory; git status failed | Working-tree changes are unknown. Recheck before implementation and preserve user files. |

PHP/Node compatibility, MySQL availability, runtime settings, builds, and test results remain unverified. Never print .env or credential values. Phase 0 completes environment verification for the new build; documentation edits do not authorize installation or application changes.

## Overall design
Laravel serves a Blade storefront at the public home route, with Livewire 4 cart interactions and Tailwind CSS 4 styling. Keep initial content server rendered, including menu, schedule, and status. Use small Blade components for sections/controls backed by shared profile data.

Start with one storefront Livewire component coordinating cart and status, with focused concrete collaborators for independently testable rules. Split only for clear responsibility or rendering benefits. No SPA framework, duplicate JavaScript cart store, generic repository/service framework, or tenancy package. Existing Flux primitives may support accessible controls if styled to the custom design; they do not prescribe page composition.

## Single restaurant configuration source
Proposed location: config/restaurants.php, with one active profile key and two complete fictional profiles keyed by stable slug. Read an environment-backed selection through Laravel configuration; do not store menu content in environment variables. Keep profiles serializable and configuration-cache compatible, without closures or runtime clock values.

Each profile owns:
- Stable key, Arabic name, logo/alt text, introduction, hero headline/copy/image, story copy/image, and footer copy.
- Asset paths, useful image descriptions, optional focal-point metadata, and attribution references.
- Allowlisted semantic colors, approved typography choice, and presentation tokens; no arbitrary CSS or class strings.
- SAR currency with two minor-unit digits, IANA timezone, and explicit weekly hours for all seven weekdays.
- Ordered categories/items with unique stable IDs, names, descriptions, photos/alt text, integer price_minor, and boolean availability.
- Bestseller and family-offer item references. Bundle contents/serving guidance live on their menu items; section data never duplicates prices.
- Informational branches, addresses, phone/map links, and one ordering WhatsApp recipient in international digits-only form.

Shared Arabic interface labels live in translation resources; restaurant-specific copy lives in profiles. Asset files referenced by profiles do not create a second content authority. MySQL is reserved for future persistence requirements: no restaurant tables, ORM models, or database catalog are required now.

Validate missing/duplicate IDs, invalid references, unsupported currency precision, non-integer/negative prices, availability types, timezones, schedules, recipient, safe links/assets, and theme values. Require content for every planned section in both demos. Missing optional imagery gets a designed fallback; invalid core configuration fails with a safe diagnostic rather than mixing profiles.

Switch via one active configuration key and refresh cached configuration using verified tooling. One deployment selects one restaurant; no public tenant URL/switcher is needed. Resolve the profile server-side, never from a trusted browser-submitted profile object. Scope sessions by stable restaurant key.

### Phase 1 configuration contract
`config/restaurants.php` now owns the two profiles. `RestaurantProfileResolver` receives Laravel's configuration repository and `RestaurantProfileValidator` through constructor injection; `resolve()` validates and returns only the selected profile, with no fallback or merge. The resolver is container-autowired and reads selection on each call. Invalid configuration throws a field-only `InvalidArgumentException`, without echoing contact values.

Categories, items, branches, and section item references are ordered lists. IDs are unique within each list; items refer to category IDs and bestseller/offer sections refer to item IDs. Bundle contents and serving text live only on the ordinary fixed-price item. Empty catalogs/categories and empty reference lists are valid browsing states; the supplied demos include all sections. Hours use English weekday keys and lists of `{start, end}` local times. Validation rejects overlaps, including across Sunday/Monday, but accepts adjoining intervals and entirely closed weeks. Runtime hours evaluation remains Phase 3.

Assets use `{path, alt, plan, attribution}`. A null path explicitly means an asset has not been acquired; the plan and Arabic description remain required. A populated path must be under `images/restaurants/{slug}/` with a supported image extension and a nonempty attribution reference. This validates configuration syntax, not file existence or legal rights. Before rendering actual assets, acquire and verify files, dimensions, licenses and responsive variants; implement the designed fallback in the UI phases. Theme configuration allows only the documented eleven six-digit hex colors and the approved font tokens. Contrast/font availability still require visual verification.

Per the user's Phase 1 clarification, contact numbers are environment-backed per restaurant, never literals in the profile. Use `DAR_AL_SUFRA_WHATSAPP_NUMBER` / `SAJ_WA_ZAYTOUN_WHATSAPP_NUMBER` in the local ignored `.env`, with international digits only (8–15 digits, nonzero first digit). Corresponding `_PHONE_NUMBER` variables supply informational contact/branch phones. Set absent numbers to `null` as shown in `.env.example`; do not insert arbitrary reachable numbers. Syntax validation does not prove ownership or WhatsApp registration.

Both demos default to `contacts.ordering_enabled = false`, controlled by `DAR_AL_SUFRA_ORDERING_ENABLED` / `SAJ_WA_ZAYTOUN_ORDERING_ENABLED`. Explicitly unconfigured contacts are valid for browsing; enabling ordering requires a valid recipient. Phase 6 must use the selected profile's `contacts.whatsapp` and require `ordering_enabled` in addition to cart/hours/review eligibility. This is an explicit safe-demo exception to the initial mandatory-recipient plan, not a functioning checkout in Phase 1. Phone links must be omitted when their configured value is null. Map links currently identify the demonstration city, not a fictional business location.

Set `RESTAURANT_PROFILE=dar-al-sufra` or `RESTAURANT_PROFILE=saj-wa-zaytoun` in local `.env` to switch. After changes, use `php artisan config:clear` for uncached local development or `php artisan config:cache` to rebuild a cache once compatible PHP is available. These Artisan commands are currently blocked by the runtime; profile export/reload alone is not proof of Laravel cache bootstrap. Do not commit `.env` or generated config caches containing contact values.

## Responsibilities and data flow
| Responsibility | Boundary |
| --- | --- |
| Profile resolver/validator | Select/validate one profile; expose menu lookup and section references. |
| Opening-hours evaluator | Accept schedule, timezone, and controllable instant; return status, closing time when open, next opening when closed, and eligibility. |
| Cart calculator/reconciler | Validate quantities, resolve current items, calculate integer totals, and describe changes. |
| WhatsApp builder | Format reviewed server cart into Arabic and construct the encoded HTTPS link. |
| Livewire storefront | Coordinate actions, session updates, feedback, polling, and review state; delegate rules. |
| Blade components | Render all sections and cart accessibly, following DESIGN_SYSTEM.md. |

An action resolves the active profile, validates input, delegates calculation, updates session IDs/quantities, and renders derived output. Templates never calculate money or interpret business hours.

## Cart and trust boundary
Store only item IDs and integer quantities as cart lines in a server session namespace containing the restaurant key. Prefer file sessions for the demo unless verified constraints require another server driver; confirm permissions and lifetime. The browser carries a session cookie, not authoritative prices. SQLite/array settings in PHPUnit do not prove real refresh persistence.

Validate existence, availability, and quantities 1–99 on every mutation and hydration. Decrement stops at one; removal is explicit. Total in halalas is the sum of price_minor multiplied by quantity. Format SAR at presentation boundaries without float arithmetic. No fees, extra tax calculations, or discount arithmetic.

Compare restored/reviewed state with current server results to detect changed prices, removed items, and sold-out items. Keep separate server-side review metadata (a snapshot or fingerprint) as a comparison baseline, never as price authority. Remove invalid lines, update prices, show Arabic changes, and invalidate handoff review whenever the cart/profile changes. Require a subsequent deliberate review/action after reconciliation; never open WhatsApp in the same action that changes the order. Recheck on the subsequent action because configuration may change between requests.

Keep valid lines when another line is rejected and retain the cart after handoff. Use Laravel/Livewire request protection and escaped Blade content. Treat serialized client IDs, quantities, totals, availability, and session data as untrusted.

## Weekly hours and next opening
- Use the configured IANA timezone and controllable clock/instant, independent of visitor or server default timezones.
- Represent every weekday as zero or more local HH:mm start/end intervals; an empty list means closed. Equal start/end is invalid, not a 24-hour interval.
- Start is inclusive, end exclusive. An earlier end crosses into the next local date. Check previous-day intervals for overnight carryover.
- Reject overlaps including overnight spillover. Allow adjoining intervals and merge them for continuous status without false closure at the boundary.
- Materialize dated intervals from the previous day through at least the next seven days. When closed, choose the first future start, including next week's same weekday. An entirely closed week returns no next opening.
- Format next opening with local weekday/date/time and a timezone label. A local closing time can support open status. Holiday exceptions remain deferred.
- Both demos use Asia/Riyadh. For reusable timezone support, explicitly resolve DST: advance nonexistent wall times to the next valid instant, use the earlier occurrence for an ambiguous start and later occurrence for an ambiguous end. Test these conversions instead of relying on implicit library normalization.

Refresh visible status with a modest Livewire poll (target 60 seconds, paused when hidden), using one evaluator everywhere. Display may lag until the next refresh; synchronously re-evaluate every handoff attempt. No client clock authorizes ordering. Closed status keeps browsing/cart editing available and disables handoff with next-opening feedback.

## WhatsApp handoff
Validate the profile recipient and recheck hours, cart contents, and reviewed totals server-side immediately before producing a link. Empty carts, closed restaurants, or newly reconciled carts cannot hand off.

Create an HTTPS wa.me link with a properly URL-encoded text query. The Arabic message contains restaurant name, each item/quantity, unit price, line total, SAR total, and “يرجى تأكيد الطلب والتوفر”. UI states “طلبك مُجهّز، وغير مؤكد حتى يؤكده المطعم”. Opening WhatsApp is a deliberate user action: no automatic API, stored order, order number, or confirmation claim.

For popup blocking/navigation failure, retain an explicit usable link and copyable summary. Establish/document a conservative encoded-URL size limit using target mobile/browser checks before release; over-limit messages offer copying with an explanation. Clipboard failure leaves selectable text. Avoid logging full messages or personal details.

## UI, accessibility, and performance
Meet section criteria during each UI phase. Use logical CSS, Arabic lang/RTL, bidirectional isolation, semantic headings/landmarks, visible focus, live feedback, and accessible mobile dialogs. JavaScript may manage focus/scroll but must not duplicate cart/hours rules.

Map validated colors to CSS custom properties/Tailwind 4 semantic tokens; do not build arbitrary class names from configuration. Restrict links/assets to safe supported locations/schemes. Give photos responsive sizes, explicit dimensions/aspect ratios, meaningful alt text, and lazy loading below the fold; hero loading is eager. Limit Arabic-capable font weights and respect reduced motion. Record photo rights; avoid fabricated testimonials/awards.

## Verification strategy
- Unit: profile invariants/references, integer money, reconciliation, exact hours boundaries, overnight/split/closed weeks, next openings, timezone/DST, and Arabic encoding.
- Feature/Livewire: configured content/order, all cart actions and invalid input, server-price tampering resistance, per-restaurant session isolation, review invalidation, closed/empty rejection, and handoff wording.
- Manual/browser: actual refresh persistence, RTL/mixed text, keyboard/dialog focus, polling across boundaries, both profiles, target widths, motion, image fallbacks, and WhatsApp/copy behavior.
- Verify available commands in Phase 0: php artisan test, composer lint:check, composer types:check, and npm run build when frontend dependencies exist. composer test also clears configuration before its aggregated checks; inspect effects before use. Do not run composer setup as a check: it installs dependencies and runs migrations.

No test, build, or runtime pass is claimed here. Preserve starter SQLite test isolation; add MySQL integration tests only when an explicit database feature needs them.
