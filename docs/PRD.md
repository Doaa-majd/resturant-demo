# Product requirements

## Purpose
Create a new, premium single-page Arabic RTL restaurant demo from scratch, using the provided framework starter kit. The result should feel like a distinctive restaurant brand: appetizing, warm, editorial, and effortless on mobile. Reuse comes from changing one restaurant profile and its assets, without editing shared templates or business rules.

Design quality is a primary acceptance gate, alongside correct ordering behavior. A generic Laravel dashboard, starter welcome page, or basic Tailwind card grid does not meet the brief. DESIGN_SYSTEM.md specifies visual direction and section criteria; ARCHITECTURE.md defines rules; ROADMAP.md stages delivery.

## Stack and delivery constraints
- Laravel 12 or 13 using the installed version. Local metadata identifies Laravel 13.42.0; no version change is planned.
- Livewire 4 (installed metadata: 4.4.8), Tailwind CSS 4 (declared in package.json), and existing frontend build tooling.
- MySQL for future database-backed features. The MVP identity/menu are configuration-backed; no restaurant database schema is required.
- Documentation only in this task. No application implementation, package installation, migrations, or deployment.

## Audience and primary journey
An Arabic-speaking visitor, usually on mobile:
1. Recognizes the restaurant through its name, logo, and food photography.
2. Sees whether it is open and, when closed, its next opening time in restaurant-local time.
3. Browses bestsellers, categories, dishes, and family offers.
4. Adds available items, changes quantities, and reviews an accurate total.
5. Opens WhatsApp with a prepared Arabic message and understands that the restaurant must still confirm the order.

## Required page sections
| Section | Required content and behavior |
| --- | --- |
| Header | Configured logo/name, section links, current status, and cart access; accessible mobile navigation. |
| Split hero | Arabic headline/copy on the right, editorial food scene on the left on desktop; menu CTA, status, and next opening when closed. Mobile stacks text then imagery. |
| Bestsellers | Curated references to real menu items, photos, SAR prices, and add actions or sold-out states. |
| Interactive menu | Ordered categories, sticky category navigation, food images, names, descriptions, prices, availability, and add controls. |
| Family offers | Featured fixed-price bundle items with included contents, serving guidance, price, and cart action. |
| Restaurant story | Configured Arabic story, image, and factual brand details without invented ratings or awards. |
| Branches/contact and hours | Branch details, addresses, phone/map links, full weekly schedule, timezone, status, and next opening. |
| Footer | Brand, navigation/contact links, hours link, and clear prepared-order wording. |
| Cart | Desktop panel and mobile sheet, quantities, removal, clear action, total, reconciliation notices, and WhatsApp handoff. |

## Core functional requirements
### Identity and configuration
Each restaurant has one authoritative profile for name, logo, hero/section imagery, section copy, menu/categories, featured items, offers, colors, weekly hours, timezone, currency, branches, and contacts. Provide two fictional Saudi restaurant profiles. A single configured restaurant key switches the whole experience; a public restaurant switcher is not required.

Use SAR with two minor-unit digits (integer halalas). Restaurant-specific content comes from the profile; shared Arabic interface labels belong in translation resources. Branches are informational: each selected profile has one schedule, timezone, menu, and ordering recipient. Independent branch ordering is deferred.

### Business hours
- Display the full weekly schedule, split shifts, and closed days in restaurant-local time, with the timezone labeled.
- Calculate current status, including overnight intervals and previous-day carryover.
- Closed status includes the next opening's local weekday/date and time, rather than an ambiguous “tomorrow.” If no opening is configured, show an explicit unavailable-schedule message.
- Refresh status while the page remains open and re-evaluate before handoff. Device timezone must not change the result.
- Closed visitors may browse and edit the cart; WhatsApp ordering is disabled with an explanation and next opening.

### Menu and family offers
Categories/items follow configured order. Every item has a name, description, photo or designed fallback, SAR price, and availability. Sold-out items remain visible with text and a disabled add action. Bestsellers and offers reference the same authoritative items as the menu.

A family offer is a single fixed-price menu item describing included food and serving guidance. It needs no choices, discounts, modifiers, or promotion engine. Both profiles include examples of every planned section.

### Cart
- Add, increment, decrement within bounds, explicitly remove, and clear. Quantities are integers from 1 to 99; decrement at one stays at one and removal has its own control.
- Persist IDs/quantities across refreshes within the anonymous server session, separately for each restaurant.
- Calculate line totals and grand total from server prices without floats. Total is the sum of line totals; fees, taxes as separate additions, and discounts are outside the demo model.
- Reject invalid IDs, sold-out additions, malformed quantities, and tampered state with safe Arabic feedback.
- Reconcile stale items, availability, and prices on restore and before handoff. Describe changes and require fresh review before opening WhatsApp.
- Support empty, loading, success, error, and changed-cart states without losing valid choices.

### WhatsApp checkout
Generate a properly encoded link to the configured recipient containing a prefilled Arabic message: restaurant name, item names, quantities, unit prices, line totals, SAR total, and a request for restaurant confirmation. Recheck cart and hours at handoff.

Use CTA “فتح واتساب” and nearby copy “طلبك مُجهّز، وغير مؤكد حتى يؤكده المطعم”. Include “يرجى تأكيد الطلب والتوفر” in the message. Never display an order success/confirmation screen or claim that opening the link sent the message. No WhatsApp API or automatic sending is required. Keep the cart afterward; offer a copyable summary if the link fails or exceeds the tested size limit.

## Visual and accessibility acceptance
- Warm Modern cream/terracotta palette, elegant Arabic typography, generous spacing, editorial composition, appetizing licensed photography, subtle motion, and polished mobile UX.
- Desktop hero places text right and imagery left; mobile preserves a clear text-to-image journey and visible menu CTA.
- Every section meets DESIGN_SYSTEM.md criteria with both profiles.
- Root language is Arabic and direction RTL. Use logical layout and isolate phones/mixed-direction values.
- Target WCAG 2.2 AA: keyboard access, visible focus, contrast, landmarks, text availability labels, accessible dialogs, and reduced motion.
- At 360, 390, 768, 1024, and 1440px: no page overflow, clipped Arabic, obscured controls, or sticky elements covering content. Check 200% zoom/reflow and long copy.
- Content remains readable if animation or an image fails. Images are responsive with explicit sizing; below-fold images are lazy loaded and the hero receives appropriate loading priority.

## Completion evidence
Automated tests cover profile validation/switching, hours/next opening, exact totals and session behavior, invalid input, reconciliation, and Arabic WhatsApp encoding/eligibility. Manual review covers mobile/desktop design, keyboard/focus, RTL mixed text, photography, refresh persistence, and real WhatsApp handoff. Record exact results and gaps; planning does not constitute passing checks.

## Non-goals and limitations
No admin dashboard, visitor accounts, payments, stored restaurant orders, stock system, delivery tracking, analytics, public multi-tenancy, branch-specific carts, language switching, holiday overrides, or database-backed catalog. Starter auth scaffolding does not expand scope. Weekly schedules alone do not represent holiday exceptions; disclose this in setup documentation.

Session persistence follows the configured server lifetime, without cross-device or indefinite persistence. Acceptance, payment, and fulfillment happen outside the website. MySQL integration is deferred until an explicit database-backed feature requires it.
