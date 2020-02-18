<?php declare(strict_types=1);

namespace App\Infrastructure\Adapter;

use App\Domain\UserRow;
use App\Infrastructure\Eloquent\User;
use App\Infrastructure\Port\UserRepository;
use Generator;

final class DbUserRepository implements UserRepository
{
    /**
     * @return Generator
     */
    public function findAll(): Generator
    {
        /** @var User $user */
        foreach (User::query()->cursor() as $user) {
            yield new UserRow(
                $user->name,
                $user->email,
                $user->created_at,
                $user->updated_at
            );
        }
    }
}
