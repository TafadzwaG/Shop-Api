<?php

namespace App\Admin\Controllers;

use App\Models\HomeAd;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class HomeAdController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'HomeAd';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new HomeAd());

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('description', __('Description'));
        $grid->column('image', __('Image'));
        $grid->column('was', __('Was'));
        $grid->column('is_now', __('Is now'));
        $grid->column('simple', __('Simple'));
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
        $show = new Show(HomeAd::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('description', __('Description'));
        $show->field('image', __('Image'));
        $show->field('was', __('Was'));
        $show->field('is_now', __('Is now'));
        $show->field('simple', __('Simple'));
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
        $form = new Form(new HomeAd());

        $form->text('title', __('Title'));
        $form->textarea('description', __('Description'));
        $form->image('image', __('Image'))->move('public/images');
        $form->decimal('was', __('Was'));
        $form->decimal('is_now', __('Is now'));
        $form->switch('simple', __('Simple'));

        return $form;
    }
}
