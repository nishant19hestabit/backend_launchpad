<?php

namespace App\Repositories;

use App\Models\StoreCommand;

class CommandRepository
{
    public function scheduleCommand()
    {
        return view('scheduleCommand');
    }

    public function create($request)
    {
        $storeCommand = new StoreCommand();
        if ($storeCommand->count() == 0) {
            $storeCommand->name = $request->command;
            $storeCommand->start = $request->time;
            $storeCommand->save();
        } else {
            $storeCommand = StoreCommand::findorfail(1);
            $storeCommand->name = $request->command;
            $storeCommand->start = $request->time;
            $storeCommand->save();
        }
        return redirect()->back()->with('success', 'Command scheduled successfully !');
    }
}
