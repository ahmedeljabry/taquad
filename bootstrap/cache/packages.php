<?php return array (
  'akaunting/laravel-money' => 
  array (
    'providers' => 
    array (
      0 => 'Akaunting\\Money\\Provider',
    ),
  ),
  'akcybex/laravel-jazzcash' => 
  array (
    'providers' => 
    array (
      0 => 'AKCybex\\JazzCash\\AKJazzCashServiceProvider',
    ),
    'aliases' => 
    array (
      'JazzCash' => 'AKCybex\\JazzCash\\Facades\\JazzCash',
    ),
  ),
  'artesaos/seotools' => 
  array (
    'aliases' => 
    array (
      'SEO' => 'Artesaos\\SEOTools\\Facades\\SEOTools',
      'JsonLd' => 'Artesaos\\SEOTools\\Facades\\JsonLd',
      'SEOMeta' => 'Artesaos\\SEOTools\\Facades\\SEOMeta',
      'Twitter' => 'Artesaos\\SEOTools\\Facades\\TwitterCard',
      'OpenGraph' => 'Artesaos\\SEOTools\\Facades\\OpenGraph',
    ),
    'providers' => 
    array (
      0 => 'Artesaos\\SEOTools\\Providers\\SEOToolsServiceProvider',
    ),
  ),
  'astrotomic/laravel-translatable' => 
  array (
    'providers' => 
    array (
      0 => 'Astrotomic\\Translatable\\TranslatableServiceProvider',
    ),
  ),
  'barryvdh/laravel-debugbar' => 
  array (
    'aliases' => 
    array (
      'Debugbar' => 'Barryvdh\\Debugbar\\Facades\\Debugbar',
    ),
    'providers' => 
    array (
      0 => 'Barryvdh\\Debugbar\\ServiceProvider',
    ),
  ),
  'blade-ui-kit/blade-icons' => 
  array (
    'providers' => 
    array (
      0 => 'BladeUI\\Icons\\BladeIconsServiceProvider',
    ),
  ),
  'cartalyst/stripe-laravel' => 
  array (
    'providers' => 
    array (
      0 => 'Cartalyst\\Stripe\\Laravel\\StripeServiceProvider',
    ),
    'aliases' => 
    array (
      'Stripe' => 'Cartalyst\\Stripe\\Laravel\\Facades\\Stripe',
    ),
  ),
  'cloudinary-labs/cloudinary-laravel' => 
  array (
    'aliases' => 
    array (
      'Cloudinary' => 'CloudinaryLabs\\CloudinaryLaravel\\Facades\\Cloudinary',
    ),
    'providers' => 
    array (
      0 => 'CloudinaryLabs\\CloudinaryLaravel\\CloudinaryServiceProvider',
    ),
  ),
  'daftspunk/laravel-config-writer' => 
  array (
    'providers' => 
    array (
      0 => 'October\\Rain\\Config\\ServiceProvider',
    ),
  ),
  'edwardhendrix/log-viewer' => 
  array (
    'providers' => 
    array (
      0 => 'Opcodes\\LogViewer\\LogViewerServiceProvider',
    ),
    'aliases' => 
    array (
      'LogViewer' => 'Opcodes\\LogViewer\\Facades\\LogViewer',
    ),
  ),
  'intervention/image' => 
  array (
    'providers' => 
    array (
      0 => 'Intervention\\Image\\ImageServiceProvider',
    ),
    'aliases' => 
    array (
      'Image' => 'Intervention\\Image\\Facades\\Image',
    ),
  ),
  'jantinnerezo/livewire-alert' => 
  array (
    'aliases' => 
    array (
      'LivewireAlert' => 'Jantinnerezo\\LivewireAlert\\LivewireAlertFacade',
    ),
    'providers' => 
    array (
      0 => 'Jantinnerezo\\LivewireAlert\\LivewireAlertServiceProvider',
    ),
  ),
  'jenssegers/agent' => 
  array (
    'providers' => 
    array (
      0 => 'Jenssegers\\Agent\\AgentServiceProvider',
    ),
    'aliases' => 
    array (
      'Agent' => 'Jenssegers\\Agent\\Facades\\Agent',
    ),
  ),
  'laravel/sail' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Sail\\SailServiceProvider',
    ),
  ),
  'laravel/sanctum' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Sanctum\\SanctumServiceProvider',
    ),
  ),
  'laravel/socialite' => 
  array (
    'aliases' => 
    array (
      'Socialite' => 'Laravel\\Socialite\\Facades\\Socialite',
    ),
    'providers' => 
    array (
      0 => 'Laravel\\Socialite\\SocialiteServiceProvider',
    ),
  ),
  'laravel/tinker' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Tinker\\TinkerServiceProvider',
    ),
  ),
  'livewire/livewire' => 
  array (
    'aliases' => 
    array (
      'Livewire' => 'Livewire\\Livewire',
    ),
    'providers' => 
    array (
      0 => 'Livewire\\LivewireServiceProvider',
    ),
  ),
  'loveycom/cashfree' => 
  array (
    'providers' => 
    array (
      0 => 'LoveyCom\\CashFree\\CashFreeServiceProvider',
    ),
  ),
  'maatwebsite/excel' => 
  array (
    'aliases' => 
    array (
      'Excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
    ),
    'providers' => 
    array (
      0 => 'Maatwebsite\\Excel\\ExcelServiceProvider',
    ),
  ),
  'mkocansey/bladewind' => 
  array (
    'providers' => 
    array (
      0 => 'Mkocansey\\Bladewind\\BladewindServiceProvider',
    ),
  ),
  'mollie/laravel-mollie' => 
  array (
    'providers' => 
    array (
      0 => 'Mollie\\Laravel\\MollieServiceProvider',
    ),
    'aliases' => 
    array (
      'Mollie' => 'Mollie\\Laravel\\Facades\\Mollie',
    ),
  ),
  'munafio/chatify' => 
  array (
    'aliases' => 
    array (
      'Chatify' => 'Chatify\\Facades\\ChatifyMessenger',
    ),
    'providers' => 
    array (
      0 => 'Chatify\\ChatifyServiceProvider',
    ),
  ),
  'nesbot/carbon' => 
  array (
    'providers' => 
    array (
      0 => 'Carbon\\Laravel\\ServiceProvider',
    ),
  ),
  'nunomaduro/collision' => 
  array (
    'providers' => 
    array (
      0 => 'NunoMaduro\\Collision\\Adapters\\Laravel\\CollisionServiceProvider',
    ),
  ),
  'nunomaduro/termwind' => 
  array (
    'providers' => 
    array (
      0 => 'Termwind\\Laravel\\TermwindServiceProvider',
    ),
  ),
  'orangehill/iseed' => 
  array (
    'providers' => 
    array (
      0 => 'Orangehill\\Iseed\\IseedServiceProvider',
    ),
  ),
  'outhebox/blade-flags' => 
  array (
    'providers' => 
    array (
      0 => 'OutheBox\\BladeFlags\\BladeFlagsServiceProvider',
    ),
  ),
  'rawilk/laravel-form-components' => 
  array (
    'providers' => 
    array (
      0 => 'Rawilk\\FormComponents\\FormComponentsServiceProvider',
    ),
    'aliases' => 
    array (
      'FormComponents' => 'Rawilk\\FormComponents\\Facades\\FormComponents',
    ),
  ),
  'rtconner/laravel-tagging' => 
  array (
    'providers' => 
    array (
      0 => 'Conner\\Tagging\\Providers\\TaggingServiceProvider',
    ),
  ),
  'simplesoftwareio/simple-qrcode' => 
  array (
    'providers' => 
    array (
      0 => 'SimpleSoftwareIO\\QrCode\\QrCodeServiceProvider',
    ),
    'aliases' => 
    array (
      'QrCode' => 'SimpleSoftwareIO\\QrCode\\Facades\\QrCode',
    ),
  ),
  'socialiteproviders/manager' => 
  array (
    'providers' => 
    array (
      0 => 'SocialiteProviders\\Manager\\ServiceProvider',
    ),
  ),
  'spatie/laravel-ignition' => 
  array (
    'aliases' => 
    array (
      'Flare' => 'Spatie\\LaravelIgnition\\Facades\\Flare',
    ),
    'providers' => 
    array (
      0 => 'Spatie\\LaravelIgnition\\IgnitionServiceProvider',
    ),
  ),
  'spatie/laravel-medialibrary' => 
  array (
    'providers' => 
    array (
      0 => 'Spatie\\MediaLibrary\\MediaLibraryServiceProvider',
    ),
  ),
  'spatie/laravel-sitemap' => 
  array (
    'providers' => 
    array (
      0 => 'Spatie\\Sitemap\\SitemapServiceProvider',
    ),
  ),
  'srmklive/paypal' => 
  array (
    'aliases' => 
    array (
      'PayPal' => 'Srmklive\\PayPal\\Facades\\PayPal',
    ),
    'providers' => 
    array (
      0 => 'Srmklive\\PayPal\\Providers\\PayPalServiceProvider',
    ),
  ),
  'stevebauman/purify' => 
  array (
    'aliases' => 
    array (
      'Purify' => 'Stevebauman\\Purify\\Facades\\Purify',
    ),
    'providers' => 
    array (
      0 => 'Stevebauman\\Purify\\PurifyServiceProvider',
    ),
  ),
  'unicodeveloper/laravel-paystack' => 
  array (
    'aliases' => 
    array (
      'Paystack' => 'Unicodeveloper\\Paystack\\Facades\\Paystack',
    ),
    'providers' => 
    array (
      0 => 'Unicodeveloper\\Paystack\\PaystackServiceProvider',
    ),
  ),
  'wire-elements/modal' => 
  array (
    'providers' => 
    array (
      0 => 'LivewireUI\\Modal\\LivewireModalServiceProvider',
    ),
  ),
  'wire-elements/spotlight' => 
  array (
    'aliases' => 
    array (
      'Spotlight' => 'LivewireUI\\Spotlight\\SpotlightFacade',
    ),
    'providers' => 
    array (
      0 => 'LivewireUI\\Spotlight\\SpotlightServiceProvider',
    ),
  ),
  'wireui/heroicons' => 
  array (
    'providers' => 
    array (
      0 => 'WireUi\\Heroicons\\HeroiconsServiceProvider',
    ),
  ),
  'wireui/wireui' => 
  array (
    'aliases' => 
    array (
    ),
    'providers' => 
    array (
      0 => 'WireUi\\Providers\\WireUiServiceProvider',
    ),
  ),
);