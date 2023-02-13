<?php

namespace App\Repositories;

use App\Models\StoreCommand;

class CommandRepository
{
    public function scheduleCommand()
    {
        $commands = StoreCommand::all();
        return view('scheduleCommand', compact('commands'));
    }

    public function create($request)
    {
        $storeCommand = StoreCommand::findorfail($request->command);
        $storeCommand->start = $request->time;
        $storeCommand->save();
        return redirect()->back()->with('success', 'Command scheduled successfully !');
    }
}
