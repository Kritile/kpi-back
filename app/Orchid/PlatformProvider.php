<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * @return Menu[]
     */
    public function registerMainMenu(): array
    {
        return [
            Menu::make('О нас')
                ->icon('feed')
                ->route('platform.systems.about_edit')
                ->permission('platform.systems.courses'),

            Menu::make('Контакты')
                ->icon('doc')
                ->route('platform.systems.contacts_edit')
                ->permission('platform.systems.courses'),
            Menu::make('Курсы')
                ->icon('notebook')
                ->route('platform.systems.courses')
                ->title("Список проектов")
                ->permission('platform.systems.courses'),

            Menu::make('Уроки')
                ->icon('task')
                ->route('platform.systems.lessons')
                ->permission('platform.systems.courses'),

            Menu::make(__('Пользователи'))
                ->icon('user')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('Access rights')),

            Menu::make(__('Роли'))
                ->icon('lock')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles'),
        ];
    }

    /**
     * @return Menu[]
     */
    public function registerProfileMenu(): array
    {
        return [
            Menu::make('Profile')
                ->route('platform.profile')
                ->icon('user'),
        ];
    }

    /**
     * @return ItemPermission[]
     */
    public function registerPermissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.courses', __('Course'))
                ->addPermission('platform.systems.users', __('Users')),
        ];
    }
}
