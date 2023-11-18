<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\{Button, Column, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class UserTable extends PowerGridComponent
{
    use ActionButton;

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
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                // ->showRecordCount(),
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
     * @return Builder<\App\Models\User>
     */
    public function datasource(): Builder
    {
        return User::query();
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
            // ->addColumn('id')
            ->addColumn('name')
           /** Example of custom column using a closure **/
            ->addColumn('name_lower', fn (User $model) => strtolower(e($model->name)))
            ->addColumn('role', fn(User $model) => $model->getRoleText())
            ->addColumn('email')
            ->addColumn('username');

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
            // Column::make('Id', 'id'),
            Column::make('Name', 'name')
                ->searchable(),

            Column::make('User type', 'role'),
            Column::make('Email', 'email'),

            Column::make('Username', 'username')
                ->searchable(),

        ];
    }

    /**
     * PowerGrid Filters.
     *
     * @return array<int, Filter>
     */
    // public function filters(): array
    // {
    //     return [
    //         Filter::inputText('name')->operators(['contains']),
    //         Filter::inputText('username')->operators(['contains']),
    //     ];
    // }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /**
     * PowerGrid User Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
        return [
            Button::make('edit', 'Edit')
                ->class('btn-sm btn btn-success cursor-pointer text-dark px-3 py-2.5 m-1 rounded text-sm')
                ->route('admin.settings.edit', function(User $model) {
                    return ['id' => $model->id]; // Pass the parameter as an array
                }),

            Button::make('view', 'View')
                ->class('btn-sm btn btn-primary cursor-pointer text-dark px-3 py-2 m-1 rounded text-sm')
                ->route('admin.settings.view', function(User $model) {
                    return ['id' => $model->id]; // Pass the parameter as an array
                })
        ];
    }

}
