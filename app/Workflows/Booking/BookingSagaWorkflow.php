<?php

namespace App\Workflows\Booking;

use Throwable;
use Workflow\ActivityStub;
use Workflow\Workflow;

class BookingSagaWorkflow extends Workflow
{
    public function execute()
    {
        try {
            $flightId = yield ActivityStub::make(BookFlightActivity::class);
            $this->addCompensation(fn () => ActivityStub::make(CancelFlightActivity::class, $flightId));

            $hotelId = yield ActivityStub::make(BookHotelActivity::class);
            $this->addCompensation(fn () => ActivityStub::make(CancelHotelActivity::class, $hotelId));

            $carId = yield ActivityStub::make(BookRentalCarActivity::class);
            $this->addCompensation(fn () => ActivityStub::make(CancelRentalCarActivity::class, $carId));
        } catch (Throwable $th) {
            yield from $this->compensate();
            throw $th;
        }
    }
}
