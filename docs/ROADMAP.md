# Roadmap

## Delivery rules
This is a NEW restaurant website built from scratch on the supplied Laravel starter kit. Existing framework scaffolding is a starting toolset, not an existing restaurant product to refactor or migrate. Do not create a legacy-feature inventory, migration plan, or speculative compatibility layer.

Deliver sequential, small, reviewable phases. Each phase includes focused checks and an exit gate; satisfy that gate before expanding scope. Every UI phase must meet its DESIGN_SYSTEM.md section criteria, with real Arabic copy and representative photography. Design is a priority throughout, not work postponed to the last phase.

Current authorization covers documentation only. All phases below are planned, not completed. Do not implement code, install packages, change dependencies, run migrations, or deploy in this documentation task. During implementation, package installation requires explicit authorization; do not run composer setup as a shortcut.

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

## Phase 1 — Restaurant profiles and validation
**Deliver:** one configuration source with a single active key and two complete fictional profiles. Include branding, section copy/assets, semantic colors, SAR, timezone, weekly hours, ordered menu, bestseller/offer references, story, branches, contacts, and recipient. Implement focused resolver/validation logic, with no database catalog.

**Checks:** valid/invalid profiles; missing/duplicate IDs; integer prices and SAR precision; invalid timezone/hours/recipient/theme; broken section references; selection of either profile with no content leakage. Verify configuration can be cached using available tooling.

**Exit:** changing one configured key selects a fully valid restaurant without changing shared logic. Both profiles have content/asset plans for every required section. No public switcher or tenancy system.

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
