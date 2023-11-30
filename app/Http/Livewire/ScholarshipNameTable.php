<?php

namespace App\Http\Livewire;

use App\Models\ScholarshipName;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class ScholarshipNameTable extends PowerGridComponent
{
    use ActionButton;
    use WithExport;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
     * PowerGrid datasource.
     *
     * @return Builder<\App\Models\ScholarshipName>
     */
    public function datasource(): Builder
    {
        return ScholarshipName::query()

        ;
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ❗ IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
    */
    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('name')

           /** Example of custom column using a closure **/
            ->addColumn('name_lower', fn (ScholarshipName $model) => strtolower(e($model->name)))
            ->addColumn('scholarship_type',  fn(ScholarshipName $model) => $model->getTypeScholarshipNameAttribute() ?? "No Data" )
            ->addColumn('status',  fn(ScholarshipName $model) => $model->getStatusScholarshipNameAttribute());
    }

    /*
    getStatusScholarshipNameAttribute
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

     /**
      * PowerGrid Columns.
      *
      * @return array<int, Column>
      */
    public function columns(): array
    {
        return [
            // Column::make('Id', 'id'),
            Column::make('Scholarship Name', 'name')
                ->searchable(),
            Column::make('Scholarship type', 'scholarship_type')
                ->searchable(),
            Column::make('Status', 'status')
                ->searchable(),

        ];
    }

    /**
     * PowerGrid Filters.
     *
     * @return array<int, Filter>
     */
    public function filters(): array
    {
        return [
            // Filter::inputText('name')->operators(['contains']),
            // Filter::datetimepicker('created_at'),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /**
     * PowerGrid ScholarshipName Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
        $userRole = auth()->user()->role;
        if($userRole == 1){
            return [
                 Button::make('edit', 'Edit')
                    ->class('btn btn-sm btn-warning cursor-pointer text-dark px-2 py-1 rounded text-sm')
                    ->route('scholar.edit', function(ScholarshipName $model) {
                         return ['scholar' => $model->id];
                    }),
             ];
        } elseif ($userRole == 0) {
            return [
               Button::make('edit', 'Edit')
                   ->class('btn btn-sm btn-warning cursor-pointer text-dark px-2 py-1 rounded text-sm')
                   ->route('staff.scholarship.actions.edit', function (ScholarshipName $model) {
                       return ['scholar' => $model->id];
                   })
            ];
        } else {
            return [
                Button::make('edit', 'Edit')
                    ->class('btn btn-sm btn-warning cursor-pointer text-dark px-2 py-1 rounded text-sm')
                    ->route('nlucscholar.edit', function (ScholarshipName $model) {
                        return ['scholar' => $model->id];
                    })
            ];
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid ScholarshipName Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($scholarship-name) => $scholarship-name->id === 1)
                ->hide(),
        ];
    }
    */
}
