<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommandStoreRequest;
use App\Repositories\CommandRepository;
use Exception;

class CommandController extends Controller
{
    public $commandRepository;
    public $response;

    public function __construct(CommandRepository $commandRepository)
    {
        $this->commandRepository = $commandRepository;
        $this->response = null;
    }

    public function index()
    {
        try {
            $this->response = $this->commandRepository->scheduleCommand();
        } catch (Exception $e) {
            $this->response = redirect()->back()->with('error', $e->getMessage());
        }
        return $this->response;
    }
    public function store(CommandStoreRequest $request)
    {
        try {
            $this->response = $this->commandRepository->create($request);
        } catch (Exception $e) {
            $this->response = redirect()->back()->with('error', $e->getMessage());
        }
        return $this->response;
    }
}
