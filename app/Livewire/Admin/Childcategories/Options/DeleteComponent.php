<?php
namespace App\Livewire\Admin\Childcategories\Options;

use App\Models\Gig;
use App\Models\Project;
use Livewire\Component;
use App\Models\Category;
use WireUi\Traits\Actions;
use App\Models\Subcategory;
use App\Models\Childcategory;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;

class DeleteComponent extends Component
{
    use WithFileUploads, SEOToolsTrait, LivewireAlert, Actions;

    public Childcategory $childcategory;
    public $subcategories   = [];
    public $childcategories = [];
    public $category_id;
    public $subcategory_id;
    public $childcategory_id;

    /**
     * Initialize component
     *
     * @param string $id
     * @return void
     */
    public function mount($id)
    {
        // Set childcategory
        $this->childcategory = Childcategory::where('uid', $id)->firstOrFail();
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
        $this->seo()->setTitle( setSeoTitle(__('dashboard.t_delete_childcategory'), true) );
        $this->seo()->setDescription( settings('seo')->description );

        // Show view
        return view('livewire.admin.childcategories.options.delete', [
            'categories'    => $this->categories
        ]);
    }


    /**
     * Get all parent categories
     *
     * @return object
     */
    public function getCategoriesProperty()
    {
        return Category::orderBy('id')
                        ->withTranslation()
                        ->get();
    }


    /**
     * Get all subcategories
     *
     * @return object
     */
    public function updatedCategoryId($id)
    {
        $this->subcategories = Subcategory::orderBy('id')
                                            ->where('parent_id', $id)
                                            ->withTranslation()
                                            ->get();
    }


    /**
     * Get all childcategories
     *
     * @return object
     */
    public function updatedSubcategoryId($id)
    {
        $this->childcategories = Childcategory::orderBy('id')
                                            ->where('parent_id', $this->category_id)
                                            ->where('subcategory_id', $id)
                                            ->where('id', '!=', $this->childcategory->id)
                                            ->withTranslation()
                                            ->get();
    }


    /**
     * Delete record
     *
     * @return mixed
     */
    public function delete()
    {
        try {
            
            // Update gigs
            Gig::where('childcategory_id', $this->childcategory->id)
                ->update([
                    'category_id'      => $this->category_id,
                    'subcategory_id'   => $this->subcategory_id,
                    'childcategory_id' => $this->childcategory_id
                ]);

            // Update projects
            Project::where('childcategory_id', $this->childcategory->id)
                    ->update([
                        'category_id'      => $this->category_id,
                        'subcategory_id'   => $this->subcategory_id,
                        'childcategory_id' => $this->childcategory_id
                    ]);

            // delete all translations
            $this->childcategory->deleteTranslations();

            // Delete this childcategory now
            $this->childcategory->delete();

            // Set success message
            session()->flash('success', __('messages.t_toast_operation_success'));

            // Go back
            return $this->redirect( admin_url('childcategories') );

        } catch (\Throwable $th) {
            
            // Somthing went wrong
            $this->alert(
                'error', 
                __('messages.t_error'), 
                livewire_alert_params( $th->getMessage(), 'error' )
            );

        }
    }
    
}
