<?php

    namespace App\Http\Livewire;

    use App\Models\Grantee;
    use App\Models\Student;
    use Illuminate\Support\Carbon;
    use Illuminate\Database\Eloquent\Builder;
    use PowerComponents\LivewirePowerGrid\Filters\Filter;
    use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
    use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
    use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

    final class StudentAddTable extends PowerGridComponent
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
            // $this->showCheckBox();

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
            $query = Student::query();

            return $query->join('barangays', 'students.barangay', '=', 'barangays.brgyCode')
            ->join('municipals', 'students.municipal', '=', 'municipals.citymunCode')
            ->join('provinces', 'students.province', '=', 'provinces.provCode')
            ->join('campuses', 'students.campus', '=', 'campuses.id')
            ->join('courses', 'students.course', '=', 'courses.course_id') // Update join condition
            ->leftJoin('grantees', 'students.id', '=', 'grantees.student_id')
            ->select(
                'students.*',
                'barangays.brgyDesc',
                'municipals.citymunDesc',
                'provinces.provDesc',
                'campuses.campusDesc',
                'courses.course_name',
                'grantees.semester',
                'grantees.school_year',
                'grantees.scholarship_name'
            );
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
                ->addColumn('semester',  fn (Student $model) => $model->semester ?: "No Data")
                ->addColumn('father')
                ->addColumn('mother')
                ->addColumn('contact')
                ->addColumn('studentType')
                ->addColumn('nameSchool', fn (Student $model) => $model->nameSchool ?: "No Data")
                ->addColumn('lastYear', fn (Student $model) => $model->lastYear ?: "No Data")
                ->addColumn('scholarship_name', function (Student $model) {
                    $grantee = $model->grantee;

                    if ($grantee instanceof Grantee) {
                        return optional($grantee->scholarshipName)->name ?? "No Data";
                    } else {
                        return "No Data";
                    }
                })
                ->addColumn('scholarshipType', function (Student $model) {
                    $grantee = $model->grantee;

                    if ($grantee instanceof Grantee) {
                        $value = optional($grantee)->scholarship_type;
                        switch ($value) {
                            case 0:
                                return 'Government';
                            case 1:
                                return 'Private';
                            default:
                                return 'No info';
                        }
                    } else {
                        return "No Data";
                    }
                })
                ->addColumn('student_status');
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

                Column::make('Recepient', 'scholarship_name')
                    ->sortable()
                    ->searchable(),

                Column::make('Scholarship Type', 'scholarshipType')
                    ->sortable()
                    ->searchable(),

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

                // Level
                Filter::select('level', 'level')
                ->dataSource(Student::select('level')->distinct()->get())
                ->optionValue('level')
                ->optionLabel('level'),
                // semester
                Filter::select('semester', 'semester')
                ->dataSource(Grantee::select('semester')->distinct()->get())
                ->optionValue('semester')
                ->optionLabel('semester'),
                // recepient
                Filter::select('scholarship_name', 'scholarship_name')
                ->dataSource(Grantee::select('scholarship_name')->distinct()->get())
                ->optionValue('scholarship_name')
                ->optionLabel('scholarship_name'),

                //
                //  Filter::select('scholarshipType', 'scholarshipType')
                //  ->dataSource(Student::codes())
                //  ->optionValue('scholarshipType')
                //  ->optionLabel('label'),
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
        Button::make('view', 'Add')
            ->class('btn btn-sm btn-primary cursor-pointer text-white px-1 py-1 m-1 rounded text-sm')
            ->route('admin.student.edit', function (Student $model) {
                return ['studentId' => $model->id];
            }),
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
