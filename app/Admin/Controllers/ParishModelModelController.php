<?php

namespace App\Admin\Controllers;

use App\Models\DistrictModel;
use App\Models\ParishModel;
use App\Models\SubcountyModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ParishModelModelController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Parishes';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ParishModel());
        $grid->disableBatchActions();
        $grid->disableExport();
        $grid->quickSearch('name')->placeholder('Search district name');
        $grid->model()->orderBy('name', 'asc');
        $grid->column('id', __('ID'))->sortable();
        $grid->column('name', __('Name'))->sortable();
        $grid->column('district_id', __('District'))
            ->display(function ($district_id) {
                if ($this->district == null) {
                    return "-";
                }
                return $this->district->name;
            })->sortable();

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(ParishModel::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('district_status', __('District status'));
        $show->field('region_id', __('Region id'));
        $show->field('subregion_id', __('Subregion id'));
        $show->field('map_id', __('Map id'));
        $show->field('zone_id', __('Zone id'));
        $show->field('land_type_id', __('Land type id'));
        $show->field('user_id', __('User id'));
        $show->field('created', __('Created'));
        $show->field('changed', __('Changed'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ParishModel());

        $form->select('subcounty_id', __('Subcounty'))->options(function ($id) {
            $district = SubcountyModel::find($id);
            if ($district) {
                return [$district->id => $district->name];
            }
        })->ajax(env('APP_URL') . '/api/select-subcounties')->rules('required');
        $form->text('name', __('Name'))->rules('required');


        /*  $form->number('district_status', __('District status'));
        $form->number('region_id', __('Region id'));
        $form->number('subregion_id', __('Subregion id'));
        $form->number('map_id', __('Map id'));
        $form->number('zone_id', __('Zone id'));
        $form->number('land_type_id', __('Land type id'));
        $form->number('user_id', __('User id'));
        $form->datetime('created', __('Created'))->default(date('Y-m-d H:i:s'));
        $form->switch('changed', __('Changed')); */

        return $form;
    }
}
