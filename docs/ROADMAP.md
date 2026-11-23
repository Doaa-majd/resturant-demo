# Roadmap

## Delivery rules
This is a NEW restaurant website built from scratch on the supplied Laravel starter kit. Existing framework scaffolding is a starting toolset, not an existing restaurant product to refactor or migrate. Do not create a legacy-feature inventory, migration plan, or speculative compatibility layer.

Deliver sequential, small, reviewable phases. Each phase includes focused checks and an exit gate; satisfy that gate before expanding scope. Every UI phase must meet its DESIGN_SYSTEM.md section criteria, with real Arabic copy and representative photography. Design is a priority throughout, not work postponed to the last phase.

Current authorization covers Phase 1 implementation, tests, and documentation, followed by a stop for review. Phase 0's readiness record below remains historical. Phase 1 implementation is delivered with verification blockers recorded below; Phases 2–7 require a subsequent request. Package installation, dependency changes, migrations, deployment, and commits are not authorized; do not run composer setup as a shortcut.

## Phase 0 — New-build readiness and foundation plan
**Purpose:** prepare to build the restaurant site from a framework starter, confirming the available tools and a concrete implementation path.

- Read all project instructions and the four product/design/architecture documents. Recheck local files and any user changes before editing.
- Verify installed Laravel (12 or 13, currently metadata shows 13.42.0), Livewire 4 (currently 4.4.8), declared/resolved Tailwind 4, PHP/Node tooling, lockfiles, and available test/build commands. Do not upgrade or install to complete this phase.
- Inspect only the scaffold needed for the new build: public route, Blade/Livewire conventions, CSS/font entrypoints, Vite Plus setup, session driver, test setup, and safe runtime prerequisites. Auth/dashboard scaffold is not a restaurant requirement and need not be redesigned or deleted.
- Confirm MySQL as the future database target; no catalog schema or migrations are needed for this demo. Plan file-backed anonymous sessions unless verified constraints require another server driver. Keep existing isolated test database settings.
- Record what is observed versus unverified. Current review found no frontend lockfile/node_modules and no .git directory; recheck and report limitations without inventing a clean working tree.
- Establish a new-build file/component plan, two fictional restaurant content/asset inventories, typography/photography sourcing, and desktop/mobile composition targets. Confirm one selected profile, informational branches, fixed-price family bundles, closed-state policy, and SAR integer amounts from the docs.
- Attempt relevant existing baseline checks only when tooling is available and their effects are understood. Record unavailable checks; no installation, migration, secret disclosure, or code cleanup to force a baseline pass.

**Checks:** documented dependency/runtime evidence, available command inventory, safe scaffold inspection, and consistency review against PRD/DESIGN_SYSTEM/ARCHITECTURE. Identify any installation prerequisite for later explicit authorization.

**Exit:** a verified or explicitly limited new-build readiness record and a small first implementation scope. This is preparation for creating new restaurant functionality, not a refactor phase. No application changes are required for Phase 0.

### Phase 0 completion record — 2026-11-23

**Status: complete with environment limitations; stopped for review before Phase 1.** This satisfies the explicitly limited readiness exit, not a passing application baseline. Delivered documentation and a concrete build plan only. No restaurant functionality or visual implementation was delivered.

#### Completed tasks
- [x] Read AGENTS.md and all four files in docs; reviewed the local scaffold and existing changes before editing.
- [x] Rechecked dependency declarations, installed metadata, tools, lockfiles, and command effects without installation or upgrades.
- [x] Inspected the home route, Blade/Livewire conventions, CSS/font entrypoints, Vite Plus, session configuration, PHPUnit isolation, and runtime prerequisites.
- [x] Confirmed future MySQL target and planned file sessions; preserved existing database and test settings.
- [x] Distinguished observed evidence from runtime assumptions and recorded change-tracking limitations.
- [x] Established the component plan, two fictional content/asset inventories, sourcing workflow, and responsive composition targets below.
- [x] Attempted the relevant existing checks and recorded all failures without cleanup to force a pass.

#### Environment and scaffold evidence
| Area | Observed on this run | Consequence |
| --- | --- | --- |
| Change tracking | `.git` now exists. Initial `git status --short` reported existing modifications to `composer.json` and `composer.lock`; `git diff --numstat` showed 1 added line and 282 added/1 removed lines respectively. | Preserve both files; no clean-tree claim. Git warned that the user's global ignore file was unreadable, so global-ignore behavior is limited. Project `.gitignore` ignores AGENTS.md and local agent/tool configuration. |
| PHP | `php` is absent from this shell's PATH. `C:\xampp\php\php.exe --version` reports 8.1.6. | Installed `vendor/composer/platform_check.php` requires PHP >=8.4.1. Application bootstrap is blocked; the root declaration `^8.3` alone does not establish compatibility. No platform bypass or dependency downgrade. |
| Composer | Explicit invocation with XAMPP PHP reports Composer 2.10.0. Its `C:\composer\composer.bat` wrapper calls `php` from PATH. | Check commands used a process-local PATH prefix for XAMPP PHP only; no persistent environment change. |
| PHP dependencies | Lock and installed metadata agree: Laravel 13.42.0, Livewire 4.4.8, PHPUnit 12.5.44, Boost 2.10.4, Pint 1.32.3, Larastan 3.15.0. | Retain installed versions. These are metadata confirmations, not successful runtime checks. |
| Node/npm | `node --version`: v24.11.1; `npm.cmd --version`: 11.6.2. | Node satisfies the inspected installed Vite Plus/Vite/plugin engine ranges. Full build compatibility remains unverified. |
| Frontend | `node_modules` now exists. Installed package metadata: Tailwind and its Vite plugin 4.3.5; Vite Plus 1.4.0; aliased Vite core 1.4.0; Laravel Vite plugin 3.2.1. | Root declarations still target Tailwind 4. No root npm/pnpm/yarn/bun lockfile or hidden npm lockfile was found. Installed metadata is not a reproducible dependency resolution. |
| Frontend launcher | Vite Plus declares `vp` at `bin/vp`, and that file exists; `node_modules/.bin/vp.cmd` is absent. | `npm.cmd run build` cannot launch `vp`. Existing node_modules is insufficient for the declared build command; do not install or relink incidentally. |
| Public route | `routes/web.php` uses `Route::view('/', 'welcome')->name('home')`. | Replace only the public home presentation in a later UI phase. Preserve unrelated dashboard/settings/auth routes. |
| Component convention | Existing settings components are class-based under `app/Livewire/Settings`, paired with `resources/views/livewire/settings`; routes use `Route::livewire`. No project `config/livewire.php` exists. | Use the established class-based convention for the storefront, despite vendor generator defaults of SFC with emoji. No component generation in Phase 0. |
| Assets | `vite.config.js` retains Vite Plus, Laravel plugin, Tailwind plugin, CSS/app JS/passkeys inputs, and Bunny Instrument Sans weights 400/500/600. CSS imports Tailwind and Flux; app JS is empty. | Add a dedicated storefront style/layout later; retain starter styling and passkeys entrypoint. Instrument Sans is not the planned Arabic font. No production build output exists. |
| Sessions/runtime | Allowlisted inspection of local settings indicates database sessions, 120-minute lifetime, and SQLite connection; no corresponding process overrides or cached config file were found. Application key presence was checked without printing its value. | These are configuration observations, not booted runtime confirmation. Plan file-backed anonymous sessions before storefront persistence work; leave local settings unchanged now. |
| Filesystem | PHP `is_dir`/`is_writable` reports yes for sessions, views, framework cache, logs, and bootstrap cache directories. | Supports a file-session plan under this CLI identity; no write probe, web-server identity check, or browser persistence verification was performed. |
| Tests | PHPUnit declares SQLite `:memory:`, array sessions/cache/mail, sync queue, and testing environment. Existing home feature test uses RefreshDatabase; tests are PHPUnit classes. No `.env.testing` or cached config was present. | Preserve isolated test settings and existing tests. The PHP guard stopped the attempted test before bootstrap or test migrations. |
| Database | XAMPP CLI exposes PDO MySQL and PDO SQLite. | MySQL remains the future persistence target. No server connection/version/schema check was needed or attempted; no restaurant tables or migrations. |
| Boost | Local skills and installed Boost package are present, but no Boost `search-docs` tool is exposed in this session. | Read installed Livewire configuration and Laravel SessionManager source for the relevant conventions. Runtime Boost availability is unverified because PHP bootstrap fails. |

Applied skills: `.agents/skills/laravel-best-practices/SKILL.md` (configuration, architecture, routing, Blade rules), `.agents/skills/livewire-development/SKILL.md`, and `.agents/skills/testing-best-practices/SKILL.md` (isolation rule). No UI or authentication implementation was undertaken.

#### Commands and results
Commands ran from the project root. For PHP/Composer checks only, PowerShell used `$env:PATH = 'C:\xampp\php;' + $env:PATH` within that child process.

| Command/check | Result |
| --- | --- |
| `git status --short`; `git diff --stat`; `git diff --numstat` | Existing Composer changes identified and preserved; global-ignore permission warning as above. |
| `C:\xampp\php\php.exe --version`; `C:\xampp\php\php.exe -m` | PHP 8.1.6; includes PDO MySQL/SQLite, mbstring, fileinfo, OpenSSL, DOM/XML and curl. This does not prove all requirements of a future compatible PHP runtime. |
| `C:\xampp\php\php.exe C:\composer\composer.phar --version` | Composer 2.10.0 runs under PHP 8.1.6. |
| `node --version`; `npm.cmd --version` | v24.11.1 and 11.6.2. |
| `php artisan test --filter=ExampleTest` | Blocked before any tests execute: installed dependencies require PHP >=8.4.1; found 8.1.6. No tests passed. |
| `composer lint:check` | Failed: Pint's Box checker requires PHP ^8.3.0; script returned 1. No formatting changes made. |
| `composer types:check` | Failed at Composer's PHP >=8.4.1 platform guard; PHPStan script returned 255. No analysis result. |
| `npm.cmd run build` | Failed, exit 1: `vp` is not recognized. No successful production assets generated. |
| `git diff --check` | Passed before documentation edits; repeated after editing as the final whitespace check. |

An initial inline PHP filesystem probe hit Windows quoting errors; rerunning the same read-only probe via PHP standard input produced the directory evidence above. No check was repaired by changing application code. The full suite, browser rendering, config-cache verification, actual sessions, and MySQL connectivity were not run. `composer test` was intentionally not used because it clears config and aggregates already-blocked checks; `composer setup`, install/update commands, migrations, and deployment were not run.

#### New-build file and component plan
These are proposed paths, not created files. Add each only in its roadmap phase.

| Phase | Planned files/responsibility |
| --- | --- |
| 1 | `config/restaurants.php`: one active key and two serializable profiles. `app/Restaurants/RestaurantProfileResolver.php` and `RestaurantProfileValidator.php`: focused selection and validation with explicit dependencies. `tests/Feature/Restaurants/RestaurantProfileTest.php`: configured selection/validation behavior; pure invariant tests only where useful. |
| 2 | `resources/views/layouts/restaurant.blade.php`; `app/Livewire/RestaurantStorefront.php` with `resources/views/livewire/restaurant-storefront.blade.php`; home route wired to the dedicated storefront. `resources/views/components/restaurant/` for header, hero, footer and reused controls. `lang/ar/restaurant.php` for shared labels; `resources/css/restaurant.css` for scoped semantic tokens and Arabic typography, wired through existing Vite Plus. |
| 3 | `app/Restaurants/OpeningHoursEvaluator.php`, receiving explicit schedule/timezone/instant; status, weekly schedule and contact Blade components; deterministic hours tests. |
| 4 | Restaurant Blade components for bestsellers, category navigation, menu item, family offers and story; profile-selected local assets under `public/images/restaurants/{profile}/`. |
| 5 | `app/Restaurants/CartCalculator.php` and `CartReconciler.php`; server session IDs/quantities and separate review metadata coordinated by the storefront; desktop cart/mobile dialog components and feature tests. |
| 6 | `app/Restaurants/WhatsAppMessageBuilder.php`; explicit reviewed handoff and copy fallback; encoding/eligibility tests. |
| Throughout | Shared integer SAR formatter only when first consumed; no float money calculations. Focused concrete classes, no speculative repository/contracts/tenancy layers. Record asset provenance in these existing docs as assets are acquired. |

The next implementation request should be limited to Phase 1: profiles, resolver, validator and focused tests, plus config-cache verification once compatible PHP is available. No home-page redesign, cart, hours runtime, or WhatsApp implementation belongs in that first scope.

#### Two fictional profile content and asset inventories
Proposed demo content only; these are not claims about operating businesses. Phase 1 will encode complete copy, ordered items and seven-day schedules in the authoritative profile. Both use SAR integer halalas, `Asia/Riyadh`, one schedule and recipient per profile, informational branches, and the shared default Warm Modern palette. Select one stable key via configuration, with no public switcher.

| Content | `dar-al-sufra` — دار السفرة | `saj-wa-zaytoun` — صاج وزيتون |
| --- | --- | --- |
| Hero | “سفرة دافئة، ونكهة تجمعنا” / “أطباق سعودية بروح البيت، من أول لقمة إلى آخر جلسة.” | “من الصاج إلى سفرتك” / “خبز دافئ ومشاوي ومقبلات، لوجبة تحب مشاركتها.” |
| Ordered categories/items | أطباق السفرة: كبسة دجاج (`chicken-kabsa`, 3200), جريش (`jareesh`, 2400). المقبلات: سلطة خضراء (`green-salad`, 1200). المشروبات: لبن (`laban`, 600). سفرة العائلة: لمة الدار (`family-table`, 11900). | من الصاج: مسخن دجاج (`chicken-musakhan`, 2800). المشاوي: شيش طاووق (`shish-tawook`, 3600). المقبلات: حمص (`hummus`, 1400). المشروبات: ليمون بالنعناع (`mint-lemon`, 1200). سفرة العائلة: لمة الصاج (`family-saj`, 12900). |
| Bestsellers | References to chicken-kabsa and jareesh. | References to chicken-musakhan and shish-tawook. |
| Fixed-price family bundle | family-table: chicken kabsa platter, green salad and four laban drinks; serves four. One item at 11900, no discount arithmetic. | family-saj: tawook platter, musakhan rolls, hummus and bread; serves four. One item at 12900, no choices or promotion engine. |
| Story copy seed | “في دار السفرة، تبدأ الحكاية من مائدة تجمع الأحبة. اخترنا أطباقًا مألوفة وتفاصيل دافئة لتكون الوجبة مساحة للّمة.” | “نحب رائحة الخبز الدافئ وبساطة المائدة المشتركة. صاج وزيتون يجمع أطباقًا قريبة من القلب، لتختار منها سفرتك.” |
| Schedule plan | Sat–Thu 12:00–23:00; Fri 13:00–01:00 next day. | Sat–Wed 11:00–15:00 and 18:00–23:00; Thu 11:00–01:00 next day; Fri closed. |
| Branch/contact inventory | One clearly fictional Riyadh branch, neighborhood-level demonstration address. Contact/recipient and safe map destination must be supplied as controlled demo values during implementation. | One clearly fictional Jeddah branch, neighborhood-level demonstration address. Same controlled-contact requirement. |
| Asset inventory per profile | Original Arabic wordmark; kabsa hero scene; five item photos (bundle image reused by offers); warm shared-table story scene; branded missing-photo treatment. | Original Arabic wordmark; saj/grill hero scene; five item photos (bundle reused by offers); bread/olive-table story scene; branded missing-photo treatment. |
| Alt-text direction | “كبسة دجاج في طبق تقديم على سفرة دافئة”; describe each dish and story scene without promotional claims. | “خبز صاج ومشاوي ومقبلات على مائدة مشتركة”; describe each dish and story scene without promotional claims. |

All item descriptions, section introductions, footer copy, branch labels, logo alt text, and asset attribution references must be complete in Phase 1 profiles. Use available items by default; test sold-out/empty/long-name states through isolated fixtures. Do not invent a real WhatsApp recipient or publish arbitrary phone numbers as usable contacts; controlled test contacts remain an outstanding content dependency for complete profile validation and later live handoff.

#### Typography, photography and composition plan
- Typography candidate from DESIGN_SYSTEM.md: Tajawal as a single Arabic family at 400/500/700, with Arabic system fallbacks. Verify the actual font distribution/license and Arabic shaping before acquisition; record source, license and required notices, then self-host suitable WOFF2 assets. Noto Kufi Arabic remains an optional display alternative only if the visual review justifies its payload. No font asset or license was acquired/verified in Phase 0.
- Photography sourcing: obtain owner-supplied rights-cleared images or individually licensed stock fitting the shot inventory above. For each selected image record its source URL/creator, exact license evidence/date, attribution requirements, crop/derivative permission, final local path and alt text. Do not use remote placeholders or assume search results grant rights. No stock purchase, external generation, or download was performed; final assets and rights remain pending.
- Hero assets need warm directional light, ceramic/linen/wood texture and a 4:3 or 5:4 composition with a mobile-safe food focal point. Prepare responsive derivatives and explicit dimensions; load hero eagerly and lower sections lazily. Menu crops are 4:3; story and family bands vary the page rhythm.
- At >=1024px: approximately 45% Arabic text on the right, 55% food scene on the left, within about 1240px. At 360/390/768px: text then image, visible menu CTA, no fixed viewport-height hero. Use the design-system type scale, logical spacing and 20/32/48px gutters.
- Bestsellers use generous curated photography; menu uses contained sticky categories and readable one/two-column cards; family bundles use a warm editorial band; story alternates the split rhythm; contact pairs branch details with a readable weekly schedule. Avoid repeating one utility-card layout across all sections.
- Review both profiles at 360/390/768/1024/1440px, 200% zoom/reflow, long Arabic copy, keyboard/focus, image failure, reduced motion and closed/sold-out/loading/error states. Desktop cart panel and mobile sheet/bar come in Phase 5, with safe-area clearance and focus restoration.

**Design acceptance:** planning is consistent with DESIGN_SYSTEM.md; no rendered design, contrast audit, licensed photography, font shaping, RTL interaction, or WhatsApp journey is claimed as accepted. Those remain phase-specific implementation gates.

#### Outstanding issues and review boundary
1. A compatible PHP runtime (at least 8.4.1 for the current installed dependency graph) and correct CLI/web-server selection are prerequisites for meaningful tests/runtime checks. No runtime was installed or reconfigured. After provision, recheck extensions/platform requirements, then repeat tests, lint and static analysis.
2. Frontend installation/launcher integrity and the missing lockfile need an explicitly authorized dependency setup task. Preserve existing versions/tooling; verify the Windows launcher and rerun the build. No installation is authorized by this readiness report.
3. Database sessions are still configured locally. Select file sessions in a later authorized implementation step and verify the actual server identity, lifetime and browser refresh persistence. MySQL remains deferred; no database availability claim.
4. Final photos/font rights, complete profile copy and controlled contact values remain implementation dependencies. No arbitrary real recipient should receive demo orders.
5. Existing Composer edits are user-owned and unchanged. Git's global-ignore warning limits that part of tracking; project diff remains inspectable.
6. Config-cache compatibility, successful application bootstrap, full automated checks and all visual/browser acceptance remain unverified. Reconcile these limitations before claiming the respective implementation phases complete.

Confirmed product boundaries: one selected profile; integer SAR prices; informational branches; fixed-price bundles; closed restaurants remain browsable with cart editing but no handoff; server-side reconciliation and deliberate review; WhatsApp prepares a message without sending/confirming an order and retains the cart. No architecture scope expansion is proposed. Stop here for user review; do not begin Phase 1 or commit.

## Phase 1 — Restaurant profiles and validation
**Deliver:** one configuration source with a single active key and two complete fictional profiles. Include branding, section copy/assets, semantic colors, SAR, timezone, weekly hours, ordered menu, bestseller/offer references, story, branches, contacts, and recipient. Implement focused resolver/validation logic, with no database catalog.

**Checks:** valid/invalid profiles; missing/duplicate IDs; integer prices and SAR precision; invalid timezone/hours/recipient/theme; broken section references; selection of either profile with no content leakage. Verify configuration can be cached using available tooling.

**Exit:** changing one configured key selects a fully valid restaurant without changing shared logic. Both profiles have content/asset plans for every required section. No public switcher or tenancy system.

### Phase 1 implementation record — 2026-11-23

**Status: implementation delivered for review; runtime verification gate remains blocked. Phase 2 has not started.**

#### Delivered behavior
- Added `config/restaurants.php` with a single environment-backed selection and two fictional Arabic profiles: دار السفرة and صاج وزيتون. Both include all section copy, logo/hero/story/item asset plans and alt text, Warm Modern tokens, SAR/two-digit precision, timezone, seven-day schedules, ordered categories/items, bestsellers, fixed-price bundle references, fictional branch details, city map links and footer wording.
- Added focused resolver and validator in `app/Restaurants/`. Selection returns one validated profile without merging or falling back. Validation covers missing/duplicate IDs, category/section references, integer nonnegative prices, strict availability, currency precision, IANA timezone, weekly hours and overnight/week-boundary overlaps, contacts, safe asset/map locations and theme values. Diagnostics contain field names rather than supplied values.
- Added `tests/Feature/Restaurants/RestaurantProfileTest.php`: selection/no leakage, invalid selection and identity mismatch, 51 invalid-profile cases, closed/empty/sold-out/zero-price states, adjoining overnight schedules, separate recipients, and export/reload compatibility. Tests sanitize contact configuration and do not use a database or send external requests.
- Added only unconfigured contact examples to `.env.example`. The user's clarification requires per-restaurant WhatsApp numbers from local `.env`. No personal number was requested, read, written, or committed. `.env` is ignored and untracked. Optional phone variables and explicit ordering flags are documented in ARCHITECTURE.md. Checkout wiring remains Phase 6.
- Preserved pre-existing Composer and Phase 0 roadmap edits. No routes, views, authentication, dependencies, sessions, migrations or deployment were changed.

#### Design acceptance
Arabic copy and section inventories are present for both brands; profiles contain the approved cream/terracotta palette and Tajawal font token. Asset slots deliberately have null paths and concrete acquisition/crop plans, rather than broken paths or unlicensed remote images. No photography/font files were acquired. Rendered RTL, responsive layout, contrast, font shaping, keyboard and WhatsApp acceptance are not claimed; these remain the relevant UI-phase gates.

#### Checks performed
Commands ran from the project root. PHP/Composer child processes used `$env:PATH = 'C:\xampp\php;' + $env:PATH`; no persistent runtime configuration changed.

| Command/check | Result |
| --- | --- |
| `C:\xampp\php\php.exe --version` | PHP 8.1.6 remains the available CLI; installed dependencies require >=8.4.1. |
| `php artisan test --filter=RestaurantProfileTest` | Blocked before PHPUnit executes by Composer's PHP platform guard. No PHPUnit tests passed. |
| `composer lint:check` | Failed, exit 1: Pint requires PHP ^8.3.0. No formatting result. |
| `composer types:check` | Failed: PHP >=8.4.1 platform guard; underlying script returned 255. No static-analysis result. |
| `npm.cmd run build` | Failed, exit 1: `vp` not recognized, despite a present node_modules directory. No assets built. |
| `php artisan config:cache` with child-process `APP_CONFIG_CACHE=bootstrap/cache/phase1-verification.php` | Blocked at the PHP platform guard before cache writes. Isolated cache file was not created; existing runtime cache was untouched. |
| `Get-ChildItem app/Restaurants/*.php,config/restaurants.php,tests/Feature/Restaurants/*.php \| ForEach-Object { & C:\xampp\php\php.exe -l $_.FullName }` | All four new PHP files passed syntax checks. |
| Inline PHP smoke script through PowerShell here-string piped to `C:\xampp\php\php.exe` | Passed both default profiles; all 51 invalid cases from the test provider failed with expected safe diagnostics; valid adjoining/week-boundary shifts, configured fictional test recipient, zero price/sold-out, closed/empty catalog and configuration export round trip passed. Loaded the pure validator directly and supplied default-only `env()`; did not bootstrap Laravel, bypass its platform guard, or load local `.env`. This supplements, and does not replace, PHPUnit/cache verification. |
| `git check-ignore .env`; `git ls-files .env` | `.env` ignored and not tracked. Existing global Git ignore permission warning persists. |
| `git diff --check` | Passed; Git also reports a CRLF-to-LF normalization notice for the previously edited roadmap. |

Used Laravel best-practices (configuration, style, architecture, error handling and security) and testing-best-practices (naming, assertions, data, isolation, security and review) skills. No Boost search-docs tool was exposed; inspected installed configuration repository/cache-command code and consulted the [PHPUnit 12.5 test documentation](https://docs.phpunit.de/en/12.5/writing-tests-for-phpunit.html).

#### Remaining limitations and review boundary
1. Provide a compatible PHP CLI/web runtime and repeat the focused PHPUnit test, formatting, static analysis and actual config-cache checks before accepting the runtime gate. The full starter suite was not run after the focused test failed to bootstrap.
2. Frontend launcher/dependency setup remains a separate authorized task; Phase 1 introduced no frontend changes.
3. Recipients/phones remain unset until supplied privately via each restaurant's `.env` variables. Ordering is disabled by default, and validation rejects enabling it without a valid recipient. This safe browsing state is documented as an explicit refinement of the original mandatory-recipient requirement. A real recipient and usable phone links are not claimed.
4. Asset rights, original logos, typography files, actual photography, fallback rendering and all browser/visual reviews remain pending. City map destinations are illustrative, not real restaurant branches.
5. Phase 1 provides configuration and validation only. Storefront rendering, local-time status evaluation, cart and WhatsApp handoff remain in their planned phases. Stop for user review; do not start Phase 2 or commit.

## Phase 2 — Warm Modern shell and split hero
**Deliver:** dedicated public Arabic RTL layout, semantic tokens, Arabic typography, accessible header/mobile navigation, desktop text-right/image-left hero, menu anchor CTA, responsive hero image treatment, and footer foundation. Wire configured identity/copy/assets. Do not display invented live status before Phase 3; a schedule link is an acceptable temporary state.

**Checks:** rendering for both profiles; Arabic lang/RTL and heading hierarchy; working navigation; keyboard/focus/mobile menu; image fallback; long copy; desktop split and mobile stacked composition at 360, 390, 768, 1024, and 1440px. Inspect actual photography, type, spacing, and contrast.

**Exit:** a visually convincing brand/hero foundation meeting section criteria. Record mobile/desktop visual review and asset rights. A generic starter layout does not pass.

## Phase 3 — Restaurant-local hours and next opening
**Deliver:** testable weekly-hours evaluator, full schedule display, status in header/hero/contact, next local opening weekday/date/time, and refresh while visible. Add contact/branch presentation so schedule and timezone are easy to find. The evaluator will later govern WhatsApp eligibility.

**Checks:** inclusive start/exclusive end; split shifts; previous-day overnight carryover; midnight/week rollover; adjoining and invalid overlapping intervals; entirely closed week; next week's same-day opening; restaurant versus device/server timezone; DST policy. Freeze the clock for deterministic tests and manually observe status refresh across a boundary.

**Exit:** all status displays agree, closed states give next opening or a clear unavailable-schedule message, and the full weekly schedule/timezone is readable. Browsing remains available when closed.

## Phase 4 — Browsable menu and editorial sections
**Deliver:** sticky category navigation, configured menu cards, bestsellers, family offers, restaurant story, and completed branches/contact/footer. Implement sold-out, empty-menu/category, missing-image, and long-copy states. Family offers remain ordinary fixed-price bundle items. Cart integration follows in Phase 5; do not show a falsely working add action during this interim phase.

**Checks:** category/item order, shared item references and SAR prices, availability labels, no duplicated offer prices, both profiles, keyboard category navigation, anchor/sticky offsets, photo crops/loading, and mobile/desktop section composition. Review the complete page rhythm against DESIGN_SYSTEM.md.

**Exit:** complete premium browsable page with all planned sections and no hardcoded restaurant content in shared components. Record interim cart limitation explicitly until Phase 5.

## Phase 5 — Server-calculated session cart and mobile UX
**Deliver:** add/update/remove/clear actions shared across menu/bestsellers/offers, quantities 1–99, integer totals, per-restaurant session persistence, stale-cart reconciliation and review state. Build desktop cart panel, mobile sticky bar/dialog, and accessible empty/loading/error/changed states. Keep WhatsApp disabled with honest interim feedback until Phase 6.

**Checks:** exact multi-item totals; quantity boundaries/types; invalid IDs; sold-out and tampered input; explicit removal; repeated/pending actions; price/availability changes; preserving valid lines; session isolation; hydration and actual browser refresh persistence. Test focus containment/return, Escape, announcements, scrolling, safe-area clearance, and both profiles.

**Exit:** reliable cart across refreshes with current server prices, no float arithmetic, and no client-trusted totals. Changes invalidate review and are explained. Mobile controls and full page remain usable when the cart is open/closed.

## Phase 6 — Prepared Arabic WhatsApp checkout
**Deliver:** recipient validation, Arabic summary/URL builder, final cart/hours recheck, review-after-reconciliation behavior, explicit handoff link, and copy/selectable-text fallback. Include item names, quantities, unit prices, line totals, total, and confirmation request. Keep cart after handoff.

**Checks:** Arabic/special-character encoding, exact prices, correct profile recipient, empty/closed rejection, stale status, changed price/availability between review and handoff, excessive message size, popup/navigation/clipboard failure. Manually test target mobile/desktop WhatsApp flows and establish a documented conservative encoded-URL size limit.

**Exit:** WhatsApp opens a correct prepared message only for an eligible reviewed cart. UI visibly says “طلبك مُجهّز، وغير مؤكد حتى يؤكده المطعم”. No claim of sending, acceptance, or order confirmation.

## Phase 7 — Release-quality review and reuse handoff
**Deliver:** final refinement of Arabic typography, whitespace, imagery, motion, responsive behavior, accessible interactions, metadata, and performance. Document verified local run/check commands, restaurant selection/configuration and cache refresh, asset rights, session lifetime, WhatsApp limits, and known demo limitations in the existing docs.

**Checks:** relevant unit/feature/Livewire suite, available formatting/static analysis, production asset build, and full journey for both profiles. Review 360/390/768/1024/1440px, zoom/reflow, long copy, contrast, keyboard/screen-reader basics, reduced motion, image failure/loading, real refresh persistence, next-opening transitions, and WhatsApp handoff. Record exact commands/results; list blocked/unrun checks explicitly.

**Exit:** both restaurants meet PRD and all section-level design criteria through the same templates and logic. The visual review confirms a premium Warm Modern restaurant experience. Report delivered behavior, checks, outstanding limits, and any remaining prerequisites. Deployment is a separate request.

## Deferred work
MySQL-backed catalog/admin editing, stored orders, authentication for restaurant visitors, payments, modifiers, discounts/fees, branch-specific ordering, holiday exceptions, public multi-tenancy, language switching, delivery tracking, and analytics. Add these only against explicit requirements; do not introduce generic infrastructure for them now.
