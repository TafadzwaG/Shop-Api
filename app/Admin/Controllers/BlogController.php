<?php

namespace App\Admin\Controllers;

use App\Models\Blog;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class BlogController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Blog';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Blog());

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('sub_title', __('Sub title'));
        $grid->column('tag', __('Tag'));
        $grid->column('body', __('Body'));
        $grid->column('posted_by', __('Posted by'));
        $grid->column('posted_at', __('Posted at'));
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
        $show = new Show(Blog::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('sub_title', __('Sub title'));
        $show->field('tag', __('Tag'));
        $show->field('body', __('Body'));
        $show->field('posted_by', __('Posted by'));
        $show->field('posted_at', __('Posted at'));
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
        $form = new Form(new Blog());

        $form->text('title', __('Title'));
        $form->text('sub_title', __('Sub title'));
        $form->text('tag', __('Tag'));
        $form->textarea('body', __('Body'));
        $form->text('posted_by', __('Posted by'));
        $form->datetime('posted_at', __('Posted at'))->default(date('Y-m-d H:i:s'));

        return $form;
    }
}
