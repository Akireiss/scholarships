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
        $this->showCheckBox();

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
            ->addColumn('email')
            ->addColumn('sex')
            ->addColumn('status')
            ->addColumn('barangay')
            ->addColumn('municipal')
            ->addColumn('province')
            ->addColumn('campus')
            ->addColumn('course')
            ->addColumn('level')
            ->addColumn('semester')
            ->addColumn('father')
            ->addColumn('mother')
            ->addColumn('contact')
            ->addColumn('studentType')
            ->addColumn('nameSchool')
            ->addColumn('lastYear')
            ->addColumn('grant_status')
            ->addColumn('grant' ?? "No Data")
            ->addColumn('scholarshipType', fn(Student $model) => $model->getTypeScholarshipAttribute() ?? "No Data" )
            // ->addColumn('student_status')
            ->addColumn('student_status', fn(Student $model) => $model->getStatusTextAttribute() ?? "No Data" );
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

            Column::make('Student id', 'student_id')
                ->sortable()
                ->searchable(),

            Column::make('Lastname', 'lastname')
                ->sortable()
                ->searchable(),

            Column::make('Firstname', 'firstname')
                ->sortable()
                ->searchable(),

            Column::make('Middle Initial', 'initial')
                ->sortable()
                ->searchable(),

            Column::make('Email', 'email')
                ->sortable()
                ->searchable()
                ->hidden()
                ->visibleInExport(true),

            Column::make('Sex', 'sex')
                ->sortable()
                ->searchable()
                ->hidden()
                ->visibleInExport(true),

            Column::make('Status', 'status')
                ->sortable()
                ->searchable()
                ->hidden()
                ->visibleInExport(true),

            Column::make('Barangay', 'barangay')
                ->sortable()
                ->searchable()
                ->hidden()
                ->visibleInExport(true),

            Column::make('Municipal', 'municipal')
                ->sortable()
                ->searchable()
                ->hidden()
                ->visibleInExport(true),

            Column::make('Province', 'province')
                ->sortable()
                ->searchable()
                ->hidden()
                ->visibleInExport(true),

            Column::make('Campus', 'campus')
                ->sortable()
                ->searchable()
                ->hidden()
                ->visibleInExport(true),

            Column::make('Course', 'course')
                ->sortable()
                ->searchable()
                ->hidden()
                ->visibleInExport(true),

            Column::make('Year level', 'level')
                ->sortable()
                ->searchable(),

            Column::make('Semester', 'semester')
                ->sortable()
                ->searchable(),

            Column::make('Father', 'father')
                ->sortable()
                ->searchable()
                ->hidden()
                ->visibleInExport(true),

            Column::make('Mother', 'mother')
                ->sortable()
                ->searchable()
                ->hidden()
                ->visibleInExport(true),

            Column::make('Contact', 'contact')
                ->sortable()
                ->searchable()
                ->hidden()
                ->visibleInExport(true),

            Column::make('StudentType', 'studentType')
                ->sortable()
                ->searchable()
                ->hidden()
                ->visibleInExport(true),

            Column::make('NameSchool', 'nameSchool')
                ->sortable()
                ->searchable()
                ->hidden()
                ->visibleInExport(true),

            Column::make('LastYear', 'lastYear')
                ->sortable()
                ->searchable()
                ->hidden()
                ->visibleInExport(true),

            Column::make('Grant status', 'grant_status')
                ->sortable()
                ->searchable()
                ->hidden()
                ->visibleInExport(true),

            Column::make('Recepient', 'grant')
                ->sortable()
                ->searchable(),

            Column::make('Scholarship Type', 'scholarshipType')
                ->sortable()
                ->searchable(),

            Column::make('Status', 'student_status')
            ->sortable()
            ->searchable()
            ->hidden()
            ->visibleInExport(true),

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
            // Filter::inputText('student_id')->operators(['contains']),
            // Filter::inputText('lastname')->operators(['contains']),
            // Filter::inputText('firstname')->operators(['contains']),
            // Filter::inputText('initial')->operators(['contains']),
            Filter::inputText('email')->operators(['contains']),
            Filter::inputText('sex')->operators(['contains']),
            Filter::inputText('status')->operators(['contains']),
            Filter::inputText('barangay')->operators(['contains']),
            Filter::inputText('municipal')->operators(['contains']),
            Filter::inputText('province')->operators(['contains']),
            Filter::inputText('campus')->operators(['contains']),
            Filter::inputText('course')->operators(['contains']),
            Filter::inputText('father')->operators(['contains']),
            Filter::inputText('mother')->operators(['contains']),
            Filter::inputText('contact')->operators(['contains']),
            Filter::inputText('studentType')->operators(['contains']),
            Filter::inputText('nameSchool')->operators(['contains']),
            Filter::inputText('lastYear')->operators(['contains']),
            Filter::inputText('grant_status')->operators(['contains']),
            // Filter::inputText('grant')->operators(['contains']),
            // Filter::inputText('scholarshipType')->operators(['contains']),
            // Filter::datetimepicker('created_at'),

            // Level
            Filter::select('level', 'level')
            ->dataSource(Student::select('level')->distinct()->get())
            ->optionValue('level')
            ->optionLabel('level'),
            // semester
            Filter::select('semester', 'semester')
            ->dataSource(Student::select('semester')->distinct()->get())
            ->optionValue('semester')
            ->optionLabel('semester'),
            // recepient
            Filter::select('grant', 'grant')
            ->dataSource(Student::select('grant')->distinct()->get())
            ->optionValue('grant')
            ->optionLabel('grant'),
            // type
            // Filter::select('scholarshipType', 'scholarshipType')
            // ->dataSource(Student::select('scholarshipType')->distinct()->get())
            // ->optionValue('scholarshipType')
            // ->optionLabel('scholarshipType'),

            //
            Filter::select('scholarshipType', 'scholarshipType')
            ->dataSource(Student::codes())
            ->optionValue('scholarshipType')
            ->optionLabel('label'),
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


    public function actions(): array
    {
       return [
        //    Button::make('view', 'View')
        //        ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
        //        ->route('student.view', function(\App\Models\Student $model) {
        //             return ['scholar' => $model->id];
        //        }),

        //    Button::make('destroy', 'Delete')
        //        ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
        //        ->route('student.destroy', function(\App\Models\Student $model) {
        //             return $model->id;
        //        })
        //        ->method('delete')
        ];
    }


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
}
