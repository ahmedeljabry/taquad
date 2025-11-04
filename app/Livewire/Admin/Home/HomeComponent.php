<?php

namespace App\Livewire\Admin\Home;

use App\Models\User;
use Livewire\Component;
use App\Models\Invoice;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;
use App\Models\Message;
use App\Models\TrackerAgent;
use App\Models\TrackerDevice;
use App\Models\TrackerDomain;
use App\Models\TrackerGeoip;
use App\Models\TrackerReferer;
use App\Models\UserWithdrawalHistory;
use Illuminate\Database\Eloquent\Collection;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;

class HomeComponent extends Component
{
    use SEOToolsTrait;

    public Collection $recent_users;
    public Collection $recent_projects;
    public Collection $tracker_map;
    public Collection $tracker_referers;
    public Collection $tracker_browsers;
    public Collection $tracker_platforms;
    public Collection $tracker_devices;

    public $net_income;
    public $income_from_taxes;
    public $income_from_commission;
    public $withdrawn_money;
    public $total_sales;
    public $total_users;
    public $total_messages;
    public $visits_by_countries;
    public $latest_users;
    public $browsers;
    public $os;
    public $devices;

    /**
     * Init component
     *
     * @return void
     */
    public function mount()
    {
     
        // Get recent users
        $this->recent_users = User::latest()
                                        ->select('id', 'avatar_id', 'username', 'created_at', 'status')
                                        ->with('avatar')
                                        ->take(10)
                                        ->get();

        // Recent gigs removed (legacy) — projects-only dashboard

        // Set tracker map
        $this->tracker_map  = TrackerGeoip::whereNotNull('country_code')
                                        ->select('country_code',DB::raw('COUNT(country_code) as count'))
                                        ->groupBy('country_code')
                                        ->orderBy('count', 'desc')
                                        ->get();

        // Set tracker referers
        $this->tracker_referers = TrackerReferer::select('domain_id', DB::raw('COUNT(domain_id) as count'))
                                                ->whereHas('domain')
                                                ->with('domain')
                                                ->groupBy('domain_id')
                                                ->orderBy('count', 'desc')
                                                ->take(8)
                                                ->get();

        // Set tracker browsers
        $this->tracker_browsers = TrackerAgent::whereNotNull('browser')
                                                ->select('browser',DB::raw('COUNT(browser) as count'))
                                                ->groupBy('browser')
                                                ->orderBy('count', 'desc')
                                                ->take(5)
                                                ->get();

        // Platforms
        $this->tracker_platforms = TrackerDevice::whereNotNull('platform')
                                                ->select('platform',DB::raw('COUNT(platform) as count'))
                                                ->groupBy('platform')
                                                ->orderBy('count', 'desc')
                                                ->take(5)
                                                ->get();

        // Devices
        $this->tracker_devices = TrackerDevice::whereNotNull('kind')
                                                ->select('kind',DB::raw('COUNT(kind) as count'))
                                                ->groupBy('kind')
                                                ->orderBy('count', 'desc')
                                                ->take(5)
                                                ->get();

        // Calculate net income (paid invoices)
        $this->net_income = Invoice::where('status', 'paid')->sum('total_amount');

        // Legacy taxes/commission removed; set to 0 or compute if applicable
        $this->income_from_taxes = 0;
        $this->income_from_commission = 0;

        // Caluclate withdrawn money
        $this->withdrawn_money = UserWithdrawalHistory::where('status', 'paid')->sum('amount');

        // Calculate total paid invoices as sales
        $this->total_sales = Invoice::where('status', 'paid')->count();

        // Caluclate total users
        $this->total_users = User::count();

        // Calculate users messages
        $this->total_messages = Message::count();

        // Legacy GigVisit metrics removed; tracker_map already provides geo info

        // Get latest 10 users
        $this->latest_users = User::latest()->take(10)->get();

        // Legacy browser/os/device metrics via GigVisit removed; use Tracker* properties already populated


    }


    /**
     * Render component
     *
     * @return Illuminate\View\View
     */
    #[Layout('components.layouts.admin-app')]
    public function render()
    {
        // Seo
        $this->seo()->setTitle( __('messages.t_dashboard') . " " . settings('general')->separator . " " . settings('general')->title );
        $this->seo()->setDescription( settings('seo')->description );

        return view('livewire.admin.home.home');
    }
    
}
