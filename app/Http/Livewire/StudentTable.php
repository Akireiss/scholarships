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

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()
            ->showSearchInput()
            ->withoutLoading(),
            Footer::make()
                ->showPerPage(),
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
         if (auth()->user()->role == 1) {
             return Student::query();
         } elseif (auth()->user()->role == 0) {
             return Student::query();
         } else {
             // Assuming role is either 2 or some other value
             return Student::query()->where('campus', 'Don Mariano Marcos Memorial State  University North La Union Campus');
         }
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
            ->addColumn('school_year')
            ->addColumn('father')
            ->addColumn('mother')
            ->addColumn('contact')
            ->addColumn('studentType')
            ->addColumn('nameSchool', fn (Student $model) => $model->nameSchool ?: "No Data")
            ->addColumn('lastYear', fn (Student $model) => $model->lastYear ?: "No Data")
            // ->addColumn('grant_status')
            ->addColumn('grant', fn (Student $model) => $model->grant ?: "No Data")
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
                ->searchable()
                ->hidden()
                ->visibleInExport(true),

            Column::make('Lastname', 'lastname')
                ->sortable()
                ->searchable(),

            Column::make('Firstname', 'firstname')
                ->sortable()
                ->searchable(),

            Column::make('Middle Initial', 'initial')
                ->sortable()
                ->searchable(),

            Column::make('Email Address', 'email')
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

            Column::make('Course/Program', 'course')
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

                Column::make('School year', 'school_year')
                ->sortable()
                ->searchable()
                ->hidden()
                ->visibleInExport(true),

            Column::make('Father Fullname', 'father')
                ->sortable()
                ->searchable()
                ->hidden()
                ->visibleInExport(true),

            Column::make('Mother Fullname', 'mother')
                ->sortable()
                ->searchable()
                ->hidden()
                ->visibleInExport(true),

            Column::make('Contact Number', 'contact')
                ->sortable()
                ->searchable()
                ->hidden()
                ->visibleInExport(true),

            Column::make('Type of Student', 'studentType')
                ->sortable()
                ->searchable()
                ->hidden()
                ->visibleInExport(true),

            Column::make('Name of School Last Attended', 'nameSchool')
                ->sortable()
                ->searchable()
                ->hidden()
                ->visibleInExport(true),

            Column::make('Last School Year Attended', 'lastYear')
                ->sortable()
                ->searchable()
                ->hidden()
                ->visibleInExport(true),

            Column::make('Recepient', 'grant')
                ->sortable()
                ->searchable(),

            // Column::make('Scholarship Type', 'scholarshipType')
            //     ->sortable()
            //     ->searchable(),

            Column::make('Remarks', 'student_status')
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
            // Filter::inputText('grant_status')->operators(['contains']),

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

            //
            // Filter::select('scholarshipType', 'scholarshipType')
            // ->dataSource(Student::codes())
            // ->optionValue('scholarshipType')
            // ->optionLabel('label'),
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
         $userRole = auth()->user()->role;

         if ($userRole == 1) {
             return [
                 Button::make('view', 'View')
                     ->class('btn btn-sm btn-primary cursor-pointer px-1 py-1 rounded text-sm')
                     ->route('admin.scholarship.actions.view_more', function (Student $model) {
                         return ['student' => $model->id];
                     }),

                 Button::make('edit', 'Edit')
                     ->class('btn btn-sm btn-warning cursor-pointer px-1 py-1 rounded text-sm')
                     ->route('admin.scholarship.actions.edit', function (Student $model) {
                         return ['student' => $model->id];
                     })
             ];
         } elseif ($userRole == 0) {
             return [
                Button::make('view', 'View')
                ->class('btn btn-sm btn-primary cursor-pointer px-1 py-1 rounded text-sm')
                ->route('staff.scholarship.actions.view_more', function (Student $model) {
                    return ['student' => $model->id];
                }),

                Button::make('edit', 'Edit')
                    ->class('btn btn-sm btn-warning cursor-pointer px-1 py-1 rounded text-sm')
                    ->route('staff.scholarship.actions.edit', function (Student $model) {
                        return ['student' => $model->id];
                    })
             ];
         } else {
             return [
                 Button::make('view', 'View')
                     ->class('btn btn-sm btn-primary cursor-pointer px-1 py-1 rounded text-sm')
                     ->route('campus-NLUC.scholarship.actions.view_more', function (Student $model) {
                         return ['student' => $model->id];
                     }),

                 Button::make('edit', 'Edit')
                     ->class('btn btn-sm btn-warning cursor-pointer px-1 py-1 rounded text-sm')
                     ->route('campus-NLUC.scholarship.actions.edit', function (Student $model) {
                         return ['student' => $model->id];
                     })
             ];
         }
     }


}

