<?php
namespace App\Livewire\Admin\Projects\Skills\Options;

use Livewire\Component;
use App\Models\Category;
use WireUi\Traits\Actions;
use App\Models\ProjectSkill;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use App\Http\Validators\Admin\Projects\Skills\CreateValidator;
use App\Models\ProjectCategory;

class CreateComponent extends Component
{
    use SEOToolsTrait, WithFileUploads, LivewireAlert, Actions;

    public $name;
    public $category;


    /**
     * Render component
     *
     * @return Illuminate\View\View
     */
    #[Layout('components.layouts.admin-app')]
    public function render()
    {
        // Seo
        $this->seo()->setTitle( setSeoTitle(__('messages.t_create_skills'), true) );
        $this->seo()->setDescription( settings('seo')->description );

        return view('livewire.admin.projects.skills.options.create', [
            'categories' => $this->categories
        ]);
    }


    /**
     * Get categories
     *
     * @return object
     */
    public function getCategoriesProperty()
    {
        return ProjectCategory::orderBy('id', 'asc')->get();
    }


    /**
     * Create new skills
     *
     * @return void
     */
    public function create()
    {
        try {

            // Validate form
            CreateValidator::validate($this);

            // Explode names by new line
            $names = preg_split("/\\r\\n|\\r|\\n/", $this->name);

            // Loop through names
            foreach ($names as $key => $name) {

                // Generate slug
                $slug = generate_slug($name);

                // Create new skill
                ProjectSkill::firstOrCreate(
                    [
                        'name' => $name,
                        'slug' => $slug
                    ],
                    [
                        'uid'         => uid(),
                        'category_id' => $this->category
                    ]
                );
            }

            // Success
            $this->alert(
                'success',
                __('messages.t_success'),
                livewire_alert_params( __('messages.t_toast_operation_success') )
            );

            // Refresh the page
            $this->dispatch('refresh');

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
                livewire_alert_params( $th->getMessage(), 'error' )
            );

        }
    }

}
