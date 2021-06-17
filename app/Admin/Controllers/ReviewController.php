<?php

namespace App\Admin\Controllers;
use App\Models\Product;
use App\Models\Review;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ReviewController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Review';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Review());

        $grid->column('id', __('Id'));
        $grid->column('product_id', __('Product id'));
        $grid->column('customer', __('Customer'));
        $grid->column('review', __('Review'));
        $grid->column('star', __('Star'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(Review::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('product_id', __('Product id'));
        $show->field('customer', __('Customer'));
        $show->field('review', __('Review'));
        $show->field('star', __('Star'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Review());

        $form->select('product_id', __('Product id'))->options(Product::all()->pluck('name', 'id'));
        $form->text('customer', __('Customer'));
        $form->textarea('review', __('Review'));
        $form->number('star', __('Star'));

        return $form;
    }
}
