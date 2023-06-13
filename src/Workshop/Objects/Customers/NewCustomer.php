<?php

namespace Idat\Centeno\Workshop\Objects\Customers;

use Idat\Centeno\Workshop\Enums\DocumentType;
use Idat\Centeno\Workshop\Enums\Gender;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class NewCustomer extends Data
{
    public function __construct(
        public readonly int $user_id,
        public readonly string $name,
        public readonly string $email,
        public readonly string|Optional|null $photo,
        public readonly Gender|Optional|null $gender,
        public readonly string|Optional|null $phone,
        public readonly Carbon|Optional|null $birthday,
        public readonly DocumentType|Optional|null $document_type,
        public readonly string|Optional|null $document_number,
    ) {}
}
