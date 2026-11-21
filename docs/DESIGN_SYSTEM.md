# Design system

## Creative direction: Warm Modern
A premium Arabic restaurant website with the warmth of a shared table and the confidence of an editorial food feature. Design is a top priority, not a final coat of styling. Use warm cream, deep terracotta, dark brown ink, generous whitespace, elegant Arabic type, rich food photography, and restrained motion.

Avoid dashboard sidebars, starter-kit branding, dense boxed layouts, identical cards for every section, default gray/blue styling, excessive pills, and decorative gradients replacing food imagery. Give sections distinct compositions while keeping typography, controls, and spacing consistent. No fabricated ratings, testimonials, or awards.

## Semantic palette and tokens
These are the default visual targets. Each profile may override approved tokens while preserving contrast and composition.

| Token | Default | Use |
| --- | --- | --- |
| canvas | #FFF8EF | Warm cream page background |
| surface | #FFFFFF | Menu/cart surfaces, used selectively |
| surface-warm | #F4E6D7 | Story/offer panels and gentle section contrast |
| ink | #30231C | Main text and headings |
| muted | #6B574A | Secondary readable text |
| primary | #A3442E | Terracotta CTAs and selected states |
| on-primary | #FFFFFF | Text on primary actions |
| border | #DCCABC | Quiet separation; not the sole control boundary if contrast is insufficient |
| success | #356247 | Open/available text and icon |
| danger | #9C3028 | Errors and sold-out emphasis |
| focus | #75401F | Visible focus outline with a contrasting offset |

Verify actual token combinations for WCAG 2.2 AA: 4.5:1 for normal text, 3:1 for large text and required UI boundaries/icons. These defaults are design proposals, not a completed contrast audit. Muted text remains readable; status always includes words, not color alone. Do not render text over uncontrolled food images without a tested solid backing/overlay.

- Spacing scale: 4, 8, 12, 16, 24, 32, 48, 64, 96, 128px.
- Content width: approximately 1240px; gutters 20px mobile, 32px tablet, 48px desktop.
- Section spacing: 56–72px mobile, 88–120px desktop; deliberate breathing room around hero/story.
- Controls: at least 44px high, generally 48px; 12–16px radius. Cards 20–24px, editorial imagery up to 32px; pills reserved for short status/category controls.
- Elevation: quiet warm shadow for floating cart/sticky elements and stronger modal separation. Avoid heavy shadows on every dish.
- Layer order: page, sticky header/category rail, mobile cart bar, modal/backdrop, transient feedback. Only modal controls sit above its backdrop.
- Use semantic CSS variables mapped through Tailwind 4. Theme changes must not require utility-class edits in templates.

## Arabic typography and copy
Use an Arabic-capable family such as Tajawal for UI/body and Noto Kufi Arabic for selective display headings, subject to locally verified availability and licensing. Prefer one family if it provides the required quality/performance. The starter Latin font is not the Arabic design choice. Use approved profile typography tokens with Arabic system fallbacks, limited weights, and sensible font loading.

| Role | Mobile | Desktop | Guidance |
| --- | --- | --- | --- |
| Hero headline | 36–44px | 56–72px | Two to three balanced lines, line height 1.35–1.5 |
| Section heading | 28–32px | 36–44px | Clear hierarchy, line height about 1.5 |
| Dish title | 19–22px | 20–24px | Readable with long Arabic names |
| Body | 16–18px | 18px | Line height 1.75–1.9 |
| Supporting labels | 14–16px | 14–16px | Never tiny or low contrast |

Do not apply Latin letter-spacing tricks to Arabic or clip diacritics. Avoid forcing line breaks that fail for the second restaurant. Keep copy warm, direct, and concise. Use shared labels such as “استكشف القائمة”, “أضف إلى السلة”, “الأكثر طلبًا”, “عروض العائلة”, and “حكايتنا”. Profile copy supplies restaurant-specific headlines and stories.

Root lang="ar" and dir="rtl"; logical margins/padding/positioning. Isolate phone numbers, URLs, and formatted prices with appropriate bidi markup. Display SAR consistently, with exact two-digit amounts where needed and no float arithmetic. Directional icons mirror when their meaning requires it; universal icons retain their meaning.

## Photography and art direction
- Hero: a rich editorial food scene with the restaurant's signature dishes, warm directional light, natural food texture, ceramic plates, linen/wood, and intentional composition. Use real assets with usage rights, not remote placeholder URLs.
- Hero source should support a large landscape crop (roughly 4:3 or 5:4) plus mobile cropping without cutting away the main dish. Configure a focal point when needed.
- Dish images: consistent 4:3 crops, appetizing close detail, coherent lighting/color treatment, no text baked into photos. Family/story imagery can be wider to vary the rhythm.
- Preserve explicit dimensions/aspect ratios, responsive sources, and useful alt text. Decorative embellishments have empty alt text.
- Hero image loads eagerly with appropriate priority; below-fold photos lazy load. Avoid oversized full-resolution downloads and layout shifts.
- Missing images use a warm branded illustration/neutral plate treatment with readable dish content. Broken-image icons and generic framework placeholders are unacceptable.
- Track source/license/required attribution in implementation handoff notes. No external image generation, stock purchase, or asset dependency installation is implied by this documentation task.

## Page composition and section acceptance
### Header
Airy horizontal brand bar: identity at the RTL start, concise section links, status/cart controls. Mobile uses a compact accessible menu and cart button.

Acceptance: configured logo/name; useful alternative text; links reach the correct sections; cart count is accurate; open/closed state is readable; mobile menu supports keyboard/Escape/focus return. Sticky header does not obscure anchor targets. No dashboard navigation or account prompts in the storefront.

### Split hero
On desktop (target 1024px and above), Arabic copy is on the right and the food scene on the left, approximately a balanced 45/55 split. Use a small introductory label, commanding headline, short supporting paragraph, dominant menu CTA, and a quiet status line. The image can have an asymmetric frame or subtle decorative texture; keep the food dominant.

On mobile/tablet stack copy then imagery, with compact enough spacing that the CTA is visible without excessive scrolling. Do not use fixed viewport heights that clip Arabic or force a giant empty hero.

Acceptance: name/logo and menu CTA are clear; CTA scrolls to the menu; text-right/image-left composition is verified at desktop; food remains the crop focal point at mobile; closed state includes local next opening; long Arabic copy and image failure preserve hierarchy; no overlap or illegible photo overlays.

### Bestsellers
A curated selection with generous photography and a distinctive section heading. Use a readable grid or deliberate horizontal rail, with visible scrolling affordance and accessible controls if used. No auto-advancing carousel.

Acceptance: every card references an authoritative menu item, shows name/photo/SAR price, and uses the same add behavior as the menu. Sold-out state remains visible. Repeated actions have specific accessible names; mobile cards are reachable without page overflow.

### Interactive menu
Sticky, horizontally scrollable category rail beneath the header; active category has both visual and semantic indication. Group dishes under clear headings. Use one-column mobile cards, two columns when comfortable, and more only if Arabic copy and controls remain readable. Keep category tracking/navigation client-side only as presentation behavior.

Acceptance: categories follow configured order and link to their sections; selected state is clear; sticky offsets respect the header; name, description, image, SAR price, and action remain legible with long copy. Sold-out controls are disabled and labeled “نفد مؤقتًا”. Empty categories/menu and missing photos have designed states. Add actions show loading/feedback and cannot accidentally double-submit.

### Family offers
A warm editorial band with large shared-meal photography and fixed-price bundle cards, visually distinct from individual dishes. Show included food and serving guidance without implying configurable options.

Acceptance: offers reference ordinary menu items and use the same server price, availability, and cart actions. No invented discount percentages or crossed-out prices. Bundle contents, serving guidance, SAR price, and sold-out state are visible on mobile and desktop.

### Restaurant story
A quieter split section pairing configured Arabic narrative with an atmospheric image and restrained brand detail. Alternate the visual rhythm from the hero; avoid another dense card grid.

Acceptance: real configured story/image render for each profile; text has comfortable line length and contrast; mobile reading order is coherent; no hardcoded restaurant history or unsupported claims.

### Branches, contact, and business hours
Warm information section with branch address/contact blocks and a legible weekly schedule. Emphasize today's row without color alone. Prefer a useful map link over a heavy embedded map.

Acceptance: every configured branch has an address and usable phone/map links; phone values are directionally isolated; full weekly schedule includes split shifts/closed days, timezone, current status, and local next opening when closed. Branches are informational; no independent branch selection/cart behavior is implied. Map/phone links have descriptive names.

### Footer
A refined closing band with logo/name, useful anchor/contact links, and a short WhatsApp preparation explanation. Give the mobile sticky cart enough clearance.

Acceptance: links work; content comes from the profile/shared translations as appropriate; no misleading order-confirmation language; bottom content is not hidden behind the cart bar or device safe area.

### Cart and WhatsApp review
Desktop: a calm cart panel beside the menu where space permits, with bounded height and reachable controls. Mobile: a fixed bottom bar showing item count/total, opening an accessible sheet/dialog with line items and clear primary action. Never cover page content without reserved padding.

Acceptance: add/update/remove/clear work with specific labels, images/names, unit/line prices, and grand total. Decrement at one does not remove. Empty state links to the menu. Loading, server errors, and reconciled changes are visible and announced. Preserve valid lines after errors. Dialog supports Escape, focus containment/restoration, scroll locking, and an explicit close button.

Use “فتح واتساب” with “طلبك مُجهّز، وغير مؤكد حتى يؤكده المطعم” near the action. Empty/closed carts cannot hand off; show a reason and next opening if available. No success animation implying submission. After handoff keep the cart and explain that confirmation happens with the restaurant. Copy fallback includes readable/selectable Arabic text.

## Motion and interaction
Use restrained 160–240ms transitions for controls and 300–450ms fades/small shifts for optional section reveals. Hover can subtly lift imagery or buttons; touch does not depend on hover. No parallax, auto-scrolling content, flashing status, or scroll-jacking. Respect prefers-reduced-motion by removing transforms/reveals and keeping all content visible. Loading indicators must not shift layout or replace accessible button names.

## Responsive and accessibility review
Check 360, 390, 768, 1024, and 1440px, portrait/landscape, 200% zoom/reflow, long Arabic strings, both profiles, and all states. Rail overflow stays inside its container. Header/category/cart sticky areas must not collide or obscure focus/anchors. Mobile cart uses safe-area padding and avoids covering content when the keyboard is present.

Target WCAG 2.2 AA: semantic landmarks/headings, skip link, keyboard access, visible focus, 44×44px preferred touch targets, contrast, meaningful alt text, non-color status labels, and restrained live announcements. Announce cart updates/errors without unexpected focus changes. Test modal focus return and keyboard reachability of horizontally scrolling controls.

## Visual review gate
Before accepting a UI phase, capture/review mobile and desktop renders with real Arabic copy and actual imagery, including a sold-out dish, closed status, long name, and cart error. Compare against this document: hero composition, typography hierarchy, warmth, whitespace, food quality, section variety, and control polish must all be evident. Automated markup tests alone cannot establish premium design quality. Record reviewed sizes, accessibility checks, gaps, and asset-rights status.
