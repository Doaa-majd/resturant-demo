<?php

return [
    'active' => env('RESTAURANT_PROFILE', 'dar-al-sufra'),
    'profiles' => [
        'dar-al-sufra' => [
            'key' => 'dar-al-sufra',
            'name' => 'دار السفرة',
            'introduction' => 'أطباق سعودية بروح البيت',
            'logo' => [
                'path' => null,
                'alt' => 'شعار دار السفرة',
                'plan' => 'تصميم كلمة عربية أصلية؛ حفظ نسخة SVG محلية عند تنفيذ الهوية.',
                'attribution' => null,
            ],
            'currency' => [
                'code' => 'SAR',
                'minor_digits' => 2,
            ],
            'timezone' => 'Asia/Riyadh',
            'theme' => [
                'font' => 'tajawal',
                'colors' => [
                    'canvas' => '#FFF8EF',
                    'surface' => '#FFFFFF',
                    'surface-warm' => '#F4E6D7',
                    'ink' => '#30231C',
                    'muted' => '#6B574A',
                    'primary' => '#A3442E',
                    'on-primary' => '#FFFFFF',
                    'border' => '#DCCABC',
                    'success' => '#356247',
                    'danger' => '#9C3028',
                    'focus' => '#75401F',
                ],
            ],
            'hours' => [
                'monday' => [
                    [
                        'start' => '12:00',
                        'end' => '23:00',
                    ],
                ],
                'tuesday' => [
                    [
                        'start' => '12:00',
                        'end' => '23:00',
                    ],
                ],
                'wednesday' => [
                    [
                        'start' => '12:00',
                        'end' => '23:00',
                    ],
                ],
                'thursday' => [
                    [
                        'start' => '12:00',
                        'end' => '23:00',
                    ],
                ],
                'friday' => [
                    [
                        'start' => '13:00',
                        'end' => '01:00',
                    ],
                ],
                'saturday' => [
                    [
                        'start' => '12:00',
                        'end' => '23:00',
                    ],
                ],
                'sunday' => [
                    [
                        'start' => '12:00',
                        'end' => '23:00',
                    ],
                ],
            ],
            'contacts' => [
                'ordering_enabled' => env('DAR_AL_SUFRA_ORDERING_ENABLED', false),
                'whatsapp' => env('DAR_AL_SUFRA_WHATSAPP_NUMBER'),
                'phone' => env('DAR_AL_SUFRA_PHONE_NUMBER'),
                'notice' => 'مطعم خيالي للعرض التجريبي؛ التواصل والطلب غير متاحين حتى إعداد بيانات اختبار مصرح بها.',
            ],
            'hero' => [
                'heading' => 'سفرة دافئة، ونكهة تجمعنا',
                'copy' => 'أطباق سعودية بروح البيت، من أول لقمة إلى آخر جلسة.',
                'image' => [
                    'path' => null,
                    'alt' => 'كبسة دجاج في طبق تقديم على سفرة دافئة',
                    'plan' => 'صورة تحريرية مرخصة بنسبة 4:3، إضاءة دافئة وأوانٍ خزفية؛ تثبيت الحقوق والمصدر قبل النشر.',
                    'attribution' => null,
                ],
            ],
            'bestsellers' => [
                'heading' => 'من أطباق دار السفرة',
                'copy' => 'اختيارات من سفرتنا لتبدأ بها وجبتك.',
                'item_ids' => [
                    'chicken-kabsa',
                    'jareesh',
                ],
            ],
            'menu' => [
                'heading' => 'قائمة دار السفرة',
                'copy' => 'اختر أطباقك المفضلة وأكمل سفرتك بالمقبلات والمشروبات.',
            ],
            'offers' => [
                'heading' => 'لمة بطعم دار السفرة',
                'copy' => 'وجبة ثابتة للمشاركة، مع تفاصيل واضحة لما تتضمنه.',
                'item_ids' => [
                    'family-table',
                ],
            ],
            'story' => [
                'heading' => 'حكاية دار السفرة',
                'copy' => 'في دار السفرة، تبدأ الحكاية من مائدة تجمع الأحبة. اخترنا أطباقًا مألوفة وتفاصيل دافئة لتكون الوجبة مساحة للّمة.',
                'image' => [
                    'path' => null,
                    'alt' => 'أطباق سعودية على مائدة مشتركة مع أوانٍ خزفية',
                    'plan' => 'صورة مرخصة لمائدة مشتركة؛ قص أفقي مختلف عن البطل، مع توثيق المصدر والحقوق.',
                    'attribution' => null,
                ],
            ],
            'contact' => [
                'heading' => 'نلتقي على السفرة',
                'copy' => 'بيانات فرع توضيحية لمطعم خيالي، وليست عنوانًا لمطعم عامل.',
            ],
            'categories' => [
                [
                    'id' => 'main',
                    'name' => 'أطباق السفرة',
                ],
                [
                    'id' => 'starters',
                    'name' => 'المقبلات',
                ],
                [
                    'id' => 'drinks',
                    'name' => 'المشروبات',
                ],
                [
                    'id' => 'family',
                    'name' => 'سفرة العائلة',
                ],
            ],
            'items' => [
                [
                    'id' => 'chicken-kabsa',
                    'category_id' => 'main',
                    'name' => 'كبسة دجاج',
                    'description' => 'أرز متبل مع دجاج وتوابل دافئة، يقدم على طريقة سفرة البيت.',
                    'price_minor' => 3200,
                    'available' => true,
                    'image' => [
                        'path' => null,
                        'alt' => 'كبسة دجاج من دار السفرة',
                        'plan' => 'صورة طبق مرخصة بنسبة 4:3 مع توثيق الحقوق؛ استخدام معالجة بديلة دافئة حتى اقتنائها.',
                        'attribution' => null,
                    ],
                ],
                [
                    'id' => 'jareesh',
                    'category_id' => 'main',
                    'name' => 'جريش',
                    'description' => 'جريش قمح كريمي مع البصل المحمر ولمسة من السمن.',
                    'price_minor' => 2400,
                    'available' => true,
                    'image' => [
                        'path' => null,
                        'alt' => 'جريش من دار السفرة',
                        'plan' => 'صورة طبق مرخصة بنسبة 4:3 مع توثيق الحقوق؛ استخدام معالجة بديلة دافئة حتى اقتنائها.',
                        'attribution' => null,
                    ],
                ],
                [
                    'id' => 'green-salad',
                    'category_id' => 'starters',
                    'name' => 'سلطة خضراء',
                    'description' => 'خضار طازجة مع الليمون وزيت الزيتون.',
                    'price_minor' => 1200,
                    'available' => true,
                    'image' => [
                        'path' => null,
                        'alt' => 'سلطة خضراء من دار السفرة',
                        'plan' => 'صورة طبق مرخصة بنسبة 4:3 مع توثيق الحقوق؛ استخدام معالجة بديلة دافئة حتى اقتنائها.',
                        'attribution' => null,
                    ],
                ],
                [
                    'id' => 'laban',
                    'category_id' => 'drinks',
                    'name' => 'لبن',
                    'description' => 'لبن بارد يرافق أطباق السفرة.',
                    'price_minor' => 600,
                    'available' => true,
                    'image' => [
                        'path' => null,
                        'alt' => 'لبن من دار السفرة',
                        'plan' => 'صورة طبق مرخصة بنسبة 4:3 مع توثيق الحقوق؛ استخدام معالجة بديلة دافئة حتى اقتنائها.',
                        'attribution' => null,
                    ],
                ],
                [
                    'id' => 'family-table',
                    'category_id' => 'family',
                    'name' => 'لمة الدار',
                    'description' => 'سفرة مشاركة تجمع الكبسة والسلطة واللبن.',
                    'price_minor' => 11900,
                    'available' => true,
                    'image' => [
                        'path' => null,
                        'alt' => 'لمة الدار من دار السفرة',
                        'plan' => 'صورة طبق مرخصة بنسبة 4:3 مع توثيق الحقوق؛ استخدام معالجة بديلة دافئة حتى اقتنائها.',
                        'attribution' => null,
                    ],
                    'bundle' => [
                        'contents' => [
                            'طبق كبسة دجاج للمشاركة',
                            'سلطة خضراء',
                            'أربع عبوات لبن',
                        ],
                        'serving' => 'تكفي أربعة أشخاص',
                    ],
                ],
            ],
            'branches' => [
                [
                    'id' => 'demo-branch',
                    'name' => 'فرع الرياض التوضيحي',
                    'address' => 'الرياض — موقع توضيحي فقط، لا يمثل عنوان مطعم عامل.',
                    'phone' => env('DAR_AL_SUFRA_PHONE_NUMBER'),
                    'map_url' => 'https://www.google.com/maps/search/?api=1&query=Riyadh',
                ],
            ],
            'footer' => 'دار السفرة — نموذج خيالي لسفرة تجمعنا. فتح واتساب يجهز رسالة؛ تأكيد الطلب والتوفر من المطعم.',
        ],
        'saj-wa-zaytoun' => [
            'key' => 'saj-wa-zaytoun',
            'name' => 'صاج وزيتون',
            'introduction' => 'خبز دافئ ومائدة مشتركة',
            'logo' => [
                'path' => null,
                'alt' => 'شعار صاج وزيتون',
                'plan' => 'تصميم كلمة عربية أصلية؛ حفظ نسخة SVG محلية عند تنفيذ الهوية.',
                'attribution' => null,
            ],
            'currency' => [
                'code' => 'SAR',
                'minor_digits' => 2,
            ],
            'timezone' => 'Asia/Riyadh',
            'theme' => [
                'font' => 'tajawal',
                'colors' => [
                    'canvas' => '#FFF8EF',
                    'surface' => '#FFFFFF',
                    'surface-warm' => '#F4E6D7',
                    'ink' => '#30231C',
                    'muted' => '#6B574A',
                    'primary' => '#A3442E',
                    'on-primary' => '#FFFFFF',
                    'border' => '#DCCABC',
                    'success' => '#356247',
                    'danger' => '#9C3028',
                    'focus' => '#75401F',
                ],
            ],
            'hours' => [
                'monday' => [
                    [
                        'start' => '11:00',
                        'end' => '15:00',
                    ],
                    [
                        'start' => '18:00',
                        'end' => '23:00',
                    ],
                ],
                'tuesday' => [
                    [
                        'start' => '11:00',
                        'end' => '15:00',
                    ],
                    [
                        'start' => '18:00',
                        'end' => '23:00',
                    ],
                ],
                'wednesday' => [
                    [
                        'start' => '11:00',
                        'end' => '15:00',
                    ],
                    [
                        'start' => '18:00',
                        'end' => '23:00',
                    ],
                ],
                'thursday' => [
                    [
                        'start' => '11:00',
                        'end' => '01:00',
                    ],
                ],
                'friday' => [],
                'saturday' => [
                    [
                        'start' => '11:00',
                        'end' => '15:00',
                    ],
                    [
                        'start' => '18:00',
                        'end' => '23:00',
                    ],
                ],
                'sunday' => [
                    [
                        'start' => '11:00',
                        'end' => '15:00',
                    ],
                    [
                        'start' => '18:00',
                        'end' => '23:00',
                    ],
                ],
            ],
            'contacts' => [
                'ordering_enabled' => env('SAJ_WA_ZAYTOUN_ORDERING_ENABLED', false),
                'whatsapp' => env('SAJ_WA_ZAYTOUN_WHATSAPP_NUMBER'),
                'phone' => env('SAJ_WA_ZAYTOUN_PHONE_NUMBER'),
                'notice' => 'مطعم خيالي للعرض التجريبي؛ التواصل والطلب غير متاحين حتى إعداد بيانات اختبار مصرح بها.',
            ],
            'hero' => [
                'heading' => 'من الصاج إلى سفرتك',
                'copy' => 'خبز دافئ ومشاوي ومقبلات، لوجبة تحب مشاركتها.',
                'image' => [
                    'path' => null,
                    'alt' => 'خبز صاج ومشاوي ومقبلات على مائدة مشتركة',
                    'plan' => 'صورة تحريرية مرخصة بنسبة 4:3، إضاءة دافئة وأوانٍ خزفية؛ تثبيت الحقوق والمصدر قبل النشر.',
                    'attribution' => null,
                ],
            ],
            'bestsellers' => [
                'heading' => 'من أطباق صاج وزيتون',
                'copy' => 'اختيارات من سفرتنا لتبدأ بها وجبتك.',
                'item_ids' => [
                    'chicken-musakhan',
                    'shish-tawook',
                ],
            ],
            'menu' => [
                'heading' => 'قائمة صاج وزيتون',
                'copy' => 'اختر أطباقك المفضلة وأكمل سفرتك بالمقبلات والمشروبات.',
            ],
            'offers' => [
                'heading' => 'لمة بطعم صاج وزيتون',
                'copy' => 'وجبة ثابتة للمشاركة، مع تفاصيل واضحة لما تتضمنه.',
                'item_ids' => [
                    'family-saj',
                ],
            ],
            'story' => [
                'heading' => 'حكاية صاج وزيتون',
                'copy' => 'نحب رائحة الخبز الدافئ وبساطة المائدة المشتركة. صاج وزيتون يجمع أطباقًا قريبة من القلب، لتختار منها سفرتك.',
                'image' => [
                    'path' => null,
                    'alt' => 'خبز وزيتون ومقبلات على مائدة خشبية دافئة',
                    'plan' => 'صورة مرخصة لمائدة مشتركة؛ قص أفقي مختلف عن البطل، مع توثيق المصدر والحقوق.',
                    'attribution' => null,
                ],
            ],
            'contact' => [
                'heading' => 'نلتقي على السفرة',
                'copy' => 'بيانات فرع توضيحية لمطعم خيالي، وليست عنوانًا لمطعم عامل.',
            ],
            'categories' => [
                [
                    'id' => 'saj',
                    'name' => 'من الصاج',
                ],
                [
                    'id' => 'grill',
                    'name' => 'المشاوي',
                ],
                [
                    'id' => 'starters',
                    'name' => 'المقبلات',
                ],
                [
                    'id' => 'drinks',
                    'name' => 'المشروبات',
                ],
                [
                    'id' => 'family',
                    'name' => 'سفرة العائلة',
                ],
            ],
            'items' => [
                [
                    'id' => 'chicken-musakhan',
                    'category_id' => 'saj',
                    'name' => 'مسخن دجاج',
                    'description' => 'لفائف صاج بالدجاج والبصل والسماق وزيت الزيتون.',
                    'price_minor' => 2800,
                    'available' => true,
                    'image' => [
                        'path' => null,
                        'alt' => 'مسخن دجاج من صاج وزيتون',
                        'plan' => 'صورة طبق مرخصة بنسبة 4:3 مع توثيق الحقوق؛ استخدام معالجة بديلة دافئة حتى اقتنائها.',
                        'attribution' => null,
                    ],
                ],
                [
                    'id' => 'shish-tawook',
                    'category_id' => 'grill',
                    'name' => 'شيش طاووق',
                    'description' => 'قطع دجاج مشوية مع الخبز والثوم.',
                    'price_minor' => 3600,
                    'available' => true,
                    'image' => [
                        'path' => null,
                        'alt' => 'شيش طاووق من صاج وزيتون',
                        'plan' => 'صورة طبق مرخصة بنسبة 4:3 مع توثيق الحقوق؛ استخدام معالجة بديلة دافئة حتى اقتنائها.',
                        'attribution' => null,
                    ],
                ],
                [
                    'id' => 'hummus',
                    'category_id' => 'starters',
                    'name' => 'حمص',
                    'description' => 'حمص ناعم بالطحينة وزيت الزيتون مع الخبز.',
                    'price_minor' => 1400,
                    'available' => true,
                    'image' => [
                        'path' => null,
                        'alt' => 'حمص من صاج وزيتون',
                        'plan' => 'صورة طبق مرخصة بنسبة 4:3 مع توثيق الحقوق؛ استخدام معالجة بديلة دافئة حتى اقتنائها.',
                        'attribution' => null,
                    ],
                ],
                [
                    'id' => 'mint-lemon',
                    'category_id' => 'drinks',
                    'name' => 'ليمون بالنعناع',
                    'description' => 'عصير ليمون منعش مع أوراق النعناع.',
                    'price_minor' => 1200,
                    'available' => true,
                    'image' => [
                        'path' => null,
                        'alt' => 'ليمون بالنعناع من صاج وزيتون',
                        'plan' => 'صورة طبق مرخصة بنسبة 4:3 مع توثيق الحقوق؛ استخدام معالجة بديلة دافئة حتى اقتنائها.',
                        'attribution' => null,
                    ],
                ],
                [
                    'id' => 'family-saj',
                    'category_id' => 'family',
                    'name' => 'لمة الصاج',
                    'description' => 'مشاوي ولفائف ومقبلات لسفرة مشتركة.',
                    'price_minor' => 12900,
                    'available' => true,
                    'image' => [
                        'path' => null,
                        'alt' => 'لمة الصاج من صاج وزيتون',
                        'plan' => 'صورة طبق مرخصة بنسبة 4:3 مع توثيق الحقوق؛ استخدام معالجة بديلة دافئة حتى اقتنائها.',
                        'attribution' => null,
                    ],
                    'bundle' => [
                        'contents' => [
                            'طبق شيش طاووق للمشاركة',
                            'لفائف مسخن',
                            'حمص',
                            'خبز صاج',
                        ],
                        'serving' => 'تكفي أربعة أشخاص',
                    ],
                ],
            ],
            'branches' => [
                [
                    'id' => 'demo-branch',
                    'name' => 'فرع جدة التوضيحي',
                    'address' => 'جدة — موقع توضيحي فقط، لا يمثل عنوان مطعم عامل.',
                    'phone' => env('SAJ_WA_ZAYTOUN_PHONE_NUMBER'),
                    'map_url' => 'https://www.google.com/maps/search/?api=1&query=Jeddah',
                ],
            ],
            'footer' => 'صاج وزيتون — نموذج خيالي لسفرة تجمعنا. فتح واتساب يجهز رسالة؛ تأكيد الطلب والتوفر من المطعم.',
        ],
    ],
];
