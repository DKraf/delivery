<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class CreateStatus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            'Ожидает оплаты',
            'На пути к ТК',
            'Ожидает погрузки',
            'В пути',
            'Доставленно на склад ТК',
            'Ожидаем таможенную декларацию',
            'Отгруженно в пункт выдачи',
            'Готово к получению'

        ];

        foreach ($statuses as $status) {
            Status::create(['name' => $status]);
        }
    }
}
