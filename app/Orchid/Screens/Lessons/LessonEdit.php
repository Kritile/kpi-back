<?php

namespace App\Orchid\Screens\Lessons;

use App\Models\Course;
use App\Models\Lesson;

use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\SimpleMDE;
use Orchid\Screen\Fields\TextArea;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Screen;

class LessonEdit extends Screen
{
    public $lesson;
    /**
     * Query data.
     *
     * @return array
     */
    public function query(Lesson $lesson): iterable
    {
        return [
            'lesson' => $lesson
        ];

    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {

        return isset($this->lesson->id) ? $this->lesson->name : "Новый урок";
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Создать урок')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!isset($this->lesson->id)),

            Button::make('Обновить урок')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee(isset($this->lesson->id)),

            Button::make('Удалить урок')
                ->icon('trash')
                ->method('remove')
                ->canSee(isset($this->lesson->id)),
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
                Input::make('lesson.name')
                    ->value($this->lesson->name)
                    ->title('Наименование урока')
                    ->required(),
                Input::make('lesson.video_url')
                    ->value($this->lesson->video_url)
                    ->title('Ссылка на изображение урока (если требуется)'),
                SimpleMDE::make('lesson.description')
                    ->value($this->lesson->description)
                    ->title('Текст урока')
                    ->required(),
                Relation::make('lesson.course_id')
                    ->title('Курс')
                    ->fromModel(Course::class, 'name')
                    ->value($this->lesson->course_id)
                    ->required(),

        ])
        ];
    }
    public function createOrUpdate(Lesson $lesson, Request $request)
    {

        $lesson->fill($request->get('lesson'))->save();

        Alert::info('Вы успешно создали урок');

        return redirect()->route('platform.systems.lessons');
    }


    public function remove(Lesson $lesson)
    {
        $lesson->delete();

        Alert::info('Вы успешно удалили урок');

        return redirect()->route('platform.systems.lessons');
    }
}
