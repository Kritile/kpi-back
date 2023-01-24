<?php

namespace App\Orchid\Screens\About;

use App\Models\About;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class AboutScreen extends Screen
{

    public $about;
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'about' => About::all()->first()
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Страница "О нас"';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Обновить страницу')
            ->icon('note')
            ->method('createOrUpdate')
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
                Input::make('about.name')->title('Название страницы')->required(),
                Quill::make('about.desc')->title('Содержимое страницы')->required(),
        ])
        ];
    }
    public function createOrUpdate(About $about, Request $request)
    {
        $about = About::all()->first();
        $about->fill($request->get('about'))->save();

        Alert::success('Страница успешно обновлена');

        return redirect()->refresh();
    }
}
