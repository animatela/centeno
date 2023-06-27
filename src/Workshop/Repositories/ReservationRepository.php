<?php

namespace Idat\Centeno\Workshop\Repositories;

use App\Http\Resources\ReservationResource;
use Idat\Centeno\Workshop\Commands\Reservations\CreateNewReservation;
use Idat\Centeno\Workshop\Commands\Reservations\DeleteReservation;
use Idat\Centeno\Workshop\Commands\Reservations\FindReservation;
use Idat\Centeno\Workshop\Commands\Reservations\ForceDeleteReservation;
use Idat\Centeno\Workshop\Commands\Reservations\ListReservations;
use Idat\Centeno\Workshop\Commands\Reservations\PaginatedListReservations;
use Idat\Centeno\Workshop\Commands\Reservations\UpdateReservation;
use Idat\Centeno\Workshop\Objects\Reservations\NewReservationData;
use Idat\Centeno\Workshop\Objects\Reservations\ReservationData;
use Idat\Centeno\Workshop\Objects\Reservations\UpdatedReservationData;
use Illuminate\Database\Eloquent\Collection;

final class ReservationRepository
{
    public function __construct(
        private readonly ListReservations $listReservations,
        private readonly PaginatedListReservations $paginatedListReservations,
        private readonly CreateNewReservation $createReservation,
        private readonly FindReservation $findReservation,
        private readonly UpdateReservation $updateReservation,
        private readonly DeleteReservation $deleteReservation,
        private readonly ForceDeleteReservation $forceDeleteReservation,
    ) {}

    public function list(?int $customerId): Collection
    {
        return $this->listReservations->handle(
            $customerId
        );
    }

    public function paginated(?int $customerId): ReservationResource
    {
        return new ReservationResource(
            $this->paginatedListReservations->handle(
                $customerId
            )
        );
    }

    public function create(array $payload): ReservationData
    {
        return ReservationData::from(
            $this->createReservation->handle(
                NewReservationData::from($payload)
            )
        );
    }

    public function find(int $id): ReservationData
    {
        return ReservationData::from(
            $this->findReservation->handle($id)
        );
    }

    public function update(int $id, array $payload): int
    {
        return $this->updateReservation->handle(
            $id,
            UpdatedReservationData::from($payload)
        );
    }

    public function delete(int $id): int
    {
        return $this->deleteReservation->handle($id);
    }

    public function forceDelete(int $id): int
    {
        return $this->forceDeleteReservation->handle($id);
    }
}
