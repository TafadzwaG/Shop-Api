<?php

namespace App\Admin\Controllers;

use App\Models\BannerAd;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class BannerAdController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'BannerAd';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new BannerAd());

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('description', __('Description'));
        $grid->column('percentage_off', __('Percentage off'));
        $grid->column('image', __('Image'));
        $grid->column('starting_at', __('Starting at'));
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
        $show = new Show(BannerAd::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('description', __('Description'));
        $show->field('percentage_off', __('Percentage off'));
        $show->field('image', __('Image'));
        $show->field('starting_at', __('Starting at'));
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
        $form = new Form(new BannerAd());

        $form->text('title', __('Title'));
        $form->textarea('description', __('Description'));
        $form->textarea('percentage_off', __('Percentage off'));
        $form->image('image', __('Image'))->move('public/images');
        $form->decimal('starting_at', __('Starting at'));

        return $form;
    }
}
