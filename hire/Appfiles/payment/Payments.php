<?php

/**
 * for Payments
 */
class Payments
{
	protected $payments;
    public function __construct(PaymentsInterface $payments)
    {
    	$this->payments=$payments;
        
    }
}