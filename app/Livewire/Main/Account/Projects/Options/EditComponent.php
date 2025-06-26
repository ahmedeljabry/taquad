<?php
namespace App\Livewire\Main\Account\Projects\Options;

use App\Models\Project;
use Livewire\Component;
use App\Models\Category;
use WireUi\Traits\Actions;
use App\Models\ProjectPlan;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use App\Models\ProjectSkill;
use App\Models\Childcategory;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use App\Models\ProjectSubscription;
use App\Models\ProjectRequiredSkill;
use Illuminate\Database\Eloquent\Collection;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use App\Http\Validators\Main\Account\Projects\EditValidator;

class EditComponent extends Component
{
    use SEOToolsTrait, LivewireAlert, Actions;
    
    public Project $project;
    public $title;
    public $description;
    public $category;
    public $subcategory;
    public $childcategory;
    public $salary_type;
    public $min_price;
    public $max_price;
    public $currency_symbol;
    public $required_skills = [];
    public $selected_plans  = [];

    public $subcategories   = [];
    public $childcategories = [];
    public $skills          = [];

    #[Locked]
    public $promoting_total = 0;

    /**
     * Init component
     *
     * @param string $id
     * @return void
     */
    public function mount($id)
    {
        // Check projects enabled
        if (!settings('projects')->is_enabled) {
            return redirect('/');
        }

        // Get project
        $project         = Project::where('uid', $id)
                                    ->where('user_id', auth()->id())
                                    ->whereIn('status', ['pending_approval', 'pending_payment', 'active', 'rejected'])
                                    ->with(['skills.skill'])
                                    ->firstOrFail();

        // Set project
        $this->project   = $project;

        // Get project required skills
        $required_skills = $project->skills;

        // Loop through required skills
        foreach ($required_skills as $skill) {
            if ($skill?->skill) {
                
                // Add selected skill
                array_push($this->required_skills, $skill->skill?->id);

            } 
        }

        // Get currency settings
        $currency        = settings('currency');

        // Get currency symbol
        $this->currency_symbol = config('money.currencies.' . mb_strtoupper($currency->code))['symbol'];

        // Fill form
        $this->fill([
            'title'         => $project->title,
            'description'   => $project->description,
            'category'      => $project->category_id,
            'subcategory'   => $project->subcategory_id,
            'childcategory' => $project->childcategory_id,
            'min_price'     => $project->budget_min,
            'max_price'     => $project->budget_max,
            'salary_type'   => $project->budget_type
        ]);

        // Set subcategories
        $this->subcategories = Subcategory::where('parent_id', $project->category_id)
                                            ->select('id', 'uid', 'created_at')
                                            ->withTranslation()
                                            ->latest()
                                            ->get();

        // Update skills
        $this->skills        = ProjectSkill::where('category_id', $project->category_id)->latest('name')->get();

        // Set childcategories
        $this->childcategories = Childcategory::where('subcategory_id', $project->subcategory_id)
                                                ->where('parent_id', $project->category_id)
                                                ->select('id', 'uid', 'created_at')
                                                ->withTranslation()
                                                ->latest()
                                                ->get();
                                                
    }


    /**
     * Render component
     *
     * @return Illuminate\View\View
     */
    #[Layout('components.layouts.main-app')]
    public function render()
    {
        // SEO
        $separator   = settings('general')->separator;
        $title       = __('messages.t_edit_project') . " $separator " . settings('general')->title;
        $description = settings('seo')->description;
        $ogimage     = src( settings('seo')->ogimage );

        $this->seo()->setTitle( $title );
        $this->seo()->setDescription( $description );
        $this->seo()->setCanonical( url()->current() );
        $this->seo()->opengraph()->setTitle( $title );
        $this->seo()->opengraph()->setDescription( $description );
        $this->seo()->opengraph()->setUrl( url()->current() );
        $this->seo()->opengraph()->setType('website');
        $this->seo()->opengraph()->addImage( $ogimage );
        $this->seo()->twitter()->setImage( $ogimage );
        $this->seo()->twitter()->setUrl( url()->current() );
        $this->seo()->twitter()->setSite( "@" . settings('seo')->twitter_username );
        $this->seo()->twitter()->addValue('card', 'summary_large_image');
        $this->seo()->metatags()->addMeta('fb:page_id', settings('seo')->facebook_page_id, 'property');
        $this->seo()->metatags()->addMeta('fb:app_id', settings('seo')->facebook_app_id, 'property');
        $this->seo()->metatags()->addMeta('robots', 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1', 'name');
        $this->seo()->jsonLd()->setTitle( $title );
        $this->seo()->jsonLd()->setDescription( $description );
        $this->seo()->jsonLd()->setUrl( url()->current() );
        $this->seo()->jsonLd()->setType('WebSite');

        return view('livewire.main.account.projects.options.edit', [
            'categories' => $this->categories,
            'plans'      => $this->plans
        ]);
    }


    /**
     * Get projects categories
     *
     * @return object
     */
    public function getCategoriesProperty()
    {
        return Category::select('id', 'uid', 'created_at')->withTranslation()->latest()->get();
    }


    /**
     * Get plans
     *
     * @return Collection
     */
    public function getPlansProperty() : Collection
    {
        return ProjectPlan::orderBy('title', 'asc')
                                    ->where('is_active', true)
                                    ->select(
                                        'title',
                                        'id', 
                                        'description',
                                        'price',
                                        'days',
                                        'type',
                                        'badge_text_color as text_color',
                                        'badge_bg_color as bg_color'
                                    )
                                    ->get();
    }


    /**
     * Set subcategories
     *
     * @param int $id
     * @return void
     */
    public function updatedCategory($id) : void
    {
        // Set subcategories
        $this->subcategories = Subcategory::where('parent_id', $id)
                                            ->select('id', 'uid', 'created_at')
                                            ->withTranslation()
                                            ->latest()
                                            ->get();

        // Update skills
        $this->skills        = ProjectSkill::where('category_id', $id)->latest('name')->get();
    }


    /**
     * Set childcategories
     *
     * @param int $id
     * @return void
     */
    public function updatedSubcategory($id) : void
    {
        // Set childcategories
        $this->childcategories = Childcategory::where('subcategory_id', $id)
                                                ->where('parent_id', $this->category)
                                                ->select('id', 'uid', 'created_at')
                                                ->withTranslation()
                                                ->latest()
                                                ->get();
    }


    /**
     * Select new skill
     *
     * @param string $id
     * @return void
     */
    public function addSkill($id) : void
    {
        try {
            
            // Check maximum skills allowed
            if (count($this->required_skills) >= (int)settings('projects')->max_skills) {
               
                // Maw allowed skills reached
                $this->alert(
                    'error', 
                    __('messages.t_error'), 
                    livewire_alert_params( __('messages.t_max_allowed_skills_reached'), 'error' )
                );

                return;

            }

            // Get the skill
            $skill = ProjectSkill::where('uid', $id)
                                ->where('category_id', $this->category)
                                ->first();

            // Check if skill exists
            if (!$skill) {
                
                // Error
                $this->alert(
                    'error', 
                    __('messages.t_error'), 
                    livewire_alert_params( __('messages.t_selected_skill_unavailable'), 'error' )
                );

                return;

            }

            // Let's check if skill already selected
            if (in_array($skill->id, $this->required_skills)) {
                
                // Already exists, remove it
                if (($key = array_search($skill->id, $this->required_skills)) !== false) {
                    unset($this->required_skills[$key]);
                }

            } else {

                // Add it to list of selected skills
                array_push($this->required_skills, $skill->id);

            }

            // Refresh array
            $this->required_skills = array_values($this->required_skills);

        } catch (\Throwable $th) {
            
            // Something went wrong
            $this->alert(
                'error', 
                __('messages.t_error'), 
                livewire_alert_params( __('messages.t_toast_something_went_wrong'), 'error' )
            );

        }
    }


    /**
     * Select a plan
     *
     * @param string $id
     * @return void
     */
    public function addPlan($id) : void
    {
        try {

            // Get the plan
            $plan = ProjectPlan::where('id', $id)->first();

            // Check if skill exists
            if (!$plan) {
                
                // Error
                $this->alert(
                    'error', 
                    __('messages.t_error'), 
                    livewire_alert_params( __('messages.t_selected_plan_unavailable'), 'error' )
                );

                return;

            }

            // Let's check if plan already selected
            if (in_array($plan->id, $this->selected_plans)) {
                
                // Already exists, remove it
                if (($key = array_search($plan->id, $this->selected_plans)) !== false) {

                    // Remove it
                    unset($this->selected_plans[$key]);

                    // Update total price
                    $this->promoting_total = convertToNumber($this->promoting_total) - convertToNumber($plan->price);

                }

            } else {

                // Add it to list of selected plans
                array_push($this->selected_plans, $plan->id);

                // Update total price
                $this->promoting_total = convertToNumber($this->promoting_total) + convertToNumber($plan->price);

            }

            // Refresh array
            $this->selected_plans = array_values($this->selected_plans);

        } catch (\Throwable $th) {
            
            // Something went wrong
            $this->alert(
                'error', 
                __('messages.t_error'), 
                livewire_alert_params( __('messages.t_toast_something_went_wrong'), 'error' )
            );

        }
    }


    /**
     * Update project
     *
     */
    public function update()
    {
        try {

            // Get projects settings
            $settings = settings('projects');

            // Get user
            $user     = auth()->user();

            // First let's check if projects section is enabled
            if (!$settings->is_enabled) {

                // Redirect home
                return redirect('/');
                
            }

            // Max price must be greater than min price
            if (convertToNumber($this->min_price) >= convertToNumber($this->max_price)) {
                
                // Error
                $this->alert(
                    'error', 
                    __('messages.t_error'), 
                    livewire_alert_params( __('messages.t_max_project_price_must_be_greater'), 'error' )
                );

                return;

            }

            // Check if user didn't select salary type
            if (!in_array($this->salary_type, ['fixed', 'hourly'])) {
                
                // Error
                $this->alert(
                    'error', 
                    __('messages.t_error'), 
                    livewire_alert_params( __('messages.t_pls_choose_how_do_u_want_to_pay_salary'), 'error' )
                );

                return;

            }

            // Validate form
            EditValidator::validate($this);

            // Get skills
            $skills                          = $this->required_skills;

            // Get title
            $title                           = clean($this->title);

            // Generate project slug
            $slug                            = substr( generate_slug($this->title), 0, 160 );

            // Get project status
            $status                          = $this->status($settings);

            // Get premium options
            $premium                         = $this->premium($settings);
            
            // Create new project
            $this->project->title            = $title;
            $this->project->description      = clean($this->description);
            $this->project->slug             = $slug;
            $this->project->category_id      = $this->category;
            $this->project->subcategory_id   = $this->subcategory;
            $this->project->childcategory_id = $this->childcategory;
            $this->project->budget_min       = $this->min_price;
            $this->project->budget_max       = $this->max_price;
            $this->project->budget_type      = $this->salary_type;
            $this->project->is_featured      = $premium['is_featured'];
            $this->project->is_urgent        = $premium['is_urgent'];
            $this->project->is_highlighted   = $premium['is_highlighted'];
            $this->project->is_alert         = $premium['is_alert'];
            $this->project->status           = $status;
            $this->project->save();

            // Create a subscription if user selected premium posting
            if ($settings->is_premium_posting && is_array($this->selected_plans) && count($this->selected_plans)) {
                
                // Delete old subscription
                ProjectSubscription::where('project_id', $this->project->id)->delete();

                // Save subscription
                $subscription             = new ProjectSubscription();
                $subscription->uid        = Str::uuid()->toString();
                $subscription->project_id = $this->project->id;
                $subscription->total      = $premium['total'];
                $subscription->save();

            } else {

                // No subscription
                $subscription = false;

            }

            // Delete old required skills
            ProjectRequiredSkill::where('project_id', $this->project->id)->delete();

            // Loop through skills
            foreach ($skills as $key => $s) {
                
                // Save skill
                $skill             = new ProjectRequiredSkill();
                $skill->project_id = $this->project->id;
                $skill->skill_id   = $s;
                $skill->save();

            }

            // Check if payment required, redirect to payment link
            if ($subscription) {
                
                // Flash a success message
                $this->alert(
                    'success', 
                    __('messages.t_success'), 
                    livewire_alert_params( __('messages.t_ur_project_updated_and_pending_payment') )
                );

                // Redirect
                return redirect('/account/projects/checkout/' . $subscription->uid);

            }

            // Flash a message
            $this->alert(
                'success', 
                __('messages.t_success'), 
                livewire_alert_params( $status === 'pending_approval' ? __('messages.t_ur_project_updated_and_pending_approval') : __('messages.t_ur_project_updated_successfully') )
            );

            // Redirect
            return redirect('/account/projects');

        } catch (\Illuminate\Validation\ValidationException $e) {
            
            // Validation error
            $this->alert(
                'error', 
                __('messages.t_error'), 
                livewire_alert_params( __('messages.t_toast_form_validation_error'), 'error' )
            );

            throw $e;

        } catch (\Throwable $th) {

            // Error
            $this->alert(
                'error', 
                __('messages.t_error'), 
                livewire_alert_params( __('messages.t_toast_something_went_wrong'), 'error' )
            );

        }
    }


    /**
     * Get project status
     *
     * @param object $settings
     * @return string
     */
    private function status($settings)
    {
        // Get selected plans
        $selected_plans = $this->selected_plans;

        // Check if has plans
        if (is_array($selected_plans) && count($selected_plans)) {
            
            // Pending payment
            return 'pending_payment';

        } else {

            // Check if auto approval enabled
            if ($settings->auto_approve_projects) {
                
                // Active
                return 'active';

            }

            // Pending approval
            return 'pending_approval';

        }
    }


    /**
     * Get premium options
     *
     * @param object $settings
     * @return array
     */
    private function premium($settings)
    {
        // Check if premium posting enabled
        if ($settings->is_premium_posting) {
            
            // Get selected plans
            $selected_plans = $this->selected_plans;

            // Check if has any plan
            if (is_array($selected_plans) && count($selected_plans)) {
                
                // Get plans
                $plans = ProjectPlan::whereIn('id', $selected_plans)->whereIsActive(true)->get();

                // Check if these plans exist
                if ($plans->count()) {
                    
                    // Convert plans to array
                    $plans_to_array = $plans->toArray();

                    // Check if featured plan select
                    if (array_search('featured', array_column($plans_to_array, 'type')) !== false) {
                        $featured = $plans_to_array[array_search('featured', array_column($plans_to_array, 'type'))];
                    } else {
                        $featured = false;
                    }

                    // Check if urgent plan select
                    if (array_search('urgent', array_column($plans_to_array, 'type')) !== false) {
                        $urgent = $plans_to_array[array_search('urgent', array_column($plans_to_array, 'type'))];
                    } else {
                        $urgent = false;
                    }

                    // Check if highlighted plan select
                    if (array_search('highlight', array_column($plans_to_array, 'type')) !== false) {
                        $highlighted = $plans_to_array[array_search('highlight', array_column($plans_to_array, 'type'))];
                    } else {
                        $highlighted = false;
                    }

                    // Check if alert plan select
                    if (array_search('alert', array_column($plans_to_array, 'type')) !== false) {
                        $alert = $plans_to_array[array_search('alert', array_column($plans_to_array, 'type'))];
                    } else {
                        $alert = false;
                    }

                    // Calculate total price
                    $total = array_sum(array_column($plans_to_array, 'price'));
                    
                    // Return premium options
                    return [
                        'is_featured'    => $featured ? true : false,
                        'is_urgent'      => $urgent ? true : false,
                        'is_highlighted' => $highlighted ? true : false,
                        'is_alert'       => $alert ? true : false,
                        'total'          => $total
                    ];

                } else {

                    // No plan found
                    return [
                        'is_featured'    => false,
                        'is_urgent'      => false,
                        'is_highlighted' => false,
                        'is_alert'       => false,
                        'total'          => 0
                    ];

                }

            } else {

                // No plan selected
                return [
                    'is_featured'    => in_array($this->project->status, ['pending_approval', 'active']) ? $this->project->is_featured : false,
                    'is_urgent'      => in_array($this->project->status, ['pending_approval', 'active']) ? $this->project->is_urgent : false,
                    'is_highlighted' => in_array($this->project->status, ['pending_approval', 'active']) ? $this->project->is_highlighted : false,
                    'is_alert'       => in_array($this->project->status, ['pending_approval', 'active']) ? $this->project->is_alert : false,
                    'total'          => 0
                ];

            }

        } else {
            
            // Premium posting not enabled
            return [
                'is_featured'    => false,
                'is_urgent'      => false,
                'is_highlighted' => false,
                'is_alert'       => false,
                'total'          => 0
            ];

        }
        
    }

}
