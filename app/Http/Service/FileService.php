<?php


namespace App\Http\Service;


use App\Models\Documents;
use App\Models\OrderHistory;
use App\Models\Orders;


/**
 * Класс загрузки файлов
 * @package App\Http\Service
 */
class FileService
{
    /**
     * @param $request
     * @param $id
     * @return mixed
     */
    public function upload($request)
    {
        if ($request->has('score')) {
            $file = $request->file('score');
            $score = $this->saveFile($file, $file->getClientOriginalName() );
        }
        if ($request->has('payment')) {
            $file = $request->file('payment');
            $payment = $this->saveFile($file, $file->getClientOriginalName());
        }
        if ($request->has('to_courier_from')) {
            $file = $request->file('to_courier_from');
            $to_courier_from = $this->saveFile($file, $file->getClientOriginalName());
        }
        if ($request->has('to_warehous_from')) {
            $file = $request->file('to_warehous_from');
            $to_warehous_from = $this->saveFile($file, $file->getClientOriginalName());
        }
        if ($request->has('to_warehous_to')) {
            $file = $request->file('to_warehous_to');
            $to_warehous_to = $this->saveFile($file, $file->getClientOriginalName());
        }
        if ($request->has('to_drive')) {
            $file = $request->file('to_drive');
            $to_drive = $this->saveFile($file, $file->getClientOriginalName());
        }
        if ($request->has('to_courier_to')) {
            $file = $request->file('to_courier_to');
            $to_courier_to = $this->saveFile($file, $file->getClientOriginalName());
        }
        if ($request->has('to_customs')) {
            $file = $request->file('to_customs');
            $to_customs = $this->saveFile($file, $file->getClientOriginalName());
        }
        if ($request->has('to_received')) {
            $file = $request->file('to_received');
            $to_received = $this->saveFile($file, $file->getClientOriginalName());
        }


        $request = $request->all();

        $request['score']            = $score ?? null;
        $request['payment']          = $payment ?? null;
        $request['to_courier_from']  = $to_courier_from ?? null;
        $request['to_warehous_from'] = $to_warehous_from ?? null;
        $request['to_warehous_to']   = $to_warehous_to ?? null;
        $request['to_drive']         = $to_drive ?? null;
        $request['to_courier_to']    = $to_courier_to ?? null;
        $request['to_customs']       = $to_customs ?? null;
        $request['to_received']      = $to_received ?? null;

        return array_filter($request);
    }

    private function saveFile($file, $name_it): string
    {
        $name = $name_it;
        $filename = $name ;
        $file->storeAs('public', $filename);
        return $filename;
    }

}
