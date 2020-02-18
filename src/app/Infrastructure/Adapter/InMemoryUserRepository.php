<?php declare(strict_types=1);

namespace App\Infrastructure\Adapter;

use App\Domain\UserRow;
use App\Infrastructure\Eloquent\User;
use App\Infrastructure\Port\UserRepository;
use Generator;

final class InMemoryUserRepository implements UserRepository
{
    private array $usersAttributes;

    /**
     * @param array $users
     */
    public function __construct(array $users)
    {
        $this->usersAttributes = $users;
    }

    /**
     * @return Generator
     */
    public function findAll(): Generator
    {
        foreach ($this->usersAttributes as $userAttributes) {
            yield $this->makeUserRow(factory(User::class)->make($userAttributes));
        }
    }

    /**
     * @param User $user
     * @return UserRow
     */
    private function makeUserRow(User $user): UserRow
    {
        return new UserRow(
            $user->name,
            $user->email,
            $user->created_at,
            $user->updated_at
        );
    }
}
