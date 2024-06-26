<?php

namespace App\Admin\Controllers;

use App\Models\FinancialInstitution;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class FinancialInstitutionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Financial Institutions';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new FinancialInstitution());
        $grid->model()->orderBy('id', 'desc');
        $grid->column('name', __('Name'));
        $grid->column('type', __('Type'));
        $grid->column('details', __('Details'));

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
        $show = new Show(FinancialInstitution::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('name', __('Name'));
        $show->field('type', __('Type'));
        $show->field('details', __('Details'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new FinancialInstitution());

        $form->text('name', __('Name'))->rules('required');
        $form->select('type', __('Type'))
            ->options([
                'Bank' => 'Bank',
                'Sacco' => 'Sacco',
                'Microfinance' => 'Microfinance',
                'Other' => 'Other',
            ])->rules('required');
        $form->textarea('details', __('Details'));

        return $form;
    }
}
