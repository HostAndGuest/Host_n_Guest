<?php

namespace ReviewBundle\Repository;


use Doctrine\ORM\EntityRepository;
use UserBundle\Entity\User;
use BookingBundle\Entity\Booking;
use PropertyBundle\Entity\Property;

class ReviewRepository extends EntityRepository
{
    public function reviewAuthorizationAndReservation($user_id, $property_id)
    {
        $current_date = new \DateTime('today');

        // supposing bookings dont get deleted, we will retrieve the booking list based on date
        $booking_list = $this->getEntityManager()->createQuery(
            "select b 
                      from PropertyBundle:Property p, BookingBundle:Booking b
                      where p.id = b.property
                      and b.reviewed = 0 
                      and b.guest = :uid
                      and p.id = :pid
                      order by b.bookingDate DESC 
            ")
            ->setParameter('uid', $user_id)
            ->setParameter('pid', $property_id)
            ->getResult();

        $found_any = false;
        foreach ($booking_list as $key => $value)
        {
            $book_date = $value->getBookingDate();
            if ($book_date->add(new \DateInterval('P'. $value->getTerm() .'D')) <= $current_date)
            {
                $found_any = true;
            }
            else
            {
                unset($booking_list[$key]);
            }
        }

        if ($found_any)
            return $booking_list;
        else
            return null;
    }

    public function getReviewsOfProperty($property_id)
    {
        // Paginator cannot support two FROM components or composite identifiers, because it cannot predict the total count in the database.
        $count = $this->getEntityManager()->createQuery(
            "select COUNT (r) 
                      from BookingBundle:Booking b, ReviewBundle:Review r
                      where b.id = r.booking
                      and b.property = :pid
            ")
            ->setParameter('pid', $property_id)
            ->getSingleScalarResult();

        // we return the query and let Knp Paginator handle the rest
        return $this->getEntityManager()->createQuery(
            "select r 
                      from BookingBundle:Booking b, ReviewBundle:Review r
                      where b.id = r.booking
                      and b.property = :pid
            ")
            ->setParameter('pid', $property_id)
            ->setHint('knp_paginator.count', $count);
           // ->getResult();
    }
}