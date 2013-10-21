<?php

/**
 * Allegiant G4 util package.
 *
 * @category  Allegiant
 * @package   G4.UtilBundle
 */
namespace G4\UtilBundle;

use G4\ProfileBundle\Entity\Mappers\CustomerMappers;
use G4\ShoppingCartBundle\Entity\AdditionalFees;
use G4\ShoppingCartBundle\Entity\CartRequest;
use G4\ShoppingCartBundle\Entity\CartResponse\Items\ItemFee;
use Symfony\Component\DependencyInjection\ContainerAware;
use G4\UtilBundle\Exception\InvalidCartRequest;
use \G4\AREBundle\Entity\com\allegiant\are\dto\common\Traveler as AreTraveler;
use G4\UtilBundle\Controller\G4Controller;
use Symfony\Component\PropertyAccess\PropertyAccess;


/**
 * Provides some base common functionality for Entities
 */
class EntityHelper extends ContainerAware
{
    /**
     * Populate $obj with $data.  Will use setter methods, assuming they obeyed naming conventions.
     *
     * @param stdClass $obj  Object
     * @param stdClass $data Data
     *
     * @return void
     * @static
     */
    public static function populate($obj, $data = null)
    {
        if ($data !== null) {
            foreach ($obj as $key => $value) {
                if (array_key_exists($key, $data)) {
                    $setter = 'set' . ucfirst($key);
                    if (method_exists($obj, $setter)) {
                        $obj->$setter($data[$key]);
                    }
                }
            }
        }
    }

    /**
     * Enhance the provided cart request object with information about the user chosen flights.
     *
     * @param CartRequest $request request
     * @param \stdClass                                 $raw     raw data
     *
     * @return void
     */
    public function enhanceFlights(CartRequest $request, \stdClass $raw)
    {
        $dFlight = new \G4\ShoppingCartBundle\Entity\CartRequest\Flight();

        if (!isset($raw->departing)) {
            throw new \RuntimeException("Malformed request from AJAX (departing key is missing): " . json_encode($raw));
        }

        $dFlight->setId($raw->departing->id);
        if (isset($raw->departing->departs) && isset($raw->departing->arrives)) {
            $dFlight->setDepartsDate($raw->departing->departs);
            $dFlight->setArrivesDate($raw->departing->arrives);
        }
        $request->setDepartingFlight($dFlight);
        $rFlight = new \G4\ShoppingCartBundle\Entity\CartRequest\Flight();
        if (isset($raw->returning)) {
            $rFlight->setId($raw->returning->id);
            if (isset($raw->returning->departs) && isset($raw->returning->arrives)) {
                $rFlight->setDepartsDate($raw->returning->departs);
                $rFlight->setArrivesDate($raw->returning->arrives);
            }
        }
        $request->setReturningFlight($rFlight);
    }

    /**
     * Populate Item object
     *
     * @param $rawSegment
     * @return \G4\FlightBundle\Entity\FlightResponse\Item
     */
    public function populateFlightResponseItem($rawSegment)
    {
        $item = new \G4\FlightBundle\Entity\FlightResponse\Item();
        $item->setFlightNo($rawSegment->flightNbr);
        $item->setAirlineCode($rawSegment->airlineCode);

        foreach ($rawSegment->leg as $legResp) {
            // add each intermediate stop
            $locationFrom = new \G4\FlightBundle\Entity\FlightResponse\Location();
            $locationFrom->setId($legResp->departAirport->id);
            $locationFrom->setCode($legResp->departAirport->code);
            $locationFrom->setCity($legResp->departAirport->city);
            $locationFrom->setName($legResp->departAirport->name);
            $item->addStop($locationFrom);

            $locationTo = new \G4\FlightBundle\Entity\FlightResponse\Location();
            $locationTo->setId($legResp->arriveAirport->id);
            $locationTo->setCode($legResp->arriveAirport->code);
            $locationTo->setCity($legResp->arriveAirport->city);
            $locationTo->setName($legResp->arriveAirport->name);
            $item->addStop($locationTo);

            $leg = new \G4\FlightBundle\Entity\FlightResponse\Leg();
            $leg->setFrom($locationFrom->getCode());
            $leg->setTo($locationTo->getCode());
            $leg->setPosition($legResp->sequenceNum); // the order in the leg list
            $leg->setMiles($legResp->miles);
            $leg->setDuration($legResp->durationMinutes);
            $leg->setDepartureDate($legResp->departDateTime);
            $leg->setArrivalDate($legResp->arriveDateTime);

            $item->addLeg($leg);
        }

        return $item;
    }

    /**
     * Enhance the provided cart request object with information about the user initial search.
     *
     * @param CartRequest $request request
     * @param \stdClass   $raw     raw data
     */
    public function enhanceSearchParams(CartRequest $request, \stdClass $raw)
    {
        $accessor = PropertyAccess::createPropertyAccessor();

        if (property_exists($raw, 'departing')) {
            $accessor->setValue($raw, 'search_params.outward', substr($accessor->getValue($raw, 'departing.departs'), 0, 10));
        }

        if (property_exists($raw, 'returning')) {
            $accessor->setValue($raw, 'search_params.returning', substr($accessor->getValue($raw, 'returning.departs'), 0, 10));
        }

        $searchParams = $this->populateSearchParams($accessor->getValue($raw, 'search_params'));
        $searchParams->calculateUserType();

        if (property_exists($raw, 'vehicle_rental_period') && $accessor->getValue($raw, 'vehicle_rental_period')) {
            // overwrite component dates
            $item = $searchParams->getComponent(G4Controller::_KEY_VEHICLE);
            if ($item) {
                $startDate = $accessor->getValue($raw, 'vehicle_rental_period.from');
                $endDate = $accessor->getValue($raw, 'vehicle_rental_period.to');
                $item->setStartDate(date('Y-m-d', strtotime($startDate)) ?: null);
                $item->setEndDate(date('Y-m-d', strtotime($endDate)) ?: null);
                $searchParams->addComponent($item); // overwrites
            }
        }

        if (property_exists($raw, 'hotel_rental_period') && $accessor->getValue($raw, 'hotel_rental_period')) {
            // overwrite component dates
            $item = $searchParams->getComponent(G4Controller::_KEY_HOTEL);
            if ($item) {
                $startDate = $accessor->getValue($raw, 'hotel_rental_period.from');
                $endDate = $accessor->getValue($raw, 'hotel_rental_period.to');
                $item->setStartDate(date('Y-m-d', strtotime($startDate)) ?: null);
                $item->setEndDate(date('Y-m-d', strtotime($endDate)) ?: null);
                $searchParams->addComponent($item); // overwrites
            }
        }

        /*$product = $searchParams->getComponent(G4Controller::_KEY_PRODUCT);
        if (isset($product) && $product->getEndDate() == null) {
            $endDateTimestamp = strtotime($searchParams->getOutwardDate()) + $searchParams->getDefaultTripLength() * 24 * 3600;
            $product->setEndDate(date('Y-m-d', $endDateTimestamp));
            $searchParams->addComponent($product);
        }*/

        $request->setSearchParams($searchParams);
    }

    /**
     * Enhance the provided cart request object with information about the user chosen hotel.
     *
     * @param CartRequest $request request
     * @param \stdClass   $raw     raw data
     *
     * @return void
     */
    public function enhanceHotel(CartRequest $request, \stdClass $raw)
    {
        $hotel = new \G4\ShoppingCartBundle\Entity\CartRequest\Hotel();

        if (isset($raw->hotel) && is_object($raw->hotel)) {
            if (isset($raw->hotel->id)) {
                $hotel->setId($raw->hotel->id);
            }

            //this request can come either from ajax or a symfony loopback, we have two different objects structures.
            if (isset($raw->hotel->selected_room->id)) {
                $hotel->setRoom($raw->hotel->selected_room->id);
                $hotel->setNrRooms($raw->hotel->selected_room->count);
            } else {
                if (isset($raw->hotel->room)) {
                    $hotel->setRoom($raw->hotel->room);
                    $hotel->setNrRooms($raw->hotel->nrRooms);
                }
            }
        }

        $hotelRentalObject = G4PropertyAccess::getValue($raw, 'hotel_rental_period');
        if ($hotelRentalObject) {
            $hotelDateFrom = G4PropertyAccess::getValue($hotelRentalObject, 'from');
            $hotelDateTo = G4PropertyAccess::getValue($hotelRentalObject, 'to');
            $hotel->setDateFrom($hotelDateFrom ? date('Y-m-d', strtotime($hotelDateFrom)) : null);
            $hotel->setDateTo($hotelDateTo ? date('Y-m-d', strtotime($hotelDateTo)) : null);

            if (strtotime($hotel->getDateTo()) - strtotime($hotel->getDateFrom()) < G4PropertyAccess::getValue($hotelRentalObject, 'minimum') * 24 * 3600) {
                throw new \RuntimeException("Malformed request from AJAX (hotel rental interval is wrong): " . json_encode($raw));
            }
        } else {
            $hotelDateFrom = G4PropertyAccess::getValue($raw, 'hotel.booking_params.from');
            $hotelDateTo = G4PropertyAccess::getValue($raw, 'hotel.booking_params.to');
            $hotelLocation = G4PropertyAccess::getValue($raw, 'hotel.booking_params.location');
            $hotel->setDateFrom($hotelDateFrom ? date('Y-m-d', strtotime($hotelDateFrom)) : null);
            $hotel->setDateTo($hotelDateTo ? date('Y-m-d', strtotime($hotelDateTo)) : null);
            $hotel->setLocation($this->populateLocationFromCode($hotelLocation));
        }

        //if the sorting entity comes through the raw request we load it in the cartRequest object
        if (isset($raw->hotel->sorting)) {
            $criterion = $raw->hotel->sorting->criterion;
            $order = $raw->hotel->sorting->order;
            $position = $raw->hotel->sorting->position;

            $hotel->getSorting()->setCriterion($criterion);
            $hotel->getSorting()->setOrder($order);
            $hotel->getSorting()->setPosition($position);
        }

        $request->setHotel($hotel);
    }

    /**
     * Enhance the provided cart request object with information about the user hotel upsell information.
     *
     * @param CartRequest $request request
     * @param \stdClass   $raw     raw data
     *
     * @return void
     */
    public function enhanceHotelUpsell(CartRequest $request, \stdClass $raw)
    {
        $hotelUpsell = new CartRequest\Product\Component();

        $hotelRentalObject = G4PropertyAccess::getValue($raw, 'hotel_upsell');
        if ($hotelRentalObject) {
            $hotelDateFrom = G4PropertyAccess::getValue($hotelRentalObject, 'from');
            $hotelDateTo = G4PropertyAccess::getValue($hotelRentalObject, 'to');
            $hotelUpsell->setStartDate($hotelDateFrom ? date('Y-m-d', strtotime($hotelDateFrom)) : null);
            $hotelUpsell->setEndDate($hotelDateTo ? date('Y-m-d', strtotime($hotelDateTo)) : null);

            $hotelLocationCode = G4PropertyAccess::getValue($hotelRentalObject, 'location');
            if ($hotelLocationCode) {
                $location = $this->populateLocationFromCode($hotelLocationCode);
                $marketDetails = $this->container->get('g4_lookup')->lookupMarketDetails(
                    $request->getDepartingFlight()->getDepartFrom(),
                    $request->getDepartingFlight()->getArriveAt()
                );

                if ($marketDetails->from->airport_code == $location->getCode()) {
                    $location->setId($marketDetails->from->location_id);
                } else {
                    $location->setId($marketDetails->to->location_id);
                }

                $hotelUpsell->setLocation($location);
            }
        }

        $request->setHotelUpsell($hotelUpsell);
    }

    /**
     * Enhance the provided cart request object with information about the user chosen vehicle.
     *
     * @param CartRequest $request request
     * @param \stdClass   $raw     raw data
     *
     * @return void
     */
    public function enhanceVehicle(CartRequest $request, \stdClass $raw)
    {
        $vehicle = new CartRequest\Vehicle();
        if (isset($raw->vehicle) && is_object($raw->vehicle)) {
            $vehicle->setId($raw->vehicle->id);
            $vehicle->setBags($raw->vehicle->bags);
            $vehicle->setSeats($raw->vehicle->seats);
            $vehicle->setClassId(G4PropertyAccess::getValue($raw, 'vehicle.classId'));
        }

        $vehicleRentalObject = G4PropertyAccess::getValue($raw, 'vehicle_rental_period');
        if ($vehicleRentalObject) {
            $vehicleDateFrom = G4PropertyAccess::getValue($vehicleRentalObject, 'from');
            $vehicleDateTo = G4PropertyAccess::getValue($vehicleRentalObject, 'to');
            $vehicle->setDateFrom($vehicleDateFrom ? date('Y-m-d\TH:i:s', strtotime($vehicleDateFrom)) : null);
            $vehicle->setDateTo($vehicleDateTo ? date('Y-m-d\TH:i:s', strtotime($vehicleDateTo)) : null);
        } else {
            $vehicleDateFrom = G4PropertyAccess::getValue($raw, 'vehicle.booking_params.from');
            $vehicleDateTo = G4PropertyAccess::getValue($raw, 'vehicle.booking_params.to');
            $vehicleLocation = G4PropertyAccess::getValue($raw, 'vehicle.booking_params.location');
            $vehicle->setDateFrom($vehicleDateFrom ? date('Y-m-d', strtotime($vehicleDateFrom)) : null);
            $vehicle->setDateTo($vehicleDateTo ? date('Y-m-d', strtotime($vehicleDateTo)) : null);
            $vehicle->setLocation($this->populateLocationFromCode($vehicleLocation));
        }

        $request->setVehicle($vehicle);
    }

    /**
     * Enhance the provided cart request object with information about the vehicle upsell search info.
     *
     * @param CartRequest $request request
     * @param \stdClass   $raw     raw data
     *
     * @return void
     */
    public function enhanceVehicleUpsell(CartRequest $request, \stdClass $raw)
    {
        $vehicleUpsell = new CartRequest\Product\Component();

        $vehicleRentalObject = G4PropertyAccess::getValue($raw, 'vehicle_rental_period') ?: G4PropertyAccess::getValue($raw, 'vehicle_upsell');
        if ($vehicleRentalObject) {
            $vehicleDateFrom = G4PropertyAccess::getValue($vehicleRentalObject, 'from');
            $vehicleDateTo = G4PropertyAccess::getValue($vehicleRentalObject, 'to');
            $vehicleUpsell->setStartDate($vehicleDateFrom ? date('Y-m-d\TH:i:s', strtotime($vehicleDateFrom)) : null);
            $vehicleUpsell->setEndDate($vehicleDateTo ? date('Y-m-d\TH:i:s', strtotime($vehicleDateTo)) : null);

            $vehicleLocationCode = G4PropertyAccess::getValue($vehicleRentalObject, 'location');
            if ($vehicleLocationCode) {
                $location = $this->populateLocationFromCode($vehicleLocationCode);
                $marketDetails = $this->container->get('g4_lookup')->lookupMarketDetails(
                    $request->getDepartingFlight()->getDepartFrom(),
                    $request->getDepartingFlight()->getArriveAt()
                );

                if ($marketDetails->from->airport_code == $location->getCode()) {
                    $location->setId($marketDetails->from->location_id);
                } else {
                    $location->setId($marketDetails->to->location_id);
                }

                $vehicleUpsell->setLocation($location);
            }
        }

        $request->setVehicleUpsell($vehicleUpsell);
    }

    /**
     * Enhance the provided cart request object with information about the user chosen shuttle(s).
     *
     * @param CartRequest $request request
     * @param \stdClass                                 $raw     raw data
     *
     * @return void
     */
    public function enhanceShuttles(CartRequest $request, \stdClass $raw)
    {
        if (!isset($raw->shuttle) || !is_array($raw->shuttle) || !count($raw->shuttle)) {
            return;
        }
        foreach ($raw->shuttle as $userSelectedItem) {
            $item = new \G4\ShoppingCartBundle\Entity\CartRequest\Shuttle();
            $item->setOption($userSelectedItem->option);
            $item->setVariant($userSelectedItem->variant);
            $item->setQuantity($userSelectedItem->quantity);

            $request->addShuttle($item);
        }
    }

    /**
     * Enhance the provided cart request object with information about the user chosen attraction(s).
     *
     * @param CartRequest $request request
     * @param \stdClass                                 $raw     raw data
     *
     * @return void
     */
    public function enhanceAttractions(CartRequest $request, \stdClass $raw)
    {
        if (!isset($raw->attractions) || !is_array($raw->attractions) || !count($raw->attractions)) {
            return;
        }
        foreach ($raw->attractions as $userSelectedItem) {
            $item = new \G4\ShoppingCartBundle\Entity\CartRequest\Attraction();
            $item->setOption($userSelectedItem->option);
            $item->setVariant($userSelectedItem->variant);
            $item->setQuantity($userSelectedItem->quantity);

            $request->addAttraction($item);
        }
    }

    /**
     * Loads the vouchers into the Cart Request Object
     *
     * @param CartRequest $cartRequest The cart request object
     * @param \stdClass   $raw         Ajax input
     */
    public function enhanceVouchers(CartRequest $cartRequest, \stdClass $raw)
    {
        if (!isset($raw->vouchers) || !is_array($raw->vouchers) || !count($raw->vouchers)) {
            return;
        }

        foreach ($raw->vouchers as $rawVoucher) {
            $voucher = new CartRequest\VoucherCollection\Voucher();

            if (isset($rawVoucher->email)) {
                $voucher->setEmail($rawVoucher->email);
            }
            $voucher->setNumber(strtoupper($rawVoucher->number));
            if (isset($rawVoucher->type)) {
                $voucher->setType($rawVoucher->type);
            }

            $cartRequest->getVoucherCollection()->addVoucher($voucher);
        }
    }

    /**
     * Enhance Waived Fees
     *
     * @param CartRequest $cartRequest
     * @param \stdClass $raw
     */
    public function enhanceWaivedFees(CartRequest $cartRequest, \stdClass $raw)
    {
        if (!isset($raw->waivedFees) || !is_array($raw->waivedFees) || !count($raw->waivedFees) || !$this->container->get('g4_booking')->checkClientPermission(CustomerMappers::CUSTOMER_PERMISSION_WAIVE_FEES)) {
            return;
        }

        foreach ($raw->waivedFees as $fee) {
            $waivedFee = new ItemFee();
            $waivedFee->setCode($fee->code);
            if (isset($fee->waiveReason) && isset($fee->waiveReason->code) && (isset($fee->waiveReason->description))) {
                $waivedFee->getWaiveReason()->setCode($fee->waiveReason->code);
                $waivedFee->getWaiveReason()->setDescription($fee->waiveReason->description);

                $cartRequest->addWaivedFee($waivedFee);
            }
        }
    }

    /**
     * Populate Override Fares
     *
     * @param CartRequest $cartRequest The Cart Request Object
     * @param \stdClass   $raw         The raw data
     */
    public function enhanceOverrideFares(CartRequest $cartRequest, \stdClass $raw)
    {
        if (!isset($raw->overrideFares) || !is_object($raw->overrideFares)) {
            return;
        }

        $overrideFares = new CartRequest\OverrideFares();
        if (isset($raw->overrideFares->adjustedFareDeparting)) {
            $overrideFares->setAdjustedFareDeparting($raw->overrideFares->adjustedFareDeparting);
        }
        if (isset($raw->overrideFares->adjustedFareReturning)) {
            $overrideFares->setAdjustedFareReturning($raw->overrideFares->adjustedFareReturning);
        }

        if (isset($raw->overrideFares->reason)) {
            $overrideFares->getReason()->setCode($raw->overrideFares->reason->code);
            $overrideFares->getReason()->setDescription($raw->overrideFares->reason->description);
        }

        if (isset($raw->overrideFares->confirmation)) {
            $overrideFares->setConfirmation($raw->overrideFares->confirmation);
        }


        $cartRequest->setOverrideFares($overrideFares);
    }

    /**
     * Enhance the provided cart request object with information about the events user completed.
     *
     * @param CartRequest $cartRequest request
     * @param \stdClass                                 $rawObj      raw data
     *
     * @return void
     */
    public function enhanceEvents(CartRequest $cartRequest, \stdClass $rawObj)
    {
        $listEvents = array(
            'flightChoiceCompleted',
            'hotelChoiceCompleted',
            'vehicleChoiceCompleted',
            'shuttleChoiceCompleted',
            'attractionChoiceCompleted',
            'travellerDetailsCompleted',
            'paymentDetailsValidated',
            'flightExtrasCompleted',
            'bagSelectionValid',
            'tripFlexCompleted',
            'userInputCompleted',
            'flightChoiceValid'
        );

        foreach ($listEvents as $event) {
            if (isset($rawObj->$event)) {
                $cartRequest->setEventTimestamp($event, $rawObj->$event);
            }
        }
    }

    /**
     * Prepare the CartRequest object from the raw data Ajax sent us.
     *
     * @param \stdClass $rawObj data coming form Ajax
     *
     * @return CartRequest
     *
     * @throws InvalidCartRequest
     */
    public function populateCartRequest(\stdClass $rawObj)
    {
        $cartRequest = new CartRequest();
        $cartRequest->setId($rawObj->id);
        $cartRequest->setSearchHash($rawObj->search_hash);
        $this->enhanceFlights($cartRequest, $rawObj);

        $this->enhanceHotel($cartRequest, $rawObj);
        if (isset($rawObj->attractions) && is_array($rawObj->attractions)) {
            $cartRequest->setAttractions($this->populateAttractions($rawObj->attractions));
        }

        $this->enhanceHotelUpsell($cartRequest, $rawObj);
        $this->enhanceVehicleUpsell($cartRequest, $rawObj);
        $this->enhanceVehicle($cartRequest, $rawObj);
        $this->enhanceShuttles($cartRequest, $rawObj);

        if (isset($rawObj->travellers) && is_array($rawObj->travellers)) {
            $cartRequest->setTravellers($this->populateTravellerDetails($rawObj->travellers));
        }
        if (isset($rawObj->payment_details) && is_object($rawObj->payment_details)) {
            $cartRequest->setPaymentDetails($this->populatePaymentDetails($rawObj->payment_details));
        }

        $cartRequest->setFlightComboId($rawObj->flightcomboid);

        $this->enhanceSearchParams($cartRequest, $rawObj);

        if (isset($rawObj->search_params->travelers)) {
            $cartRequest->getSearchParams()->setTravelers(
                $this->populateTravelersSearch(
                    $rawObj->search_params->travelers,
                    new \DateTime($cartRequest->getOutwardTakeOffDate())
                )
            );
        }

        $this->enhanceAdditionalFees($cartRequest, $rawObj);
        $this->enhanceVouchers($cartRequest, $rawObj);
        $this->enhanceOverrideFares($cartRequest, $rawObj);
        $this->enhanceWaivedFees($cartRequest, $rawObj);

        $cartRequest->setEvent($rawObj->saveTriggerEvent);
        $this->enhanceEvents($cartRequest, $rawObj);

        $cartId = $cartRequest->getSearchParams()->getCartId();
        if (!strlen($cartRequest->getId()) || $cartId != $cartRequest->getId()) {
            throw new InvalidCartRequest(sprintf(
                'IDs do not match:%s = %s, working on %s',
                $cartId,
                $cartRequest->getId(),
                print_r($rawObj, true)
            ));
        }
        if (!strlen($cartRequest->getEvent())) {
            throw new InvalidCartRequest(sprintf('Invalid event %s', $cartRequest->getEvent()));
        }

        return ($cartRequest);
    }

    /**
     * Prepare the SearchParams from the raw data that the user submitted
     *
     * @param \stdClass $params     User's search params as extracted from the json decoder
     * @param string    $manifestId the search hash
     *
     * @throws \G4\UtilBundle\Exception\InvalidCartRequest
     * @return \G4\ShoppingCartBundle\Entity\CartRequest\SearchParams
     */
    public function populateSearchParams(\stdClass $params, $manifestId = '')
    {
        $searchParams = new \G4\ShoppingCartBundle\Entity\CartRequest\SearchParams();
        $searchParams->setOutwardDate($params->outward);
        $searchParams->setReturningDate($params->returning);

        $origin = $this->populateLocation($params->origin);
        $destination = $this->populateLocation($params->destination);
        $marketDetails = $this->container->get('g4_lookup')->lookupMarketDetails(
            $origin->getCode(),
            $destination->getCode()
        );
        $origin->setId($marketDetails->from->location_id);
        $destination->setId($marketDetails->to->location_id);
        $searchParams->setMarketId($marketDetails->id);
        $searchParams->setOrigin($origin);
        $searchParams->setDestination($destination);

        $searchParams->setNrRooms($params->rooms);
        $searchParams->setDirection($params->direction);

        if (isset($params->default_trip_length)) {
            $searchParams->setDefaultTripLength($params->default_trip_length);
        }

        if (isset($params->vehicle)) {
            $searchParams->setVehicleName($params->vehicle);
        }

        if (isset($params->{"flight_pagination"})) {
            $searchParams->setFlightPagination($this->populateFlightPagination($params->{"flight_pagination"}));
        }

        $this->enhanceMetaData($searchParams, $params);

        if (!isset($params->product->components)) {
            throw new InvalidCartRequest(sprintf('No valid product components %s', print_r($params, true)));
        }

        $this->enhanceSearchComponents($searchParams, $params);
        if (isset($params->travelers)) {
            $searchParams->setTravelers(
                $this->populateTravelersSearch(
                    $params->travelers,
                    new \DateTime($searchParams->getOutwardDate())
                )
            );
        }

        $searchParams->setBookingTypeId(
            $this->container->get('g4_lookup')->lookupBookingTypeId(
                implode($searchParams->getSearchedComponents())
            )
        );

        if (isset($params->preselected)) {
            $searchParams->setPreselected($this->populatePreselected($params->preselected, $searchParams));
        }

        /**
         * we will lookup for a requestSourceId, from the deepLinkSource, so no need for us to validate this value.
         */
        if (isset($params->deepLinkSource)) {
            $searchParams->setDeepLinkSource($params->deepLinkSource);
        }

        if (strlen($manifestId)) {
            $searchParams->setManifestId($manifestId);
        }

        if (isset($params->utmCampaign)) {
            $searchParams->setUtmCampaign($params->utmCampaign);
        }

        if (isset($params->utmContent)) {
            $searchParams->setUtmContent($params->utmContent);
        }

        if (isset($params->utmMedium)) {
            $searchParams->setUtmMedium($params->utmMedium);
        }

        if (isset($params->utmSource)) {
            $searchParams->setUtmSource($params->utmSource);
        }

        if (isset($params->role)) {
            $searchParams->setRole($params->role);
        }

        if (isset($params->travelAgentName)) {
            $searchParams->setTravelAgentName($params->travelAgentName);
        }

        if (isset($params->travelAgentIataNumber)) {
            $searchParams->setTravelAgentIATANumber($params->travelAgentIataNumber);
        }

        if (isset($params->travelAgentPermissions)) {
            $searchParams->setTravelAgentPermissions($params->travelAgentPermissions);
        }

        if (isset($params->travelAgentId)) {
            $searchParams->setTravelAgentId($params->travelAgentId);
        }

        if (isset($params->httpUserAgent)) {
            $searchParams->setHttpUserAgent($params->httpUserAgent);
        }

        return $searchParams;
    }

    /**
     * Enhance the provided search params object with information about the user selected components.
     *
     * @param \G4\ShoppingCartBundle\Entity\CartRequest\SearchParams $searchParams search params
     * @param \stdClass                                              $params       raw search data
     *
     * @return void
     */
    public function enhanceSearchComponents(
        \G4\ShoppingCartBundle\Entity\CartRequest\SearchParams $searchParams,
        \stdClass $params
    )
    {
        $allComponents = array_keys(\G4\UtilBundle\Controller\G4Controller::$filterMapping);
        foreach ($allComponents as $type) {
            if (!isset($params->product->components->{$type})) {
                continue;
            }
            $item = new \G4\ShoppingCartBundle\Entity\CartRequest\Product\Component();
            $item->setType($type);
            $item->setMode($params->product->components->{$type}->mode);
            $item->setStartDate($searchParams->getOutwardDate());
            $item->setEndDate($searchParams->getReturningDate());

            $defaultTripLength = $this->getComponentDefaultTripLength($type);
            if ($searchParams->getReturningDate() == null && !is_null($defaultTripLength)) {
                $endDateTimestamp = strtotime($item->getStartDate()) + $defaultTripLength ;
                $item->setEndDate(date('Y-m-d', $endDateTimestamp));
            }

            $searchParams->addComponent($item);
        }
    }

    private function getComponentDefaultTripLength($type)
    {
        $tripLength = null;
        switch ($type) {
            case G4Controller::_KEY_VEHICLE:
                $tripLength =  $this->container->getParameter('g4_booking.vehicle_upsell_period');
                break;
            case G4Controller::_KEY_HOTEL:
                $tripLength =  $this->container->getParameter('g4_booking.hotel_upsell_period');
                break;
            case G4Controller::_KEY_PRODUCT:
                $tripLength = $this->container->getParameter('g4_product.search_criteria.oneway_estimated_return_date');
                break;
            default:
                break;
        }


        return $tripLength ? $tripLength * 24 * 3600 : null;


    }

    /**
     * Prepare the Location from the raw data that the user submitted
     *
     * @param \stdClass $raw User's location in the search params as extracted from the json decoder
     *
     * @return CartRequest\Location
     */
    public function populateLocation(\stdClass $raw)
    {
        $location = new CartRequest\Location();
        $location->setCity($raw->city);
        $location->setCode($raw->code);
        if (isset($raw->state)) {
            $location->setState($raw->state);
        }
        if (isset($raw->id)) {
            $location->setId($raw->id);
        }

        return $location;
    }

    /**
     * Creates a location object with the code specified
     * @param $code
     *
     * @return CartRequest\Location
     */
    public function populateLocationFromCode($code)
    {
        $location = new CartRequest\Location();
        $location->setCode($code);

        return $location;
    }

    /**
     * Create and populate flightPagination object
     * @param \stdClass $raw
     *
     * @return \G4\ShoppingCartBundle\Entity\CartRequest\SearchParams\FlightPagination
     */
    public function populateFlightPagination(\stdClass $raw)
    {
        $flightPagination = new \G4\ShoppingCartBundle\Entity\CartRequest\SearchParams\FlightPagination();
        $flightPagination->setLeg($raw->leg);
        $flightPagination->setFrom($raw->from);
        $flightPagination->setTo($raw->to);

        return $flightPagination;
    }

    /**
     * Prepare the Travelers from the raw data that user submitted
     *
     * @param stdClass  $raw        user's traveler request details
     * @param \DateTime $departDate time of departure
     *
     * @return \G4\ShoppingCartBundle\Entity\CartRequest\SearchParams\Travelers
     */
    public function populateTravelersSearch($raw, \DateTime $departDate)
    {
        $travelers = new \G4\ShoppingCartBundle\Entity\CartRequest\SearchParams\Travelers();
        $travelers->setNrAdults((int)$raw->adult);
//        $travelers->setChildAges($raw->child);

        if (isset($raw->{'child-dob'})) {
            $travelers->setChildDob($raw->{'child-dob'});

            // info below moved over from TravelerBookingController :: processTravellers()
            $ages = array();
            foreach ($raw->{'child-dob'} as $dob) {
                $ages[] = $travelers->getChildAge($dob, $departDate);
            }
            sort($ages, SORT_NUMERIC);

            $travelers->setChildAges($ages);

        } else {
            if (isset($raw->childDob)) {
                $travelers->setChildDob($raw->childDob);
                $travelers->setChildAges($raw->child);

            } else {
                if (isset($raw->child) && is_array($raw->child)) {
                    // info below moved over from TravelerBookingController :: processTravellers()
                    $dobs = array();
                    foreach ($raw->child as $age) {
                        $dobs[] = $travelers->estimateChildDob($age, $departDate);
                    }
                    $travelers->setChildDob($dobs);
                    $travelers->setChildAges($raw->child);

                }
            }
        }

        if (isset($raw->estimatedAges)) {
            $travelers->setEstimatedAges($raw->estimatedAges);
        }

        return $travelers;
    }

    /**
     * Enhance the provided search parameters object with metadata.
     *
     * @param \G4\ShoppingCartBundle\Entity\CartRequest\SearchParams $search search params
     * @param \stdClass                                              $raw    raw search data
     *
     * @return void
     */
    public function enhanceMetaData(\G4\UtilBundle\Entity\ServiceParams $search, \stdClass $raw)
    {
        $search->setSessionId($raw->sessionID);

        if (isset($raw->timestamp)) {
            $search->setTimestamp($raw->timeStamp);
        }

        $search->setClientIp($this->container->get('g4_container')->getClientIP());

        if (isset($raw->transactionIdentifier)) {
            $search->setTransactionId($raw->transactionIdentifier);
        } else {
            if (isset($raw->transactionID)) {
                $search->setTransactionId($raw->transactionID);
            }
        }


        if (isset($raw->cartID)) {
            $search->setCartId($raw->cartID);
        }

        if (isset($raw->bookingTypeID)) {
            $search->setBookingTypeId($raw->bookingTypeID);
        }
    }

    /**
     * Prepare the travellers array
     *
     * @param array $raw
     *
     * @return array
     */
    public function populateTravellerDetails(array $raw)
    {
        $travellers = array();

        foreach ($raw as $item) {
            $traveller = new \G4\ShoppingCartBundle\Entity\CartRequest\Traveller();
            $traveller->setId($item->id);
            $traveller->setCustomerId(isset($item->customerId) ? $item->customerId : null);
            $traveller->setCategory($item->category);
            $traveller->setRequests($item->requests);
            $traveller->setBags($item->bags);
            $traveller->setFirstName(isset($item->firstname) ? $item->firstname : null);
            $traveller->setLastName(isset($item->lastname) ? $item->lastname : null);
            // most of the properties below become set only at later stages of the booking process
            $traveller->setMiddleNames(isset($item->middlenames) ? $item->middlenames : null);
            $traveller->setSuffix(isset($item->suffix) ? $item->suffix : null);
            $traveller->setDobRaw(isset($item->dob) ? $item->dob : null);
            $traveller->setDobClean(isset($item->clean_dob) ? $item->clean_dob : null);
            $traveller->setRedress(isset($item->redress) ? $item->redress : null);
            $traveller->setEmail(isset($item->email) ? $item->email : null);
            $traveller->setBinBags(isset($item->bin_bags) ? $item->bin_bags : null);
            $traveller->setPriorityBoarding(
                isset($item->priority_boarding_selected) ? $item->priority_boarding_selected : null
            );
            $traveller->setGender(isset($item->gender) ? $item->gender : null);

            if (isset($item->departing_seat)) {
                $traveller->setSeatDeparting($this->populateSeat($item->departing_seat));
            }

            if (isset($item->returning_seat)) {
                $traveller->setSeatReturning($this->populateSeat($item->returning_seat));
            }

            if (isset($item->seat)) {
                $traveller->setSeat($this->populateSeat($item->seat));
            }

            if (isset($item->phone)) {
                $traveller->setPhone($item->phone);
            }

            $travellers[] = $traveller;
        }

        return $travellers;
    }

    /**
     * Prepare the seat data
     *
     * @param \stdClass $raw
     *
     * @return \G4\ShoppingCartBundle\Entity\CartRequest\Seat
     */
    public function populateSeat(\stdClass $raw)
    {
        $seat = new \G4\ShoppingCartBundle\Entity\CartRequest\Seat();
        $seat->setId($raw->id);
        $seat->setType($raw->type);
        $seat->setAvailable($raw->available);
        $seat->setExitRow($raw->exit_row);
        $seat->setPrice($raw->price);
        $seat->setPremium($raw->premium);
        $seat->setPosition($raw->seat_position);

        return $seat;
    }

    /**
     * Populate Additional Fees
     *
     * @param CartRequest $cartRequest The Cart Request Object
     * @param \stdClass   $raw         The raw data
     */
    public function enhanceAdditionalFees(CartRequest $cartRequest, \stdClass $raw)
    {
        if (!isset($raw->additional_fees) || !is_array($raw->additional_fees)) {
            return;
        }

        $additionalFees = new AdditionalFees();
        foreach ($raw->additional_fees as $fee) {
            $foundFee = $this->container->get('g4_booking')->findAdditionalFeeFromMemcache($cartRequest, $fee);
            if ($foundFee) {
                $additionalFees->addAdditionalFee($foundFee);
            }
        }

        $cartRequest->setAdditionalFees($additionalFees);
    }


    /**
     * Prepare the payment details
     *
     * @param \stdClass $raw
     *
     * @return \G4\ShoppingCartBundle\Entity\CartRequest\Payment
     */
    public function populatePaymentDetails(\stdClass $raw)
    {
        $payment = new \G4\ShoppingCartBundle\Entity\CartRequest\Payment();
        $payment->setTripFlex(isset($raw->tripflex) ? $raw->tripflex : null);
        $payment->setTermsConditions(isset($raw->terms_accepted) ? $raw->terms_accepted : false);
        $payment->setOptedForMarketing(isset($raw->opt_in_marketing) ? $raw->opt_in_marketing : false);
        // data below is only present at last step
        $payment->setCardType(isset($raw->card_type) ? $raw->card_type : null);
        $payment->setCardNo(isset($raw->card_no) ? $raw->card_no : null);
        $payment->setCardExpMonth(isset($raw->expires_month) ? $raw->expires_month : null);
        $payment->setCardExpYear(isset($raw->expires_year) ? $raw->expires_year : null);
        $payment->setCardCcv(isset($raw->ccv) ? $raw->ccv : null);
        $payment->setHolderFirstName(isset($raw->first_name) ? $raw->first_name : null);
        $payment->setHolderLastName(isset($raw->last_name) ? $raw->last_name : null);
        $payment->setHolderName(isset($raw->name_on_card) ? $raw->name_on_card : null);
        $payment->setHolderAddr1(isset($raw->addr1) ? $raw->addr1 : null);
        $payment->setHolderAddr2(isset($raw->addr2) ? $raw->addr2 : null);
        $payment->setHolderCity(isset($raw->city) ? $raw->city : null);
        $payment->setHolderState(isset($raw->state) ? $raw->state : null);
        $payment->setHolderCountry(isset($raw->country) ? $raw->country : null);
        $payment->setHolderPostcode(isset($raw->postcode) ? $raw->postcode : null);
        $payment->setHolderPhone(isset($raw->phone) ? $raw->phone : null);
        $payment->setHolderEmail(isset($raw->email) ? $raw->email : null);
        $payment->setPassword(isset($raw->password) ? $raw->password : null);
        $payment->setPaymentMethod(isset($raw->payment_method) ? $raw->payment_method : null);
        $payment->setComments(isset($raw->comments) ? $raw->comments : null);

        return $payment;
    }

    /**
     * Populates the attractions user has selected
     *
     * @param array $rawItems
     *
     * @return array
     */
    public function populateAttractions(array $rawItems)
    {
        $attractions = array();

        foreach ($rawItems as $item) {
            $attr = new \G4\ShoppingCartBundle\Entity\CartRequest\Attraction();
            $attr->setOption($item->option);
            $attr->setVariant($item->variant);
            $attr->setQuantity($item->quantity);

            $attractions[] = $attr;
        }

        return $attractions;
    }

    /**
     * Prepare the service params for the provided $type individual service.
     *
     * @param \stdClass $rawObj raw data
     * @param string    $type   service type
     *
     * @return \G4\ShoppingCartBundle\Entity\CartRequest\SearchParams
     */
    public function populateServiceParams(\stdClass $rawObj, $type)
    {
        $searchParams = new \G4\ShoppingCartBundle\Entity\CartRequest\SearchParams();

        switch ($type) {
            case \G4\UtilBundle\Controller\G4Controller::_SEATMAP :
                $searchParams->flights = $rawObj->flights;
                break;
            case \G4\UtilBundle\Controller\G4Controller::_HOTEL :
                $searchParams->rooms = $rawObj->rooms;
                break;
            case \G4\UtilBundle\Controller\G4Controller::_GET_ORDER :
            case \G4\UtilBundle\Controller\G4Controller::_JOURNEY :
                return $this->populateCheckinParams($rawObj);
            case \G4\UtilBundle\Controller\G4Controller::_CHECKIN_BEGIN :
                return $this->populateBeginCheckinParams($rawObj);
            case \G4\UtilBundle\Controller\G4Controller::_CHECKIN_COMPLETE :
                return $this->populateCheckinCompleteParams($rawObj);
            case \G4\UtilBundle\Controller\G4Controller::_REQUEST_SEAT :
                return $this->populateRequestSeatParams($rawObj);
            case \G4\UtilBundle\Controller\G4Controller::_KAYAK_FLIGHT :
                //check for iata faa translations
                $fromCode = $rawObj->origin->code;
                $toCode = $rawObj->destination->code;

                $airportCodes = $this->container->getParameter("g4_flight_airports");
                if (isset($airportCodes["IATA"][$fromCode])) {
                    $fromCode = $airportCodes["IATA"][$fromCode];
                }
                if (isset($airportCodes["IATA"][$toCode])) {
                    $toCode = $airportCodes["IATA"][$toCode];
                }

                $rawObj->origin = new \stdClass();
                $rawObj->origin->code = $fromCode;
                $rawObj->destination = new \stdClass();
                $rawObj->destination->code = $toCode;
                $rawObj->origin->city = '';
                $rawObj->destination->city = '';
                $rawObj->origin->state = '';
                $rawObj->destination->state = '';
                $rawObj->bookingTypeID = 1;
                $rawObj->clientIP = $this->container->get('request')->getClientIp();
                $rawObj->deepLinkSource = $this->container->getParameter('g4_flight_kayak.request_source');

                $transactionIdentifier = $this->container->get('request')->query->get('transactionIdentifier');
                $rawObj->transactionIdentifier = $transactionIdentifier ? : uniqid();
                $rawObj->cartID = uniqid();

                $marketDetails = $this->container->get('g4_lookup')->lookupMarketDetails(
                    $fromCode,
                    $toCode
                );

                // TODO lookup market ID
                $rawObj->marketID = $marketDetails->id;
                break;
            case \G4\UtilBundle\Controller\G4Controller::_LEGACY_CUSTOMER_NBR :
                return $this->populateLegacyCustomerNbrParams($rawObj);
            default :
                break;
        }

        if (isset($rawObj->destination) && !is_null($rawObj->destination)) {
            $searchParams->setDestination($this->populateLocation($rawObj->destination));
        }
        $searchParams->setOutwardDate(isset($rawObj->outward) ? $rawObj->outward : null);
        $searchParams->setReturningDate(isset($rawObj->returning) ? $rawObj->returning : null);

        if (isset($rawObj->origin) && !is_null($rawObj->origin)) {
            $searchParams->setOrigin($this->populateLocation($rawObj->origin));
        }
        if (isset($rawObj->travelers)) {
            $searchParams->setTravelers(
                $this->populateTravelersSearch(
                    $rawObj->travelers,
                    new \DateTime($searchParams->getOutwardDate())
                )
            );
        }
        $searchParams->setDirection(isset($rawObj->direction) ? $rawObj->direction : null);

        $searchParams->setVehicleName(isset($rawObj->vehicle) ? $rawObj->vehicle : null);
        if (isset($rawObj->marketID)) {
            $searchParams->setMarketId($rawObj->marketID);
        }

        /**
         * deeplink parameters
         */
        if (isset($rawObj->deepLinkSource)) {
            $searchParams->setDeepLinkSource($rawObj->deepLinkSource);
        }

        /**
         * flight paginator parameters.
         *
         * fetchAdditional flags if we should append or replace the results in persister
         * leg specifies the direction of the serach (departing or returning)
         * plusDays specifies the number of additional days to search for
         */
        if (isset($rawObj->fetchAdditional)) {
            $searchParams->setFetchAdditional($rawObj->fetchAdditional);
        }

        if (isset($rawObj->leg)) {
            $searchParams->setLeg($rawObj->leg);
        }

        if (isset($rawObj->plusDays)) {
            $searchParams->setPlusDays($rawObj->plusDays);
        }

        /**
         * kayak search parameters
         *
         * plusminus is a collection of 4 values for departing minus/plus and returning minus/plus
         */
        if (isset($rawObj->plusminus)) {
            $searchParams->setPlusMinusDays($this->populatePlusMinusDays($rawObj->plusminus));
        }
        $this->enhanceMetaData($searchParams, $rawObj);

        return $searchParams;
    }

    /**
     * @param \stdClass $params
     *
     * @return \G4\ProfileBundle\Entity\LegacyCustomerNbrParams
     */
    public function populateLegacyCustomerNbrParams(\stdClass $params)
    {
        $serviceParams = new \G4\ProfileBundle\Entity\LegacyCustomerNbrParams();
        $this->enhanceMetaData($serviceParams, $params);
        $serviceParams->setEmail($params->email);
        $serviceParams->setFirstName($params->firstName);
        $serviceParams->setLastName($params->lastName);
        $serviceParams->setStreetAddress1($params->streetAddress1);
        $serviceParams->setZipCode($params->zipCode);

        return $serviceParams;
    }

    /**
     * Prepare the CartRequest object from the raw data Ajax sent us.
     *
     * @param \stdClass $raw data coming form Ajax
     *
     * @return \G4\CheckInBundle\Entity\JourneyRequest
     *
     * @throws InvalidCartRequest
     */
    public function populateJourneyRequest(\stdClass $raw)
    {
        $request = new \G4\CheckInBundle\Entity\JourneyRequest();

        if (isset($raw->check_in_journey)) {
            $this->enhanceCheckinJourney($request, $raw->check_in_journey);
        }

        if (isset($raw->seatPlan)) {
            $request->setSeatmap($raw->seatPlan);
        }


        if (isset($raw->checkinParams)) {
            $request->setCheckinParams($this->populateCheckinParams($raw->checkinParams));
        }

        if (isset($raw->saveTriggerEvent)) {
            $request->setEvent($raw->saveTriggerEvent);
        }

        if (isset($raw->paymentDetails) && is_object($raw->paymentDetails)) {
            $request->setPaymentDetails($this->populatePaymentDetails($raw->paymentDetails));
        }


        return $request;
    }

    /**
     * Prepare the SearchParams from the raw data that the user submitted
     *
     * @param \stdClass $params User's search params as extracted from the json decoder
     *
     * @return \G4\ShoppingCartBundle\Entity\CartRequest\SearchParams
     */
    public function populateCheckinParams(\stdClass $params)
    {
        $checkinParams = new \G4\CheckInBundle\Entity\CheckinParams();

        $this->enhanceCheckinMetadata($checkinParams, $params);
        $checkinParams->setConfCode(trim(strtoupper($params->confCode)));
        $checkinParams->setFirstName(trim($params->firstName));
        $checkinParams->setLastName(trim($params->lastName));

        return $checkinParams;
    }

    /**
     * Prepare the SearchParams of the begin checkin service
     *
     * @param stdClass $raw
     *
     * @return \G4\CheckInBundle\Entity\ServiceParams\BeginCheckin
     */
    public function populateBeginCheckinParams(\stdClass $raw)
    {
        $params = new \G4\CheckInBundle\Entity\ServiceParams\BeginCheckin();
        $params->setConfNbr($raw->confNbr);
        $params->setJourneyId($raw->journeyId);
        $params->setDirection($raw->direction);

        $this->enhanceCheckinMetadata($params, $raw);

        return $params;
    }

    /**
     * populate Checkin Params
     * @param \stdClass $params
     */
    public function populateCheckinCompleteParams(\stdClass $params)
    {
        $completeCheckin = new \G4\CheckInBundle\Entity\ServiceParams\CompleteCheckin();
        $this->enhanceCheckinMetadata($completeCheckin, $params);

        foreach ($params->travelersId as $travelerId) {
            $completeCheckin->addTravelerId($travelerId);
        }
        $completeCheckin->setJourneyId($params->journeyId);

        return $completeCheckin;
    }

    /**
     * populate RequestSeat Params
     *
     * @param \stdClass $params
     *
     * @return \G4\CheckInBundle\Entity\ServiceParams\RequestSeat
     */
    public function populateRequestSeatParams(\stdClass $params)
    {
        $requestSeat = new \G4\CheckInBundle\Entity\ServiceParams\RequestSeat();
        $this->enhanceCheckinMetadata($requestSeat, $params);

        foreach ($params->requestedSeats as $seat) {
            $requestSeat->addRequestedSeat($seat);
        }

        $requestSeat->setConfCode($params->confCode);

        if (isset($params->id)) {
            $requestSeat->setId($params->id);
        }

        return $requestSeat;
    }

    /**
     * Create FlightTravelerCheckInResult and populate with json object
     * @param array $raw Raw json object
     *
     * @return \G4\AREBundle\Entity\com\allegiant\are\dto\flight\FlightTravelerCheckInResult
     */
    public function populateAreTravelerCheckinResult(array $raw)
    {
        $travelerCheckinResult = new \G4\AREBundle\Entity\com\allegiant\are\dto\flight\FlightTravelerCheckInResult();
        $travelerCheckinResult->setFlightTravelerId($raw['flightTravelerId']);
        $travelerCheckinResult->setJourneyId($raw['journeyId']);
        $travelerCheckinResult->setResultCode($raw['resultCode']);
        if (isset($raw['boardingPass'])) {
            $travelerCheckinResult->setBoardingPass($this->populateAreBoardingPass($raw['boardingPass']));
        }

        return $travelerCheckinResult;
    }

    /**
     * Populate boardingPass ticket
     * @param array $raw Raw stdClass object
     *
     * @return \G4\AREBundle\Entity\com\allegiant\are\dto\flight\BoardingPass
     */
    public function populateAreBoardingPass(array $raw)
    {
        $boardingPass = new \G4\AREBundle\Entity\com\allegiant\are\dto\flight\BoardingPass($raw['arriveAirportCode']);
        $boardingPass->setArriveAirportCode($raw['departAirportCode']);
        $boardingPass->setArriveAirportName($raw['departAirportName']);
        $boardingPass->setArriveCityState($raw['arriveCityState']);
        $boardingPass->setArriveDateTime($raw['arriveDateTime']);
        ;
        $boardingPass->setBarcodeData($raw['barcodeData']);
        $boardingPass->setBoardDateTime($raw['boardDateTime']);
        $boardingPass->setBoardZone($raw['boardZone']);
        $boardingPass->setDepartAirportCode($raw['departAirportCode']);
        $boardingPass->setDepartAirportName($raw['departAirportName']);
        $boardingPass->setDepartCityState($raw['departCityState']);
        $boardingPass->setDepartDateTime($raw['departDateTime']);
        $boardingPass->setFirstName($raw['firstName']);
        $boardingPass->setFlightNbr($raw['flightNbr']);
        $boardingPass->setGateNbr($raw['gateNbr']);
        $boardingPass->setIsPriorityBoarding($raw['isPriorityBoarding']);
        $boardingPass->setItineraryNbr($raw['itineraryNbr']);
        $boardingPass->setLastName($raw['lastName']);
        $boardingPass->setMsg1($raw['msg1']);
        $boardingPass->setMsg2($raw['msg2']);
        $boardingPass->setMsg3($raw['msg3']);
        $boardingPass->setSeatNbr($raw['seatNbr']);
        $boardingPass->setTicketInfo($raw['ticketInfo']);
        $boardingPass->setTravelerId($raw['travelerId']);

        return $boardingPass;
    }

    /**
     * Enhance the service parameters with the corresponding metadata.
     *
     * @param ServiceParams $params
     * @param stdClass $raw
     *
     * @return void
     */
    public function enhanceCheckinMetadata(\G4\UtilBundle\Entity\ServiceParams $params, \stdClass $raw)
    {
        if (!isset($raw->sessionID)) {
            $params->setSessionId('DEMO_SESSION');
            $params->setClientIp('127.0.0.1');
            $params->setTransactionId('DEMO_TRANSACTION_ID');
            $params->setBookingTypeId(1);
            $params->setTimestamp(123456789);

            return;
        }
        $params->setSessionId($raw->sessionID);
        if (isset($raw->clientIp)) {
            $params->setClientIp($raw->clientIP);
        } else {
            //fallback to g4_container info
            $params->setClientIp($this->container->get('g4_container')->getClientIp());
        }
        $params->setTransactionId($raw->transactionIdentifier);
        $params->setBookingTypeId(1);
        if (isset($raw->timeStamp)) {
            $params->setTimestamp($raw->timeStamp);
        }
    }

    /**
     * Enhance the provided cart request object with information about the user chosen flights.
     *
     * @param \G4\CheckInBundle\Entity\JourneyRequest $request request
     * @param \stdClass                                   $raw     raw data
     *
     * @return void
     */
    public function enhanceCheckinJourney(\G4\CheckInBundle\Entity\JourneyRequest $request, \stdClass $flightData)
    {
        $flight = new \G4\CheckInBundle\Entity\JourneyRequest\Flight();
        $flight->setJourneyId($flightData->journeyId);
        $flight->setAirline($flightData->airline_code);
        $flight->setFlightNbr($flightData->flight_no);
        $flight->setDeparture($flightData->departsTime);
        $flight->setId($flightData->id);
        $flight->setDeparts($flightData->departs);
        $flight->setArrives($flightData->arrives);
        $flight->setOrigin($flightData->origin);
        $flight->setDestination($flightData->destination);
        $flight->setStops($flightData->stops);
        $flight->setCarryOnBag($flightData->carry_on_bag);
        $flight->setAirportBag($flightData->airport_bag);
        $flight->setBagPricing($flightData->bag_pricing);
        $flight->setPriorityBoardingPrice($flightData->priority_boarding_price);

        if (isset($flightData->travellers)) {
            $flight->setTravelers(
                $this->populateCheckinTraveller($flightData->travellers, $flightData->flight_no, $flightData->departs)
            );
        }

        $request->setCheckInJourney($flight);
    }


    /**
     * Prepare the travellers array
     *
     * @param array  $raw             traveler data
     * @param string $flightNbr       flight number
     * @param string $departDateTime  depart datetime
     *
     * @return array
     */
    public function populateCheckinTraveller(array $raw, $flightNbr = null, $departDateTime = null)
    {
        $travelers = array();
        foreach ($raw as $item) {
            $traveller = new \G4\CheckInBundle\Entity\JourneyRequest\Traveller();

            $traveller->setId($item->id);
            $traveller->setCategory(isset($item->category) ? $item->category : null);
            $traveller->setRequests(isset($item->requests) ? $item->requests : array());
            $traveller->setBags(isset($item->checked_bags) ? $item->checked_bags : null);
            $traveller->setFirstName(isset($item->firstname) ? $item->firstname : null);
            $traveller->setLastName(isset($item->lastname) ? $item->lastname : null);
            $traveller->setEmail(isset($item->email) ? $item->email : null);
            // most of the properties below become set only at later stages of the booking process
            $traveller->setMiddleNames(isset($item->middlenames) ? $item->middlenames : null);
            $traveller->setSuffix(isset($item->suffix) ? $item->suffix : null);
            $traveller->setDobRaw(isset($item->dob) ? $item->dob : null);
            $traveller->setDobClean(isset($item->clean_dob) ? $item->clean_dob : null);
            $traveller->setBinBags(isset($item->bin_bags) ? $item->bin_bags : null);
            $traveller->setGender(isset($item->gender) ? $item->gender : null);
            $traveller->setCheckInState(isset($item->{"check_in_state"}) ? $item->{"check_in_state"} : null);
            $traveller->setPriorityBoarding(
                isset($item->{"priority_boarding_selected"}) ? $item->{"priority_boarding_selected"} : false
            );
            $traveller->setEligibleForCheckin($item->eligible_for_checkin);
            $traveller->setEligibleForSeat($item->eligible_for_seat);
            $traveller->setBagPricing($item->bag_pricing); // the bag pricing MUST be at traveller level
            $traveller->setCarryOnBagPricing(isset($item->{'carry_on_bag'}) ? $item->{'carry_on_bag'} : array());
            $traveller->setPriorityBoardingPricing(
                isset($item->{'priority_boarding_price'}) ? $item->{'priority_boarding_price'} : 0.0
            );
            $traveller->setRph(isset($item->rph) ? $item->rph : null);

            $seat = new \G4\CheckInBundle\Entity\JourneyRequest\Seat();
            if (isset($item->seat)) {
                $seat->setId($item->seat->id);
                $seat->setMode(isset($item->seat->mode) ? $item->seat->mode : null);
                $seat->setFlightNbr(!is_null($flightNbr) ? $flightNbr : $item->seat->flight_no);
                $seat->setDepartDate(
                    substr(!is_null($departDateTime) ? $departDateTime : $item->seat->depart_date, 0, 10)
                );
                $seat->setTravellerId($item->id);
                $seat->setAmountPaid(isset($item->seat->paid) ? $item->seat->paid : 0.0);

                if (isset($item->seat->price)) {
                    $seat->setPrice($item->seat->price);
                }
            }
            $traveller->setSeat($seat);
            $travelers[] = $traveller;
        }

        return $travelers;
    }

    /**
     * @param \stdClass $raw
     * @param \G4\ShoppingCartBundle\Entity\CartRequest\SearchParams $seachParams
     *
     * @return \G4\ShoppingCartBundle\Entity\CartRequest\SearchParams\Preselected
     */
    public function populatePreselected(
        \stdClass $raw,
        \G4\ShoppingCartBundle\Entity\CartRequest\SearchParams $seachParams
    )
    {

        $preselected = new \G4\ShoppingCartBundle\Entity\CartRequest\SearchParams\Preselected();
        $preselected->setFlight(new \G4\ShoppingCartBundle\Entity\CartRequest\SearchParams\Preselected\Flight());

        try {
            if (isset($raw->flight->departing)) {
                $preselected->getFlight()->setDeparting(
                    sprintf(
                        '%s-%s_%s-%s_%s',
                        $raw->flight->departing->code,
                        $raw->flight->departing->nbr,
                        $seachParams->getOrigin()->getCode(),
                        $seachParams->getDestination()->getCode(),
                        strtotime((sprintf('%sT%s', $seachParams->getOutwardDate(), "00:00:00")))
                    )
                );
            }

            if (isset($raw->flight->returning)) {
                $preselected->getFlight()->setReturning(
                    sprintf(
                        '%s-%s_%s-%s_%s',
                        $raw->flight->returning->code,
                        $raw->flight->returning->nbr,
                        $seachParams->getDestination()->getCode(),
                        $seachParams->getOrigin()->getCode(),
                        strtotime((sprintf('%sT%s', $seachParams->getReturningDate(), "00:00:00")))
                    )
                );
            } else {
                //very ugly fix. we dont sned ajax values with null
                unset($preselected->getFlight()->returning);
            }
        } catch (\Exception $e) {
            return null;
        }

        return $preselected;
    }

    public function populatePlusMinusDays($raw)
    {
        $plusMinusDays = new \G4\ShoppingCartBundle\Entity\CartRequest\SearchParams\PlusMinusDays();

        if (is_array($raw) && isset($raw[1])) {
            $plusMinusDays->setMinusDeparting($raw[0]);
            $plusMinusDays->setPlusDeparting($raw[1]);
        }
        if (is_array($raw) && isset($raw[3])) {
            $plusMinusDays->setMinusReturning($raw[2]);
            $plusMinusDays->setPlusReturning($raw[3]);
        } else {
            /** TODO we should enforce this structure */
            // we dont have any manifest id information here
            //throw new \Exception("Unrecognized format. Method needs a 4 integer array: [3,2,1,2]");
        }

        return $plusMinusDays;
    }



}
