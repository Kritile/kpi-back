<?php

namespace App\Orchid\Screens\Lessons;

use App\Models\Course;
use App\Models\Lesson;
use Orchid\Platform\Models\User;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class LessonScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'lessons' => Lesson::filters()->defaultSort('created_at','desc')->paginate(10),
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Уроки';
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
                ->route('platform.systems.lessons_edit'),
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
            Layout::table('lessons',[
                TD::make('name', 'Название')->sort(),
                TD::make( 'description','Описание')
                    ->width(450)
                    ->render(function ($lesson){
                        return iconv_substr ($lesson->description, 0 , 80 , 'UTF-8' ).'...';
                    }),
                TD::make('video_url', 'Картинка')
                    ->render(function ($lesson){
                        return '<span class="thumb-lg me-sm-0 ms-md-0 me-xl-0 d-none d-md-inline-block">
                                    <img src="'.$lesson->video_url.'" class="bg-light">
                                </span>';
                    })
                    ->width(110),
                TD::make('course_id','Название курса')
                    ->sort()
                    ->render(function ($lesson){
                        return $this->getCourseName($lesson->course_id);
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
                                Button::make(__('Delete'))
                                    ->method('removeLesson')
                                    ->icon('trash'),


                            ]);
                    }),
            ])
        ];
    }

    private function getCourseName($course_id)
    {
        return Course::find($course_id)->name;
    }
    private function removeLesson(){

    }
}
