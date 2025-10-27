<?php

use Livewire\Livewire;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\SupportWidgetController;

// Update route for livewire
Livewire::setUpdateRoute(function ($handle) {

    // Get uri
    $path = is_localhost() ? basename(base_path()) . "/livewire/update" : "/livewire/update";

    return Route::post($path, $handle);
});

// Tasks
Route::prefix('tasks')->group(function () {

    // Queue
    Route::get('queue', function () {

        Artisan::call('queue:work', ['--stop-when-empty' => true, '--force' => true]);
    });

    // Schedule
    Route::get('schedule', function () {

        Artisan::call('schedule:run');
    });
});


// Support widget
Route::post('support/widget', SupportWidgetController::class)->name('support.widget.store');


// Main (Livewire)
Route::namespace('App\Livewire\Main')->middleware(['restricted'])->group(function () {

    // Home
    Route::namespace('Home')->group(function () {

        // Home
        Route::get('/', HomeComponent::class);
    });

    Route::namespace('Messages')->group(function () {
        Route::get('chat' , MessagesComponent::class);
    });


    // Post
    Route::namespace('Post')->prefix('post')->middleware('auth')->group(function () {

        // Project
        Route::get('project', ProjectComponent::class);
        Route::get('project/preview/{token}', \App\Livewire\Main\Post\PreviewComponent::class)->name('post.project.preview');
    });

    // Explore
    Route::namespace('Explore')->prefix('explore')->group(function () {

        // Projects
        Route::namespace('Projects')->prefix('projects')->group(function () {

            // Browse projects
            Route::get('/', ProjectsComponent::class);

            // Skill
            Route::get('{category_slug}/{skill_slug}', SkillComponent::class);
        });
    });

    // Project
    Route::namespace('Project')->prefix('project')->group(function () {

        // Project
        Route::get('{pid}/{slug}', ProjectComponent::class);
    });

    // Blog
    Route::namespace('Blog')->prefix('blog')->group(function () {

        // Index
        Route::get('/', BlogComponent::class);

        // Article
        Route::get('{slug}', ArticleComponent::class);
    });

    // Sellers
    Route::namespace('Sellers')->prefix('sellers')->group(function () {

        // Index
        Route::get('/', SellersComponent::class);
    });

    // Redirect
    Route::namespace('Redirect')->prefix('redirect')->group(function () {

        // To
        Route::get('/', RedirectComponent::class);
    });

    // Newsletter
    Route::namespace('Newsletter')->prefix('newsletter')->group(function () {

        // Verify
        Route::get('verify', VerifyComponent::class);
    });

    // Account
    Route::namespace('Account')->prefix('account')->middleware('auth')->group(function () {

        // Settings
        Route::namespace('Settings')->group(function () {

            // Index
            Route::get('settings', SettingsComponent::class);
        });

        // Password
        Route::namespace('Password')->group(function () {

            // Index
            Route::get('password', PasswordComponent::class);
        });

        // Profile
        Route::namespace('Profile')->group(function () {

            // Index
            Route::get('profile', ProfileComponent::class);
        });

        // Verification center
        Route::namespace('Verification')->group(function () {

            // Index
            Route::get('verification', VerificationComponent::class);
        });

        // Billing
        Route::namespace('Billing')->prefix('billing')->group(function () {

            // Billing
            Route::get('/', BillingComponent::class);
        });

        // Deposit
        Route::namespace('Deposit')->prefix('deposit')->group(function () {

            // Deposit
            Route::get('/', DepositComponent::class);

            // History
            Route::get('history', HistoryComponent::class);
        });

        // Projects
        Route::namespace('Projects')->prefix('projects')->group(function () {

            // Projects
            Route::get('/', ProjectsComponent::class);

            // Options
            Route::namespace('Options')->group(function () {

                // Checkout
                Route::get('checkout/{id}', CheckoutComponent::class);

                // Milestones
                Route::get('milestones/{id}', MilestonesComponent::class);

                // Edit
                Route::get('edit/{id}', EditComponent::class);
            });
        });

        // Sessions
        Route::namespace('Sessions')->prefix('sessions')->group(function () {

            // All
            Route::get('/', SessionsComponent::class);
        });

        // Submitted offers
        Route::namespace('Offers')->prefix('offers')->group(function () {

            // All
            Route::get('/', OffersComponent::class);
        });
    });

    // Start selling
    Route::namespace('Become')->prefix('start_selling')->group(function () {

        // Become seller
        Route::get('/', SellerComponent::class);
    });

    // Seller dashboard
    Route::namespace('Seller')->prefix('seller')->middleware('seller')->group(function () {

        // Home
        Route::namespace('Home')->prefix('home')->group(function () {

            // Index
            Route::get('/', HomeComponent::class);
        });

        // Portfolio
        Route::namespace('Portfolio')->prefix('portfolio')->group(function () {

            // Index
            Route::get('/', PortfolioComponent::class);

            // Options
            Route::namespace('Options')->group(function () {

                // Create
                Route::get('create', CreateComponent::class);

                // Edit
                Route::get('edit/{id}', EditComponent::class);
            });
        });

        // Reviews
        Route::namespace('Reviews')->prefix('reviews')->group(function () {

            // Index
            Route::get('/', ReviewsComponent::class);
        });

        // Earnings
        Route::namespace('Earnings')->prefix('earnings')->group(function () {

            // Index
            Route::get('/', EarningsComponent::class);
        });

        // Withdrawals
        Route::namespace('Withdrawals')->prefix('withdrawals')->group(function () {

            // Index
            Route::get('/', WithdrawalsComponent::class);

            // Settings
            Route::get('settings', SettingsComponent::class);

            // Create
            Route::get('create', CreateComponent::class);
        });

        // Projects
        Route::namespace('Projects')->prefix('projects')->group(function () {

            // Index
            Route::get('/', ProjectsComponent::class);

            // Milestones
            Route::namespace('Milestones')->prefix('milestones')->group(function () {

                // List
                Route::get('{id}', MilestonesComponent::class);
            });

            // Bid
            Route::namespace('Bids')->prefix('bids')->group(function () {

                // List
                Route::get('/', BidsComponent::class);

                // Options
                Route::namespace('Options')->group(function () {

                    // Checkout
                    Route::get('checkout/{id}', CheckoutComponent::class);

                    // Edit
                    Route::get('edit/{id}', EditComponent::class);
                });
            });
        });

        // Offers
        Route::namespace('Offers')->prefix('offers')->group(function () {

            // All
            Route::get('/', OffersComponent::class);
        });
    });

    // Help
    Route::namespace('Help')->prefix('help')->group(function () {

        // Contact
        Route::namespace('Contact')->group(function () {

            // Index
            Route::get('contact', ContactComponent::class);
        });
    });

    // Profile
    Route::namespace('Profile')->prefix('profile')->group(function () {

        // Username
        Route::get('{username}', ProfileComponent::class);

        // Portfolio list
        Route::get('{username}/portfolio', PortfolioComponent::class);

        // Get project
        Route::get('{username}/portfolio/{slug}', ProjectComponent::class);
    });

    // Hire
    Route::namespace('Hire')->prefix('hire')->group(function () {

        // skill
        Route::get('{keyword}', HireComponent::class);
    });

    // Messages
    Route::namespace('Messages')->prefix('messages')->middleware('auth')->group(function () {

        // Index
        Route::get('/', MessagesComponent::class);

        // New
        Route::get('new/{username}/{project_id?}', NewComponent::class);

        // Conversation
        Route::get('{conversationId}', ConversationComponent::class);
    });

    // Search
    Route::namespace('Search')->prefix('search')->group(function () {

        // Keyword
        Route::get('/', SearchComponent::class);
    });

    // Page
    Route::namespace('Page')->prefix('page')->group(function () {

        // Index
        Route::get('{slug}', PageComponent::class);
    });

});

// Authentication
Route::namespace('App\Livewire\Main')->prefix('auth')->group(function () {

    // Authentication
    Route::namespace('Auth')->middleware('guest')->group(function () {

        // Register
        Route::get('register', RegisterComponent::class);

        // Login
        Route::get('login', LoginComponent::class)->name('login');

        // Verify
        Route::get('verify', VerifyComponent::class);

        // Request verification
        Route::get('request', RequestComponent::class);

        // Password
        Route::namespace('Password')->prefix('password')->group(function () {

            // Reset
            Route::get('reset', ResetComponent::class);

            // Update
            Route::get('update', UpdateComponent::class);
        });

        // Social media
        Route::namespace('Social')->group(function () {

            // Github
            Route::namespace('Github')->prefix('github')->group(function () {

                // Redirect
                Route::get('/', RedirectComponent::class);

                // Callback
                Route::get('callback', CallbackComponent::class);
            });

            // Linkedin
            Route::namespace('Linkedin')->prefix('linkedin')->group(function () {

                // Redirect
                Route::get('/', RedirectComponent::class);

                // Callback
                Route::get('callback', CallbackComponent::class);
            });

            // Google
            Route::namespace('Google')->prefix('google')->group(function () {

                // Redirect
                Route::get('/', RedirectComponent::class);

                // Callback
                Route::get('callback', CallbackComponent::class);
            });

            // Facebook
            Route::namespace('Facebook')->prefix('facebook')->group(function () {

                // Redirect
                Route::get('/', RedirectComponent::class);

                // Callback
                Route::get('callback', CallbackComponent::class);
            });

            // Twitter
            Route::namespace('Twitter')->prefix('twitter')->group(function () {

                // Redirect
                Route::get('/', RedirectComponent::class);

                // Callback
                Route::get('callback', CallbackComponent::class);
            });
        });
    });

    // Logout
    Route::namespace('Auth')->middleware('auth')->group(function () {

        // Logout
        Route::get('logout', LogoutComponent::class);
    });
});

// Uploads
Route::namespace('App\Http\Controllers\Uploads')->prefix('uploads')->group(function () {

    // Restrictions appeals files
    Route::namespace('Restrictions')->prefix('restrictions')->middleware('auth:admin')->group(function () {

        // File
        Route::get('{uid}', 'FileController@download');
    });

    // Documents
    Route::namespace('Documents')->prefix('documents')->group(function () {

        // Doc
        Route::get('{uid}', 'DocumentController@download');
    });

    // Verifications
    Route::namespace('Verifications')->prefix('verifications')->group(function () {

        // File
        Route::get('{id}/{type}/{fileId}', 'VerificationsController@download');
    });

    // Offers
    Route::namespace('Offers')->prefix('offers')->middleware('auth')->group(function () {

        // File
        Route::get('{file}', 'OffersController@attachment');

        // Work
        Route::get('work/{file}', 'OffersController@work');
    });
});

// Callback routes for payment gateways
Route::namespace('App\Http\Controllers\Callback')->prefix('callback')->group(function () {

    // Asaas
    Route::post('asaas', 'AsaasController@callback');

    // Campay
    Route::get('campay/success', 'CampayController@success');
    Route::get('campay/failed', 'CampayController@failed');

    // Cashfree
    Route::get('cashfree', 'CashfreeController@callback');
    Route::post('cashfree', 'CashfreeController@webhook');

    // cPay
    Route::get('cpay/success', 'CpayController@success');
    Route::get('cpay/failed', 'CpayController@failed');

    // Duitku
    Route::get('duitku', 'DuitkuController@callback');

    // Ecpay
    Route::post('ecpay', 'EcpayController@callback');

    // Epoint.az
    Route::get('epoint/success', 'EpointController@success');
    Route::get('epoint/failed', 'EpointController@failed');

    // FastPay
    Route::get('fastpay/success', 'FastpayController@success');
    Route::get('fastpay/failed', 'FastpayController@failed');
    Route::get('fastpay/cancel', 'FastpayController@cancel');

    // Flutterwave
    Route::get('flutterwave', 'FlutterwaveController@callback');

    // Freekassa
    Route::post('freekassa', 'FreekassaController@webhook');
    Route::get('freekassa/success', 'FreekassaController@success');
    Route::get('freekassa/failed', 'FreekassaController@failed');

    // Genie business
    Route::get('genie-business', 'GenieController@callback');
    Route::post('genie-business', 'GenieController@webhook');

    // Iyzico
    Route::post('iyzico', 'IyzicoController@callback');

    // Jazzcash
    Route::post('jazzcash', 'JazzcashController@callback');

    // Mercadopago
    Route::get('mercadopago/success', 'MercadopagoController@success');
    Route::get('mercadopago/pending', 'MercadopagoController@pending');
    Route::get('mercadopago/failed', 'MercadopagoController@failed');

    // Mollie
    Route::get('mollie', 'MollieController@callback');
    Route::post('mollie', 'MollieController@webhook');

    // Nowpayments.io
    Route::post('nowpayments/ipn', 'NowpaymentsController@ipn');
    Route::get('nowpayments/success', 'NowpaymentsController@success');
    Route::get('nowpayments/cancel', 'NowpaymentsController@cancel');

    // Paymob
    Route::get('paymob', 'PaymobController@callback');

    // Paymob Pakistan
    Route::get('paymob-pk', 'PaymobPkController@callback');

    // PayPal
    Route::get('paypal', 'PaypalController@callback');

    // Paystack
    Route::get('paystack', 'PaystackController@callback');
    Route::post('paystack', 'PaystackController@webhook');

    // Paytabs
    Route::post('paytabs', 'PaytabsController@callback');

    // PayTR
    Route::get('paytr/success', 'PaytrController@success');
    Route::get('paytr/failed', 'PaytrController@failed');
    Route::post('paytr', 'PaytrController@webhook');

    // Razorpay
    Route::get('razorpay', 'RazorpayController@callback');

    // Robokassa
    Route::post('robokassa', 'RobokassaController@callback');

    // Stripe
    Route::get('stripe', 'StripeController@callback');

    // Vnpay
    Route::get('vnpay', 'VnpayController@callback');

    // Xendit
    Route::get('xendit/success', 'XenditController@success');
    Route::get('xendit/failed', 'XenditController@failed');
    Route::post('xendit', 'XenditController@webhook');

    // Youcanpay
    Route::get('youcanpay', 'YoucanpayController@callback');
});


// Restrictions Removal Center
Route::namespace('App\Livewire\Restricted')->middleware('auth')->prefix('restricted')->group(function () {

    // Index
    Route::get('/', IndexComponent::class);
});
