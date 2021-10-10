<?php

namespace Webkul\Admin\DataGrids;

use Illuminate\Support\Facades\DB;
use Webkul\Ui\DataGrid\DataGrid;

class CityDataGrid extends DataGrid
{
    /**
     * Set index columns, ex: id.
     *
     * @var string
     */
    protected $index = 'id';

    /**
     * Default sort order of datagrid.
     *
     * @var string
     */
    protected $sortOrder = 'desc';

    /**
     * Prepare query builder.
     *
     * @return void
     */
    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('cities')
            ->select('id')
            ->addSelect('id', 'country_id', 'name');

        // $this->addFilter('is_unique', 'is_unique');
        // $this->addFilter('value_per_locale', 'value_per_locale');
        // $this->addFilter('value_per_channel', 'value_per_channel');

        $this->setQueryBuilder($queryBuilder);
    }

    /**
     * Add columns.
     *
     * @return void
     */
    public function addColumns()
    {
        $this->addColumn([
            'index'      => 'id',
            'label'      => trans('admin::app.datagrid.id'),
            'type'       => 'number',
            'searchable' => false,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'country_id',
            'label'      => trans('country_id'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
                
            
        ]);

        $this->addColumn([
            'index'      => 'name',
            'label'      => trans('admin::app.name'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
        ]);

        
    }

    /**
     * Prepare actions.
     *
     * @return void
     */
    public function prepareActions()
    {
        $this->addAction([
            'title'  => trans('admin::app.datagrid.edit'),
            'method' => 'GET',
            'route'  => 'admin.cities.edit',
            'icon'   => 'icon pencil-lg-icon',
        ]);
        
        $this->addAction([
        'title'  => trans('admin::app.datagrid.delete'),
        'method' => 'POST',
        'route'  => 'admin.cities.delete',
        'icon'  => 'icon trash-icon',
        ]);
    }

    /**
     * Prepare mass actions.
     *
     * @return void
     */
    public function prepareMassActions()
    {
        $this->addMassAction([
            'type'   => 'delete',
            'action' => route('admin.catalog.attributes.massdelete'),
            'label'  => trans('admin::app.datagrid.delete'),
            'index'  => 'admin_name',
            'method' => 'POST',
        ]);
    }
}
