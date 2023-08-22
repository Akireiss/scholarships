<?php

namespace App\Http\Livewire;

use App\Models\Fund;
use App\Models\Campus;
use App\Models\Student;
use App\Models\FundSource;
use Illuminate\Support\Carbon;
use App\Models\ScholarshipName;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
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
            // Filter::make('Scholarship Name')
            //     ->select(ScholarshipName::all(), 'name', 'id')
            //     ->applyOnChange(),
            // Filter::make('Fund Source')
            //     ->select(FundSource::all(), 'source_name', 'source_id')
            //     ->applyOnChange(),
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

    ///
    public function datasource(): Builder
    {
        return Student::query();





        // if ($this->filters['Fund Source']) {
        //     $studentIds = Fund::where('source_id', $this->filters['Fund Source'])
        //         ->pluck('student_id');
        //     $query->whereIn('student_id', $studentIds);
        // }

        // return $query;
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
            ->addColumn('student_id')

           /** Example of custom column using a closure **/
            ->addColumn('student_id_lower', fn (Student $model) => strtolower(e($model->student_id)))

            ->addColumn('lastname')
            ->addColumn('firstname')
            ->addColumn('initial')
            ->addColumn('campus')
            ->addColumn('scholarshipType');
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

            Column::make('School', 'campus')
                ->sortable()
                ->searchable(),


            Column::make('Scholarship Type', 'scholarshipType')
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
            Filter::select('campus', 'campus')
            ->dataSource(Student::select('campus')->distinct()->get())
            ->optionValue('campus')
            ->optionLabel('campus'),
           Filter::inputText('scholarshipType')->operators(['contains']),
        ];
    }

    public function actions(): array
    {
       return [
        Button::make('view', 'View more')
        ->class('cursor-pointer text-dark px-3 py-2.5 m-1 rounded text-sm')
        // ->icon('mdi-eye')
        ->route('admin.scholarship.student-view', function(Student $model) {
            return ['id' => $model->id];
        }),


        ];
    }
}
