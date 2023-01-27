<?php

namespace App\Orchid\Screens\Courses;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\SimpleMDE;
use Orchid\Support\Facades\Alert;
use \Orchid\Support\Facades\Layout;
use Orchid\Screen\Screen;

class EditCourse extends Screen
{
    public $course;
    /**
     * Query data.
     *
     * @return array
     */
    public function query(Course $course): iterable
    {
        return [
            'course' => $course,
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->course->name;
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Создать')->icon('pencil')->canSee(!isset($this->course->id))->method('remove'),
            Button::make('Изменить')->icon('note')->canSee(isset($this->course->id))->method('createOrUpdate'),
            Button::make('Удалить')->icon('trash')->canSee(isset($this->course->id))->method('createOrUpdate')
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
            Layout::rows([
                Input::make('course.name')
                    ->required()
                    ->title('Название'),
                Input::make('course.description')
                    ->required()
                    ->title('Описание'),
                Input::make('course.image')
                    ->required()
                    ->title('Ссылка на изображение'),
                SimpleMDE::make('course.fullText')
                    ->required()
                    ->title('Полный текст'),
                Relation::make('lesson.teacher_id')
                    ->title('Преподаватель')
                    ->fromModel(User::class, 'name')
                    ->value($this->course->teacher_id)
                    ->required(),


            ])
        ];
    }

    public function createOrUpdate(Course $course, Request $request)
    {

        $course->fill($request->get('course'))->save();

        Alert::info('Вы успешно создали курс');

        return redirect()->route('platform.systems.courses');
    }


    public function remove(Course $course)
    {
        $course->delete();

        Alert::info('Вы успешно удалили курс');

        return redirect()->route('platform.systems.courses');
    }
}
