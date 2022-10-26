<?php

namespace App\Orchid\Screens\Courses;

use App\Models\Course;

use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class CoursesScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'courses' => Course::paginate(15)
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Курсы';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make(__('Add'))
                ->icon('plus')
                ->route('platform.systems.users.create'),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::table('courses',[
                TD::make('name', 'Название') ->width(250),
                TD::make( 'description','Описание')
                    ->width(450)
                    ->render(function ($lesson){
                        return iconv_substr ($lesson->description, 0 , 80 , 'UTF-8' ).'...';
                    }),
                TD::make(__('Actions'))
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(function ($lesson) {
                        return DropDown::make()
                            ->icon('options-vertical')
                            ->list([

                                Link::make(__('Edit'))
                                    ->route('platform.systems.lessons_edit',$lesson)
                                    ->icon('pencil'),
                                Link::make(__('Delete'))
                                    ->route('platform.systems.lessons_delete', $lesson)
                                    ->icon('trash'),


                            ]);
                    }),

            ])
        ];
    }
}
