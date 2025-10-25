<?php
namespace App\Http\Controllers\Callback;

use App\Models\User;
use App\Models\ProjectPlan;
use Illuminate\Http\Request;
use App\Models\DepositTransaction;
use App\Http\Controllers\Controller;
use App\Models\AutomaticPaymentGateway;
use App\Jobs\Main\Post\Project\SendAlertToFreelancers;

class AsaasController extends Controller
{
    public $gateway = "asaas";
    public $status  = "paid";
    public $settings;

    /**
     * Payment gateway callback
     *
     * @param Request $request
     * @return mixed
     */
    public function callback(Request $request)
    {
        try {

            // Get payment gateway settings
            $settings       = AutomaticPaymentGateway::where('slug', $this->gateway)
                                                     ->where('is_active', true)
                                                     ->firstOrFail();

            // Set settings
            $this->settings = $settings;

            //


        } catch (\Throwable $th) {
            //throw $th;
        }
    }


    /**
     * Deposit funds into user's account
     *
     * @param int $user_id
     * @param mixed $amount
     * @param string $payment_id
     * @return void
     */
    private function deposit($user_id, $amount, $payment_id)
    {
        try {

            // Set amount
            $amount                  = convertToNumber($amount);

            // Calculate fee from this amount
            $fee                     = convertToNumber($this->fee('deposit', $amount));

            // Make transaction
            $deposit                 = new DepositTransaction();
            $deposit->user_id        = $user_id;
            $deposit->transaction_id = $payment_id;
            $deposit->payment_method = $this->gateway;
            $deposit->amount_total   = $amount;
            $deposit->amount_fee     = $fee;
            $deposit->amount_net     = $amount - $fee;
            $deposit->currency       = $this->settings->currency;
            $deposit->exchange_rate  = $this->settings->exchange_rate;
            $deposit->status         = $this->status;
            $deposit->ip_address     = request()->ip();
            $deposit->save();

            // Get user
            $user                    = User::where('id', $user_id)->firstOrFail();

            // Add funds
            $user->balance_available = convertToNumber($user->balance_available) + convertToNumber($deposit->amount_net);
            $user->save();

            // Send  a notification
            $this->notification('deposit', $user);

        } catch (\Throwable $th) {

            // Error
            throw $th;

        }
    }



    /**
     * Handle project promoting checkout
     *
     * @param object $subscription
     * @return void
     */
    public function project($subscription)
    {
        try {

            // Get project
            $project              = $subscription->project;

            // Get projects settings
            $settings             = settings('projects');

            // Update subscription
            $subscription->status = 'paid';
            $subscription->save();

            // Check if project has featured plan
            if ($project->is_featured) {

                // Get featured plan
                $featured_plan = ProjectPlan::whereType('featured')->first();

            } else {

                // No plan selected
                $featured_plan = null;

            }

            // Check if project has urgent plan
            if ($project->is_urgent) {

                // Get urgent plan
                $urgent_plan = ProjectPlan::whereType('urgent')->first();

            } else {

                // No plan selected
                $urgent_plan = null;

            }

            // Check if project has alert plan
            if ($project->is_alert) {

                // Get alert plan
                $alert_plan = ProjectPlan::whereType('alert')->first();

            } else {

                // No plan selected
                $alert_plan = null;

            }

            // Check if project has highlighted plan
            if ($project->is_highlighted) {

                // Get highlighted plan
                $highlighted_plan = ProjectPlan::whereType('highlight')->first();

            } else {

                // No plan selected
                $highlighted_plan = null;

            }

            // We need to send notifications to freelancer if alert plans was selected for this project
            if ($alert_plan) {

                // Run a job for this in background
                SendAlertToFreelancers::dispatch($project);

            }

            // Update project
            $project->status                = $settings->auto_approve_projects ? 'active' : 'pending_approval';
            $project->expiry_date_featured  = $featured_plan ? now()->addDays($featured_plan->days) : null;
            $project->expiry_date_urgent    = $urgent_plan ? now()->addDays($urgent_plan->days) : null;
            $project->expiry_date_highlight = $highlighted_plan ? now()->addDays($highlighted_plan->days) : null;
            $project->save();

        } catch (\Throwable $th) {

            // Error
            throw $th;

        }
    }


    /**
     * Handle bid promoting checkout
     *
     * @param object $subscription
     * @return void
     */
    public function bid($subscription)
    {
        try {

            // Get bid
            $bid                          = $subscription->bid;

            // Get projects settings
            $settings                     = settings('projects');

            // Update subscription
            $subscription->status         = 'paid';
            $subscription->save();

            // Update bid
            $bid->status                  = $settings->auto_approve_bids ? 'active' : 'pending_approval';
            $bid->save();

        } catch (\Throwable $th) {

            // Error
            throw $th;

        }
    }


    /**
     * Calculate fee value
     *
     * @param string $type
     * @param mixed $amount
     * @return mixed
     */
    private function fee($type, $amount = null)
    {
        try {

            // Set amount for deposit
            $amount = convertToNumber($amount) * $this->settings?->exchange_rate / settings('currency')->exchange_rate;

            // Remove long decimal
            $amount = convertToNumber( number_format($amount, 2, '.', '') );

            // Check fee type
            switch ($type) {

                // Deposit
                case 'deposit':

                    // Get deposit fixed fee
                    if (isset($this->settings->fixed_fee['deposit'])) {

                        // Set fixed fee
                        $fee_fixed = convertToNumber($this->settings->fixed_fee['deposit']);

                    } else {

                        // No fixed fee
                        $fee_fixed = 0;

                    }

                    // Get deposit percentage fee
                    if (isset($this->settings->percentage_fee['deposit'])) {

                        // Set percentage fee
                        $fee_percentage = convertToNumber($this->settings->percentage_fee['deposit']);

                    } else {

                        // No percentage fee
                        $fee_percentage = 0;

                    }

                    // Calculate percentage of this amount
                    $fee_percentage_amount = $this->exchange( $fee_percentage * $amount / 100, $this->settings->exchange_rate );

                    // Calculate exchange rate of this fixed fee
                    $fee_fixed_exchange    = $this->exchange( $fee_fixed,  $this->settings->exchange_rate);

                    // Calculate fee value and visible text
                    if ($fee_fixed > 0 && $fee_percentage > 0) {

                        // Calculate fee value
                        $fee_value = convertToNumber($fee_percentage_amount) + convertToNumber($fee_fixed_exchange);

                    } else if (!$fee_fixed && $fee_percentage > 0) {

                        // Calculate fee value
                        $fee_value = convertToNumber($fee_percentage_amount);

                    } else if ($fee_fixed > 0 && !$fee_percentage) {

                        // Calculate fee value
                        $fee_value = convertToNumber($fee_fixed_exchange);

                    } else if (!$fee_percentage && !$fee_fixed) {

                        // Calculate fee value
                        $fee_value = 0;

                    }

                    // Return fee value
                    return number_format($fee_value, 2, '.', '');

                break;

                // Projects
                case 'projects':

                    // Get projects fixed fee
                    if (isset($this->settings->fixed_fee['projects'])) {

                        // Set fixed fee
                        $fee_fixed = convertToNumber($this->settings->fixed_fee['projects']);

                    } else {

                        // No fixed fee
                        $fee_fixed = 0;

                    }

                    // Get projects percentage fee
                    if (isset($this->settings->percentage_fee['projects'])) {

                        // Set percentage fee
                        $fee_percentage = convertToNumber($this->settings->percentage_fee['projects']);

                    } else {

                        // No percentage fee
                        $fee_percentage = 0;

                    }

                    // Calculate percentage of this amount
                    $fee_percentage_amount = $this->exchange( $fee_percentage * $amount / 100, $this->settings->exchange_rate );

                    // Calculate exchange rate of this fixed fee
                    $fee_fixed_exchange    = $this->exchange( $fee_fixed,  $this->settings->exchange_rate);

                    // Calculate fee value and visible text
                    if ($fee_fixed > 0 && $fee_percentage > 0) {

                        // Calculate fee value
                        $fee_value = convertToNumber($fee_percentage_amount) + convertToNumber($fee_fixed_exchange);

                    } else if (!$fee_fixed && $fee_percentage > 0) {

                        // Calculate fee value
                        $fee_value = convertToNumber($fee_percentage_amount);

                    } else if ($fee_fixed > 0 && !$fee_percentage) {

                        // Calculate fee value
                        $fee_value = convertToNumber($fee_fixed_exchange);

                    } else if (!$fee_percentage && !$fee_fixed) {

                        // Calculate fee value
                        $fee_value = 0;

                    }

                    // Return fee value
                    return $fee_value;

                break;

                // Bids
                case 'bids':

                    // Get bids fixed fee
                    if (isset($this->settings->fixed_fee['bids'])) {

                        // Set fixed fee
                        $fee_fixed = convertToNumber($this->settings->fixed_fee['bids']);

                    } else {

                        // No fixed fee
                        $fee_fixed = 0;

                    }

                    // Get bids percentage fee
                    if (isset($this->settings->percentage_fee['bids'])) {

                        // Set percentage fee
                        $fee_percentage = convertToNumber($this->settings->percentage_fee['bids']);

                    } else {

                        // No percentage fee
                        $fee_percentage = 0;

                    }

                    // Calculate percentage of this amount
                    $fee_percentage_amount = $this->exchange( $fee_percentage * $amount / 100, $this->settings->exchange_rate );

                    // Calculate exchange rate of this fixed fee
                    $fee_fixed_exchange    = $this->exchange( $fee_fixed,  $this->settings->exchange_rate);

                    // Calculate fee value and visible text
                    if ($fee_fixed > 0 && $fee_percentage > 0) {

                        // Calculate fee value
                        $fee_value = convertToNumber($fee_percentage_amount) + convertToNumber($fee_fixed_exchange);

                    } else if (!$fee_fixed && $fee_percentage > 0) {

                        // Calculate fee value
                        $fee_value = convertToNumber($fee_percentage_amount);

                    } else if ($fee_fixed > 0 && !$fee_percentage) {

                        // Calculate fee value
                        $fee_value = convertToNumber($fee_fixed_exchange);

                    } else if (!$fee_percentage && !$fee_fixed) {

                        // Calculate fee value
                        $fee_value = 0;

                    }

                    // Return fee value
                    return $fee_value;

                break;

            }

        } catch (\Throwable $th) {

            // Something went wrong
            return 0;

        }
    }


    /**
     * Calculate exchange rate
     *
     * @param mixed $amount
     * @param mixed $exchange_rate
     * @param boolean $formatted
     * @param string $currency
     * @return mixed
     */
    private function exchange($amount, $exchange_rate, $formatted = false, $currency = null)
    {
        try {

            // Convert amount to number
            $amount                = convertToNumber($amount);

            // Get currency settings
            $currency_settings     = settings('currency');

            // Get default currency exchange rate
            $default_exchange_rate = convertToNumber($currency_settings->exchange_rate);

            // Get exchanged amount
            $exchanged_amount      = convertToNumber( $amount *  $default_exchange_rate / $exchange_rate );

            // Check if we have to return a formatted value
            if ($formatted) {

                return money( $exchanged_amount, $currency, true )->format();

            }

            // Return max deposit
            return convertToNumber(number_format( $exchanged_amount, 2, '.', '' ));

        } catch (\Throwable $th) {

            // Something went wrong
            return $amount;

        }
    }


    /**
     * Send a notification to user
     *
     * @param string $type
     * @param object $user
     * @return void
     */
    private function notification($type, $user)
    {
        try {

            // Check notification type
            switch ($type) {

                // Deposit funds
                case 'deposit':



                break;


                // Project payment
                case 'project':



                break;

                // Bid payment
                case 'bid':



                break;

            }

        } catch (\Throwable $th) {

            // Something went wrong
            return;

        }
    }
}
