<?php

namespace App\Orchid\Screens\Contacts;

use App\Models\About;
use App\Models\Contacts;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\TextArea;
use Orchid\Support\Facades\Alert;
use \Orchid\Support\Facades\Layout;
use Orchid\Screen\Screen;

class ContactsScreen extends Screen
{
    public $contacts;
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'contacts' => Contacts::all()->first(),
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Страница "Контакты"';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [Button::make('Обновить страницу')
            ->icon('note')
            ->method('createOrUpdate')];
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
                Input::make('contacts.name')->title('Название страницы')->required(),
                Input::make('contacts.cords')->title('Координаты')->required()->help('Координаты на карте без пробелов, через запятую'),
                TextArea::make('contacts.addr')->title('Адрес')->required()->rows(7),
                Quill::make('contacts.desc')->title('Содержимое страницы')
            ])
        ];
    }

    public function createOrUpdate(Contacts $contacts, Request $request){
        $contacts = Contacts::all()->first();
        if(!$contacts){
            $contacts = new Contacts();
        }
        $contacts->fill($request->get('contacts'))->save();
        Alert::success('Страница успешно обновлена');

        return redirect()->refresh();
    }
}
