<?php

namespace App\Traits;

trait HasAgenda
{
    public function getHasScheduleAttribute()
    {
        return !!$this->agenda && !!(
               ($this->agenda->lunes_i && $this->agenda->lunes_t)
            || ($this->agenda->martes_i && $this->agenda->martes_t)
            || ($this->agenda->mier_i && $this->agenda->mier_t)
            || ($this->agenda->jueves_i && $this->agenda->jueves_t)
            || ($this->agenda->viernes_i && $this->agenda->viernes_t)
            || ($this->agenda->sabado_i && $this->agenda->sabado_t)
            || ($this->agenda->domingo_i && $this->agenda->domingo_t)
        );
    }

    public function getWorkingHoursAttribute()
    {
        $getSchedule = fn ($dow, $start, $end) => [
            'daysOfWeek' => $dow,
            'startTime' => $start,
            'endTime' => $end,
        ];

        if (!$this->has_schedule) {
            return [
                $getSchedule([], '', ''),
            ];
        }
        
        $schedule = [];

        if ($this->agenda->lunes_i && $this->agenda->lunes_t) {
            $schedule[] = $getSchedule([1], $this->agenda->lunes_i, $this->agenda->lunes_t);
        }
        if ($this->agenda->martes_i && $this->agenda->martes_t) {
            $schedule[] = $getSchedule([2], $this->agenda->martes_i, $this->agenda->martes_t);
        }
        if ($this->agenda->mier_i && $this->agenda->mier_t) {
            $schedule[] = $getSchedule([3], $this->agenda->mier_i, $this->agenda->mier_t);
        }
        if ($this->agenda->jueves_i && $this->agenda->jueves_t) {
            $schedule[] = $getSchedule([4], $this->agenda->jueves_i, $this->agenda->jueves_t);
        }
        if ($this->agenda->viernes_i && $this->agenda->viernes_t) {
            $schedule[] = $getSchedule([5], $this->agenda->viernes_i, $this->agenda->viernes_t);
        }
        if ($this->agenda->sabado_i && $this->agenda->sabado_t) {
            $schedule[] = $getSchedule([6], $this->agenda->sabado_i, $this->agenda->sabado_t);
        }
        if ($this->agenda->domingo_i && $this->agenda->domingo_t) {
            $schedule[] = $getSchedule([0], $this->agenda->domingo_i, $this->agenda->domingo_t);
        }
        return $schedule;
    }
}