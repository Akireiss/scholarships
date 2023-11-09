<?php

namespace App\Http\Livewire;

use App\Models\Student;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class StudentTable extends PowerGridComponent
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
        $this->showCheckbox();
        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()
                ->showSearchInput()
                ->showToggleColumns()
                ->withoutLoading(),
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
     * @return Builder<\App\Models\Student>
     */
    public function datasource(): Builder
    {
        return Student::query();

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
            ->addColumn('id')
            ->addColumn('student_id')

           /** Example of custom column using a closure **/
            ->addColumn('student_id_lower', fn (Student $model) => strtolower(e($model->student_id)))

            ->addColumn('lastname')
            ->addColumn('firstname')
            ->addColumn('initial')
            ->addColumn('campus')
            ->addColumn('grant' ?? "No data")
            // ->addColumn('grant', fn($model) => $model->grant ) ?? "No Data" );

            ->addColumn('scholarshipType', fn(Student $model) => $model->getTypeScholarshipAttribute() ?? "No Data" );
    }

    /*
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
            Column::make('Id', 'id'),
            Column::make('Student id', 'student_id')
                ->sortable()
                ->searchable(),

            Column::make('Lastname', 'lastname')
                ->sortable()
                ->searchable(),


            Column::make('Firstname', 'firstname')
                ->sortable()
                ->searchable(),

            Column::make('Initial', 'initial')
                ->sortable()
                ->searchable(),

            Column::make('Campus', 'campus')
                ->sortable()
                ->searchable()
                ->hidden()
                ->visibleInExport(true),


            Column::make('Recipient', 'grant')
                ->sortable()
                ->searchable(),

            Column::make('ScholarshipType', 'scholarshipType')
                ->sortable()
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
            Filter::inputText('student_id')->operators(['contains']),
            Filter::inputText('lastname')->operators(['contains']),
            Filter::inputText('firstname')->operators(['contains']),
            Filter::inputText('initial')->operators(['contains']),
            Filter::inputText('campus')->operators(['contains']),
            Filter::inputText('scholarshipType')->operators(['contains']),
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
     * PowerGrid Student Action Buttons.
     *
     * @return array<int, Button>
     */


    // public function actions(): array
    // {
    //    return [
    //     Button::make('view', 'View more')
    //     ->class('cursor-pointer text-dark px-3 py-2.5 m-1 rounded text-sm')
    //     ->route('admin.scholarship.view_more', function(Student $student) {
    //         return ['id' => $student->id];
    //     }),
    //     ];
    // }


    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid Student Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($student) => $student->id === 1)
                ->hide(),
        ];
    }
    */

    public array $lastname = [];

    protected array $rules = [
        'lastname.*' => ['required'],
    ];

    public function onUpdatedEditable($id, $field, $value): void
    {
        $this->validate();
        Student::query()->find($id)->update([
            $field => $value,
        ]);
    }
}
