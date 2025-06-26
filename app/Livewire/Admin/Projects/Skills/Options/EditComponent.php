<?php
namespace App\Livewire\Admin\Projects\Skills\Options;

use Livewire\Component;
use App\Models\Category;
use WireUi\Traits\Actions;
use App\Models\ProjectSkill;
use Livewire\Attributes\Layout;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use App\Http\Validators\Admin\Projects\Skills\EditValidator;

class EditComponent extends Component
{
    use SEOToolsTrait, Actions, LivewireAlert;

    public ProjectSkill $skill;
    public $name;
    public $slug;
    public $category;

    /**
     * Initialize component
     *
     * @return void
     */
    public function mount($id)
    {
        // Get skill
        $skill = ProjectSkill::where('uid', $id)->firstOrFail();

        // fill form
        $this->fill([
            'name'     => $skill->name,
            'slug'     => $skill->slug,
            'category' => $skill->category_id
        ]);

        // Set skill
        $this->skill = $skill;
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
        $this->seo()->setTitle( setSeoTitle(__('messages.t_edit_skill'), true) );
        $this->seo()->setDescription( settings('seo')->description );

        return view('livewire.admin.projects.skills.options.edit', [
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
        return Category::orderBy('id', 'asc')->withTranslation()->get();
    }


    /**
     * Update skill
     *
     * @return void
     */
    public function update()
    {
        try {

            // Validate form
            EditValidator::validate($this);
            
            // Update skill
            $this->skill->name        = $this->name;
            $this->skill->slug        = generate_slug($this->slug);
            $this->skill->category_id = $this->category;
            $this->skill->save();

            // Success
            $this->alert(
                'success', 
                __('messages.t_success'), 
                livewire_alert_params( __('messages.t_toast_operation_success') )
            );

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
