<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserService $service;

    public function __construct()
    {
        $this->service = new UserService();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {

        $items = $this->service->getUsersWithPagination(10);
        return view('users.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $item = new User();
        return view('users.create', compact('item'));
    }

    /**
     * Store a newly created resource in storage.
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $user = $this->service->createUser($request->all());

        if($user) {
            return redirect()
                ->route('users.edit', $user->id)
                ->with(['success' => 'Успешно сохранено']);
        }
        return $this->redirectWithError('Ошибка добавления');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $item = User::find($id);

        return view('users.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, int $id): \Illuminate\Http\RedirectResponse
    {

        $result = $this->service->updateUser($id, $request->all());

       if($result) {
           return redirect()
               ->route('users.edit', $id)
               ->with(['success' => 'Успешно сохранено']);
       }
        return $this->redirectWithError('Ошибка обновления');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id): \Illuminate\Http\RedirectResponse
    {

        $result  = $this->service->deleteUser($id);

        if ($result) {
            return redirect()
                ->route('users.index')
                ->with(['success' => "Запись id[$id] удалена"]);
        }
        return $this->redirectWithError('Ошибка удаления');

    }


    /**
     * @param string $msg
     * @return \Illuminate\Http\RedirectResponse
     */
    private function redirectWithError(string $msg): \Illuminate\Http\RedirectResponse
    {
        return back()
            ->withErrors(['msg' => $msg])
            ->withInput();
    }
}
