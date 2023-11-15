<?php


namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class UserService
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getUsers(): \Illuminate\Database\Eloquent\Collection
    {
        return User::all();
    }

    /**
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getUsersWithPagination(int $perPage): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return User::paginate($perPage);
    }

    /**
     * @param $id
     * @return Model|\Illuminate\Database\Eloquent\Collection|array|User|null
     */
    public function getUserById($id): Model|\Illuminate\Database\Eloquent\Collection|array|User|null
    {
        return User::findOrFail($id);
    }

    /**
     * @param array $userData
     * @return Model|User
     * @throws \Illuminate\Validation\ValidationException
     */
    public function createUser(array $userData): Model|User
    {

        Validator::make($userData, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email',
            ],

        ])->validate();

        return User::create([
            'name' => $userData['name'],
            'email' => $userData['email'],
        ]);

    }


    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateUser(int $id, array $userData): bool
    {
        Validator::make($userData, [
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email,' . $id,
            ],
        ])->validate();

        return $this->getUserById($id)->update($userData);
    }

    public function deleteUser($id): ?bool
    {
       return $this->getUserById($id)->delete();
    }
}
