<?php

namespace App\Admin\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ProductController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Product';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Product());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('product_category_id', __('Product category id'));
        $grid->column('description', __('Description'));
        $grid->column('price', __('Price'));
        $grid->column('stock', __('Stock'));
        $grid->column('discount', __('Discount'));
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
        $show = new Show(Product::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('product_category_id', __('Product category id'));
        $show->field('description', __('Description'));
        $show->field('price', __('Price'));
        $show->field('stock', __('Stock'));
        $show->field('discount', __('Discount'));
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
        $form = new Form(new Product());

        $form->text('name', __('Name'));
        $form->select('product_category_id', __('Product category id'))->options(ProductCategory::all()->pluck('name', 'id'));
        $form->textarea('description', __('Description'));
        $form->decimal('price', __('Price'));
        $form->number('stock', __('Stock'));
        $form->number('discount', __('Discount'));

        return $form;
    }
}
